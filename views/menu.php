<?php

use yii\helpers\Html;
use yii\bootstrap\Collapse;
use sgdot\menubuilder\MenuBuilder;
?>

<?php
MenuBuilder::renderList($model->$attribute);
?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">

            Структура меню

        </div>
        <div class="panel-body">
            <div class="cf nestable-lists">
                <div class="dd col-lg-6" >
                    <?=
                    Collapse::widget([
                        'items' => [
                            [
                                'label' => 'Страницы',
                                'content' => $this->render('forms/_add_page_form', ['itemsPage' => $itemsPage]),
                                'contentOptions' => ['class' => 'in']
                            ],
                            [
                                'label' => 'Ссылки',
                                'content' => $this->render('forms/_add_link_form'),
                            ],
                        ]
                    ]);
                    ?>
                </div>

                <div class="dd col-lg-6 nestable-structure" id="<?= $widget_id ?>">
                    <ol class="dd-list">
                    </ol>
                </div>

            </div>
        </div>
        <div class="panel-footer">
            <?= Html::activeTextarea($model, $attribute) ?>
        </div>
    </div>

</div>