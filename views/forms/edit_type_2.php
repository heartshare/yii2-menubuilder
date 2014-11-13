<?php

use sgdot\menubuilder\Collapse;
?>

<?=

Collapse::widget([
    'items' => [
        [
            'label' => $item['label'],
            'content' => $this->render('_edit_type_2_form', ['item' => $item]),
            'options' => ['class' => 'dd-handle'],
        ],
    ]
]);
?>