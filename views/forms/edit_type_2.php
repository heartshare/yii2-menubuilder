<?php

use sgdot\menubuilder\Collapse;
?>
<?=

Collapse::widget([
    'items' => [
        [
            'label' => $item['label'],
            'content' => $this->render('_edit_type_2_form', ['item' => $item]),
            'contentOptions' => ['class' => 'dd-nodrag'],
        ],
    ],
    'options' => ['class' => 'dd-handle'],
]);
?>