<?php

namespace siasoft\qucms\web;

use Yii;
use yii\base\Component;
use siasoft\qucms\models\ImageInfo;
use siasoft\qucms\web\UploadHandler;
use \siasoft\qucms\models\ImageSection;

/**
 * Manage image collection
 *
 * @author SW-PC1
 */
class Image extends Component
{
    /**
     * Data from db
     * @var ImageInfo
     */
    private $_info;
    private $_section;

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
     * upload image to server
     * @param \yii\base\Model $model Model contain data
     * @param Array $attributes names of fields
     * @return \siasoft\qucms\web\Image
     * @throws \Exception
     */
    public static function Upload()
    {
        $data = new \siasoft\qucms\models\File();
        $data->load(Yii::$app->request->post());
        if (!$data->validate()) {
            throw new \Exception($data->errors['title'][0]);
        }
        $section = self::getSectionByName();
        $imageUploader = new UploadHandler([
            'image_versions' => [],
            'param_name' => 'file',
            'upload_dir' => $section->path,
            'upload_url' => $section->url
                ], false);
        $file = $imageUploader->post(false)['file'][0];
        unset($file->deleteUrl);
        unset($file->deleteType);

        $info = new ImageInfo();
        $info->name = $file->name;
        $info->title = $data->title;
        $info->size = $file->size;
        $info->section = $section->id;

        $filename = $section->path . $file->name;
        list($info->width, $info->height) = getimagesize($filename);

        if (!$info->save()) {
            throw new \Exception('Ошибка добавления изображения');
        }
        $file->name = $info->id . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        rename($filename, $section->path . $file->name);

        $file->url = str_replace(pathinfo($filename, PATHINFO_FILENAME), $info->id, $file->url);

        $image = new Image();
        $image->_info = $info;
        $image->_section = $section;
        return $image;
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

    public static function getSection()
    {
        if (!$this->_section)
            $this->_section = ImageSection::find()->where("id = {$this->_info->id}")->one();
        return $this->_section;
    }

    public function generateImage($section)
    {
        $section = self::getSection($section);
        $new = imagecreatetruecolor($section->width, $section->height);
        $source = imagecreatefromgd();
    }

}
