<?php

use yii\helpers\Json;
?>

<div class="form-group">
    <label>URL</label>
    <input name="data-url" class="form-control" value="<?= isset($item['url']) ? Json::encode($item['url']) : '' ?>">
</div>
<div class="row">
    <div class="form-group col-xs-6">
        <label>Текст ссылки</label>
        <input name="data-label" class="form-control" value="<?= isset($item['label']) ? $item['label'] : '' ?>">
    </div>
    <div class="form-group col-xs-6">
        <label>Атрибут title</label>
        <input name="data-options[title]" class="form-control" value="<?= isset($item['options']['title']) ? $item['options']['title'] : '' ?>">
    </div>
</div>
<div class="form-group">
    <label>Классы CSS</label>
    <input name="data-options[class]" class="form-control" value="<?= isset($item['options']['class']) ? $item['options']['class'] : '' ?>">
    <p class="help-block">Необязательно.</p>
</div>
