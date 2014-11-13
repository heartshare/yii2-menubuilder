Array.prototype.max = function () {
    return Math.max.apply(null, this);
};

var updateOutput = function (e)
{
    var list = e.length ? e : $(e.target),
            output = list.data('output');
    if (window.JSON) {
        output.val(window.JSON.stringify(list.nestable('serialize')));
    } else {
        output.val('JSON browser support required for this demo.');
    }
};

(function ($) {
    $.fn.serializeAny = function () {
        var ret = {};
        $.each($(this).find(':input'), function () {
            ret[$(this).attr('name')] = $(this).val();
        });
        return ret;
    };
})(jQuery);

function MenuBuilder(options) {
    var defaults = {
        nestable_id: '#nestable',
        nestable_out_id: '#nestable-output'
    };
    this.options = $.extend({}, defaults, options);
    this.init();
    MenuBuilder.count++;
}

MenuBuilder.prototype.init = function () {

    this.setEvents();
    this.update();
};

MenuBuilder.prototype.update = function () {
    updateOutput($(this.options.nestable_id).data('output', $(this.options.nestable_out_id)));
};

MenuBuilder.prototype.getNewId = function () {
    var max = this.getMaxId();
    return max + 1;
};

MenuBuilder.prototype.getMaxId = function () {
    var ids = [];
    $('li', this.options.nestable_id).each(function () {
        ids.push($(this).attr('data-id'));
    });
    return ids.length === 0 ? 0 : ids.max();
};

MenuBuilder.prototype.setData = function (el, data) {
    el.attr(data);
    el.data('id', data['data-id']);
    el.data('url', data['data-url']);
    el.data('label', data['data-label']);
    el.data('optionsTitle', data['data-options-title']);
    el.data('optionsClass', data['data-options-class']);
};

MenuBuilder.prototype.setDataInvert = function (el, data) {
    el.data(data);
    el.attr('data-id', data['id']);
    el.attr('data-url', data['url']);
    el.attr('data-label', data['label']);
    el.attr('data-options-title', data['optionsTitle']);
    el.attr('data-options-class', data['optionsClass']);
};

MenuBuilder.prototype.setEvents = function () {
    var self = this;
    var nestable = $(this.options.nestable_id);
    var nestable_out = $(this.options.nestable_out_id);
    nestable.nestable({
        group: 1,
        expandBtnHTML: '',
        collapseBtnHTML: ''
    });
    nestable.on('change', function () {
        self.update();
    });

    $(document).on('click', '.dd-list .btn-save', function () {
        var form = $(this).closest('.div-form');
        var data = form.serializeAny();
        var item = form.closest('li');

        self.setData(item, data);
        self.update();
        $('.panel-title .item-label', item).text(data['data-label']);
    });

    $(document).on('click', '.dd-list .btn-delete', function () {
        $(this).closest('li').remove();
        self.update();
    });
    $(document).on('click', '.btn-add-links', function () {
        var form = $(this).closest('.div-form');
        var data = form.serializeAny();
        var li = $('<li></li>');
        li.attr('class', 'dd-item');
        var tmpl = MenuBuilder.template_type_2;
        var index = self.getNewId();
        var html = tmpl
                .split('{index}').join(index)
                .split('{url-value}').join(data['data-url'])
                .split('{url-label}').join(data['data-label'])
                .split('{options-title}').join(data['data-options-title'])
                .split('{options-class}').join(data['data-options-class']);
        li.html(html);
        data['data-id'] = index;

        self.setData(li, data);
        li.appendTo($(self.options.nestable_id + '>ol'));
        self.update();
    });

    $(document).on('click', '.btn-add-pages', function () {
        var form = $(this).closest('.div-form');
        var tmpl = MenuBuilder.template_type_1;
        var index = self.getNewId();
        var data = [];
        $(":checked", form).each(function () {
            data.push($(this).data());
        });
        for (var i = 0; i < data.length; i++) {
            var li = $('<li></li>');
            li.attr('class', 'dd-item');
            var html = tmpl
                    .split('{index}').join(index)
                    .split('{url-value}').join(data[i]['url'])
                    .split('{url-label}').join(data[i]['label'])
                    .split('{options-title}').join(data[i]['optionsTitle'])
                    .split('{options-class}').join(data[i]['optionsClass']);
            li.html(html);
            data[i]['id'] = index;

            self.setDataInvert(li, data[i]);
            li.appendTo($(self.options.nestable_id + '>ol'));
            index++;
        }
        self.update();
    });
};

MenuBuilder.count = 0;
MenuBuilder.template_type_1 =
        '<div class="panel-group" id="accordion-{index}" role="tablist" aria-multiselectable="true">'
        + '    <div class="panel panel-default dd-handle">'
        + '        <div class="panel-heading" role="tab" id="heading-{index}">'
        + '            <h4 class="panel-title">'
        + '                <span class="glyphicon glyphicon-move"></span>'
        + '                <span class="item-label">{url-label}</span>'
        + '                <a class="pull-right dd-nodrag" data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}">'
        + '                    Изменить <span class="caret"></span>'
        + '                </a>'
        + '            </h4>'
        + '        </div>'
        + '        <div id="collapse-{index}" class="panel-collapse collapse dd-nodrag" role="tabpanel" aria-labelledby="heading-{index}">'
        + '            <div class="panel-body">'
        + '                <div class="div-form" role="form">'
        + '                    <div class="form-group">'
        + '                        <label>Страница "{url-label}"</label>'
        + '                        <input name="data-url" type="hidden" class="form-control" value="{url-value}">'
        + '                    </div>'
        + '                    <div class="row">'
        + '                        <div class="form-group col-xs-6">'
        + '                            <label>Текст ссылки</label>'
        + '                            <input name="data-label" class="form-control" value="{url-label}">'
        + '                        </div>'
        + '                        <div class="form-group col-xs-6">'
        + '                            <label>Атрибут title</label>'
        + '                            <input name="data-options-title" class="form-control" value="{options-title}">'
        + '                        </div>'
        + '                    </div>'
        + '                    <div class="form-group">'
        + '                        <label>Классы CSS</label>'
        + '                        <input name="data-options-class" class="form-control" value="{options-class}">'
        + '                        <p class="help-block">Необязательно.</p>'
        + '                    </div>'
        + '                    <a data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}" class="btn btn-default btn-save">Сохранить</a>'
        + '                    <a data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}" class="btn btn-default btn-cancel">Отмена</a>'
        + '                    <a data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}" class="btn btn-default btn-delete">Удалить</a>'
        + '                </div>'
        + '            </div>'
        + '        </div>'
        + '    </div>'
        + '</div>';

MenuBuilder.template_type_2 =
        '<div class="panel-group" id="accordion-{index}" role="tablist" aria-multiselectable="true">'
        + '    <div class="panel panel-default dd-handle">'
        + '        <div class="panel-heading" role="tab" id="heading-{index}">'
        + '            <h4 class="panel-title">'
        + '                <span class="glyphicon glyphicon-move"></span>'
        + '                <span class="item-label">{url-label}</span>'
        + '                <a class="pull-right dd-nodrag" data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}">'
        + '                    Изменить <span class="caret"></span>'
        + '                </a>'
        + '            </h4>'
        + '        </div>'
        + '        <div id="collapse-{index}" class="panel-collapse collapse dd-nodrag" role="tabpanel" aria-labelledby="heading-{index}">'
        + '            <div class="panel-body">'
        + '                <div class="div-form" role="form">'
        + '                    <div class="form-group">'
        + '                        <label>Url</label>'
        + '                        <input name="data-url" class="form-control" value="{url-value}">'
        + '                    </div>'
        + '                    <div class="row">'
        + '                        <div class="form-group col-xs-6">'
        + '                            <label>Текст ссылки</label>'
        + '                            <input name="data-label" class="form-control" value="{url-label}">'
        + '                        </div>'
        + '                        <div class="form-group col-xs-6">'
        + '                            <label>Атрибут title</label>'
        + '                            <input name="data-options-title" class="form-control" value="{options-title}">'
        + '                        </div>'
        + '                    </div>'
        + '                    <div class="form-group">'
        + '                        <label>Классы CSS</label>'
        + '                        <input name="data-options-class" class="form-control" value="{options-class}">'
        + '                        <p class="help-block">Необязательно.</p>'
        + '                    </div>'
        + '                    <a data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}" class="btn btn-default btn-save">Сохранить</a>'
        + '                    <a data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}" class="btn btn-default btn-cancel">Отмена</a>'
        + '                    <a data-toggle="collapse" data-parent="#accordion-{index}" href="#collapse-{index}" aria-expanded="true" aria-controls="collapse-{index}" class="btn btn-default btn-delete">Удалить</a>'
        + '                </div>'
        + '            </div>'
        + '        </div>'
        + '    </div>'
        + '</div>'