<?php

use sgdot\menubuider\Collapse;
?>

<?=

Collapse::widget([
    'items' => [
        [
            'label' => $item['label'],
            'content' => $this->render('/forms/_edit_type_1_form', ['item' => $item]),
            'options' => 'dd-handle',
        ],
    ]
]);
?>