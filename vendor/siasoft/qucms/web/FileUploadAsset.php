<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\web;

use yii\web\AssetBundle;

/**
 * Description of FileAploadAsset
 *
 * @author SW-PC1
 */
class FileUploadAsset extends AssetBundle
{
    public $sourcePath = '@vendor/siasoft/qucms/assets';
    public $js = [
        'jquery-ui-1.10.4.custom.min.js',
        'jquery.ui.widget.js',
        'load-image.min.js',
        'canvas-to-blob.min.js',
        'jquery.iframe-transport.js',
        'jquery.fileupload.js',
        'jquery.fileupload-process.js',
        'js/jquery.fileupload-image.js',
        'jquery.Jcrop.min.js'
    ];
    public $css = [
        'jquery.fileupload.css',
        'jquery.Jcrop.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];

}
