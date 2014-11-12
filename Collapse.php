<?php

namespace sgdot\menubuider;

/**
 * Collapse
 *
 * @author SergeiGulin <gulin.sergei@ya.ru>
 */
class Collapse extends \yii\bootstrap\Collapse {

    /**
     * @var boolean whether the labels for header items should be HTML-encoded.
     */
    public $encodeLabels = false;

    /**
     * Renders a single collapsible item group
     * @param string $header a label of the item group [[items]]
     * @param array $item a single item from [[items]]
     * @param integer $index the item index as each item group content must have an id
     * @return string the rendering result
     * @throws InvalidConfigException
     */
    public function renderItem($header, $item, $index) {
        if (isset($item['content'])) {
            $id = $this->options['id'] . '-collapse' . $index;
            $options = ArrayHelper::getValue($item, 'contentOptions', []);
            $options['id'] = $id;
            Html::addCssClass($options, 'panel-collapse collapse');

            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            if ($encodeLabel) {
                $header = Html::encode($header);
            }

            $headerToggle = '<span class=" glyphicon glyphicon-move"></span><span class="item-label">' . $header . '</span>';
            $headerToggle .= Html::a('Изменить <span class="caret"></span>', '#' . $id, [
                    'class' => 'collapse-toggle pull-right dd-nodrag',
                    'data-toggle' => 'collapse',
                    'data-parent' => '#' . $this->options['id']
                ]) . "\n";

            $header = Html::tag('h4', $headerToggle, ['class' => 'panel-title']);

            $content = Html::tag('div', $item['content'], ['class' => 'div-form', 'role' => 'form']) . "\n";
            $content .= Html::a('Сохранить', '#' . $id, [
                    'class' => 'collapse-toggle btn btn-default btn-save',
                    'data-toggle' => 'collapse',
                    'data-parent' => '#' . $this->options['id']
                ]) . "\n";
            $content .= Html::a('Отмена', '#' . $id, [
                    'class' => 'collapse-toggle btn btn-default btn-cancel',
                    'data-toggle' => 'collapse',
                    'data-parent' => '#' . $this->options['id']
                ]) . "\n";
            $content .= Html::a('Удалить', '#' . $id, [
                    'class' => 'collapse-toggle btn btn-default btn-delete',
                    'data-toggle' => 'collapse',
                    'data-parent' => '#' . $this->options['id']
                ]) . "\n";
            $content = Html::tag('div', $content, ['class' => 'panel-body']) . "\n";
        } else {
            throw new InvalidConfigException('The "content" option is required.');
        }
        $group = [];

        $group[] = Html::tag('div', $header, ['class' => 'panel-heading']);
        $group[] = Html::tag('div', $content, $options);

        return implode("\n", $group);
    }

}
