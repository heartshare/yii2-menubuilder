<?php

Yii::setAlias('@menubuilder', __DIR__);

namespace sgdot\menubuider;

/**
 * MenuBuilderAssets
 *
 * @author SergeiGulin <gulin.sergei@ya.ru>
 */
class MenuBuilderAssets extends \yii\web\AssetBundle {

    public $sourcePath = '@menubuilder/assets';
    public $css = [
        'css/menubuilder.css',
    ];
    public $js = [
        'js/jquery.nestable.js',
        'js/menubuilder.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
