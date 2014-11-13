<?php

use yii\helpers\Html;
?>

<div class="panel-body">
    <div class="div-form" role="form">
        <div class="form-group">
            <label>Страницы</label>
            <?php foreach ($itemsPage as $page): ?>
                <div class="checkbox">
                    <label>
                        <?=
                        Html::checkbox('pages[]', false, [
                            'data-url' => $page['url'],
                            'data-label' => $page['label'],
                            'data-options-title' => $page['optionsTitle'],
                            'data-options-class' => $page['optionsClass'],
                        ])
                        ?>
                        <?= $page['label'] ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="btn btn-default btn-add-pages">Добавить</a>
    </div>
</div>