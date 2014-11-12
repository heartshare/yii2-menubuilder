<?php

use yii\helpers\Html;
use yii\bootstrap\Collapse;
use sgdot\menubuider\MenuBuilder;
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
                                'content' => $this->render('/forms/_add_page_form', ['itemsPage' => $itemsPage]),
                                'contentOptions' => ['class' => 'in']
                            ],
                            [
                                'label' => 'Ссылки',
                                'content' => $this->render('/forms/_add_link_form'),
                            ],
                        ]
                    ]);
                    ?>
                </div>

                <div class="dd col-lg-6 nestable-structure" id="<?= widget_id ?>">
                    <ol class="dd-list">
                        <li class="dd-item" data-id="13">
                            <div class="panel-group dd-handle" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <span class=" glyphicon glyphicon-move"></span>
                                            <span class="item-label">{url-label}</span>
                                            <a class="pull-right dd-nodrag" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Изменить <span class="caret"></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse dd-nodrag" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="div-form" role="form">
                                                <div class="form-group">
                                                    <label>URL</label>
                                                    <input name="data-url" class="form-control">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-xs-6">
                                                        <label>Текст ссылки</label>
                                                        <input name="data-label" class="form-control">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label>Атрибут title</label>
                                                        <input name="data-options-title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Классы CSS</label>
                                                    <input name="data-options-class" class="form-control">
                                                    <p class="help-block">Необязательно.</p>
                                                </div>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-default btn-save">Сохранить</a>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-default btn-cancel">Отмена</a>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-default btn-delete">Удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li id="test" class="dd-item" data-id="14">
                            <div class="panel-group dd-handle" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <span class="glyphicon glyphicon-move"></span>
                                            <span class="item-label">{url-label}</span>
                                            <a class="pull-right dd-nodrag" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                                Изменить <span class="caret"></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse dd-nodrag" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="div-form" role="form">
                                                <div class="form-group">
                                                    <label>Тут типа название ссылки(изменить нельзя, ибо json)</label>
                                                    <input name="data-url" type="hidden" class="form-control" value="[1212]">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-xs-6">
                                                        <label>Текст ссылки</label>
                                                        <input name="data-label" class="form-control">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label>Атрибут title</label>
                                                        <input name="data-options-title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Классы CSS</label>
                                                    <input name="data-options-class" class="form-control">
                                                    <p class="help-block">Необязательно.</p>
                                                </div>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-default btn-save">Сохранить</a>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-default btn-cancel">Отмена</a>
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-default btn-delete">Удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="panel-footer">
            <?= Html::activeTextarea($model, $attribute) ?>
        </div>
    </div>

</div>