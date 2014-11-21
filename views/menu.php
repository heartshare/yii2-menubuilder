<?php

use yii\helpers\Html;
use yii\bootstrap\Collapse;
use sgdot\menubuilder\MenuBuilder;

$items = [];
if (count($itemsPage)) {
    $items[] = [
        'label' => 'Страницы',
        'content' => $this->render('forms/_add_page_form', ['itemsPage' => $itemsPage]),
        'contentOptions' => ['class' => 'in'],
    ];
}
$items[] = [
    'label' => 'Ссылки',
    'content' => $this->render('forms/_add_link_form'),
    'contentOptions' => count($itemsPage) ? [] : ['class' => 'in'],
];
?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">

            Структура меню

        </div>
        <div class="panel-body">
            <div class="cf nestable-lists">
                <div class="col-lg-6" >
                    <?=
                    Collapse::widget([
                        'items' => $items,
                    ]);
                    ?>
                </div>

                <div class="col-lg-6 nestable-structure dd" id="<?= $widget_id ?>">
                    <?php $itemsData = yii\helpers\Json::decode($model->$attribute) ?>
                    <?= MenuBuilder::renderList($itemsData); ?>
                </div>

            </div>
        </div>
        <div class="panel-footer" <?= YII_DEBUG ? '' : 'style="display: none"' ?>>
            <?= Html::activeTextarea($model, $attribute) ?>
        </div>
    </div>

</div>