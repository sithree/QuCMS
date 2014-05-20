<?php

namespace siasoft\qucms\web;

use Yii;
use yii\base\Component;
use siasoft\qucms\models\ImageInfo;
use siasoft\qucms\models\ImageSource;
use siasoft\qucms\models\ImageSection;
use siasoft\qucms\web\UploadHandler;

/**
 * Manage image collection
 * @property ImageSection section image params
 * @author SW-PC1
 */
class Image extends Component
{
    /**
     * Data from db
     * @var ImageInfo
     */
    private $_info;
    /**
     * image params
     * @var ImageSection
     */
    private $_section;

    /**
     * Load image from file
     * @param String $filename
     * @return Resource resource an image resource identifier on success
     * @throws InvalidArgumentException
     */
    private function imagecreatefromfile($filename)
    {
        if (!file_exists($filename)) {
            throw new InvalidArgumentException('File "' . $filename . '" not found.');
        }
        switch (strtolower(pathinfo($filename, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filename);
            case 'png':
                return imagecreatefrompng($filename);
            case 'gif':
                return imagecreatefromgif($filename);
            default:
                throw new InvalidArgumentException('File "' . $filename . '" is not valid jpg, png or gif image.');
        }
    }

    public static function getSectionByName($section = 'upload')
    {
        return ImageSection::find()->where("name = '{$section}'")->one();
    }

    /**
     * Upload image to server
     * @return \siasoft\qucms\web\Image
     * @throws \Exception
     */
    public static function Upload()
    {
        $info = new ImageInfo();
        $result = [];
        $info->load(Yii::$app->request->post());
        if (!$info->validate()) {
            $result['error'] = $info->errors;
            return [$result, null];
        }

        $source = new ImageSource();
        $source->load(Yii::$app->request->post());
        if (!$source->validate()) {
            $result['error'] = $source->errors;
            return [$result, null];
        }

        $section = self::getSectionByName();
        $imageUploader = new UploadHandler([
            'image_versions' => [],
            'param_name' => 'file',
            'upload_dir' => $section->path,
            'upload_url' => $section->url
                ], false);
        list($file) = $imageUploader->post(false)['file'];

        $info->size = $file->size;
        $info->section = $section->id;

        $filename = $section->path . $file->name;
        list($info->width, $info->height) = getimagesize($filename);

        $info->save();

        $source->image_id = $info->id;
        $source->name = $file->name;
        $source->save();

        $file->name = $info->id . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        rename($filename, $section->path . $file->name);

        $result['name'] = $file->name;
        $result['url'] = str_replace(pathinfo($filename, PATHINFO_FILENAME), $info->id, $file->url);

        $image = new Image();
        $image->_info = $info;
        $image->_section = $section;
        
        $result['success'] = true;
        return [$result, $image];
    }

    public static function getImage($id)
    {
        $image = new Image();
        $image->_info = ImageInfo::find()->where("id = {$id}")->one();
        return $image;
    }

    public static function checkAll()
    {
        
    }

    public function getSection()
    {
        if (!$this->_section) {
            $this->_section = ImageSection::find()->where("id = {$this->_info->id}")->one();
        }
        return $this->_section;
    }

    public function generateImage($section)
    {
        $section = self::getSection($section);
        $new = imagecreatetruecolor($section->width, $section->height);
        $source = $this->imagecreatefromfile($filename);
    }

}
