<?php

namespace siasoft\qucms\web;

use yii\base\Component;
use siasoft\qucms\models\ImageInfo;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
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
    private $info;
    
    /**
     * Return path by section name
     * @param string $section Section name
     * @return string
     */
    public static function getPath($section = 'upload')
    {
        return ImageSection::find()->where("name = '{$section}'")->select('path')->scalar();
    }

    /**
     * upload image to server
     * @param \yii\base\Model $model Model contain data
     * @param Array $attributes names of fields
     * @return \siasoft\qucms\web\Image
     * @throws \Exception
     */
    public static function Upload($model = false, $attributes = [])
    {
        $info = null;
        $file = UploadedFile::getInstance($model, ArrayHelper::getValue($attributes, 'file', 'name'));
        $model->{ArrayHelper::getValue($attributes, 'file', 'name')} = $file->baseName;
        if ($model instanceof ImageInfo) {
            $info = $model;
        } else {
            $info = new ImageInfo();
            $info->name = $model->{ArrayHelper::getValue($attributes, 'name', 'name')};
            $info->title = $model->{ArrayHelper::getValue($attributes, 'title', 'title')};
        }
        $info->size = $file->size;
        if (!$info->save()) {
            throw new \Exception('Ошибка добавления изображения');
        }
        $filename = self::getPath() . "\\{$info->id}.jpg";
        $file->saveAs($filename);
        $arr = getimagesize($filename);
        $info->width = $arr[0];
        $info->height = $arr[1];
        $info->original = $info->id;
        $info->save();

        $image = new Image();
        $image->info = $info;
        return $image;
    }

    public static function getImage($id)
    {
        $image = new Image();
        $image->info = ImageInfo::find()->where("id = {$id}")->one();
        return $image;
    }

    public static function checkAll()
    {
        
    }

    public function generateImage($section)
    {
        $section = ImageSection::find()->where("name = '{$section}'");
                
    }
}
