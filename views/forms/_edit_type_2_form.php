<div class="form-group">
    <label>Страница "<?= isset($item['label']) ? $item['label'] : '' ?>"</label>
    <input name="data-url" type="hidden" class="form-control" value="<?= isset($item['url']) ? $item['url'] : '' ?>">
</div>
<div class="row">
    <div class="form-group col-xs-6">
        <label>Текст ссылки</label>
        <input name="data-label" class="form-control" value="<?= isset($item['label']) ? $item['label'] : '' ?>">
    </div>
    <div class="form-group col-xs-6">
        <label>Атрибут title</label>
        <input name="data-options-title" class="form-control" value="<?= isset($item['optionsTitle']) ? $item['optionsTitle'] : '' ?>">
    </div>
</div>
<div class="form-group">
    <label>Классы CSS</label>
    <input name="data-options-class" class="form-control" value="<?= isset($item['optionsClass']) ? $item['optionsClass'] : '' ?>">
    <p class="help-block">Необязательно.</p>
</div>