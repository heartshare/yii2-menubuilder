<?php

use sgdot\menubuilder\Collapse;
?>

<?=

Collapse::widget([
    'items' => [
        [
            'label' => $item['label'],
            'content' => $this->render('_edit_type_1_form', ['item' => $item]),
            'options' => ['class' => 'dd-handle'],
            'contentOptions' => ['class' => 'dd-nodrag'],
        ],
    ]
]);
?>