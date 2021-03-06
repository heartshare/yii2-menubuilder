<?php

namespace sgdot\menubuilder;

use Yii;
use yii\helpers\Json;
use yii\web\View;
use yii\helpers\Html;

/**
 * MenuBuilder
 *
 * @author SergeiGulin <gulin.sergei@ya.ru>
 */
class MenuBuilder extends \yii\widgets\InputWidget {

    public $itemsPage = [];

    public function init() {
        parent::init();
        $this->registerJs();
    }

    public function run() {
        return $this->render('menu', [
                'itemsPage' => $this->itemsPage,
                'model' => $this->model,
                'attribute' => $this->attribute,
                'widget_id' => $this->id,
        ]);
    }

    public function registerJs() {
        /* @var $view yii\web\View */
        $view = $this->getView();
        $options = [
            'nestable_out_id' => '#' . Html::getInputId($this->model, $this->attribute),
            'nestable_id' => '#' . $this->id,
        ];
        $js = "var menubuilder = new MenuBuilder(" . Json::encode($options) . ");";
        $view->registerJs($js, View::POS_READY);
        MenuBuilderAssets::register($view);
    }

    public static function renderList($items) {
        return Html::ol($items, [
                'class' => 'dd-list',
                'item' => [self::className(), 'renderListItem'],
        ]);
    }

    public static function renderListItem($item, $index) {
        /* @var $view yii\web\View */
        $view = Yii::$app->getView();
        $html = Html::beginTag('li', [
                'class' => 'dd-item',
                'data' => [
                    'id' => $item['id'],
                    'url' => is_array($item['url']) ? Json::encode($item['url']) : $item['url'],
                    'label' => $item['label'],
                    'options' => $item['options'],
                ],
        ]);
        $data = ['item' => $item, 'index' => $index];
        $html .= is_array($item['url']) ? $view->render('forms/edit_type_2', $data) : $view->render('forms/edit_type_1', $data);
        if (isset($item['children'])) {
            $html.=self::renderList($item['children']);
        }
        $html .= Html::endTag('li');
        return $html;
    }

}
