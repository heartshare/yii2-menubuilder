<?php

use sgdot\menubuilder\Collapse;
?>
<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 17</div>
<?php
Collapse::widget([
    'items' => [
        [
            'label' => $item['label'],
            'content' => '<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">Item 17</div>', //$this->render('_edit_type_2_form', ['item' => $item]),
            'contentOptions' => ['class' => 'dd-nodrag'],
        ],
    ],
    'options' => ['class' => 'dd-handle'],
]);
?>