Yii2 menu builder
=================

##Installation


The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sgdot/yii2-menubuilder "dev-master"
```

or add

```
"sgdot/yii2-menubuilder": "dev-master"
```

to the require section of your `composer.json` file.

migration
```php
...

    public function up() {
        $this->createTable('menu', [
            'id' => 'pk',
            'position_id' => 'integer',
            'items' => 'text',
        ]);
    }

    public function down() {
        $this->dropTable('menu');
    }

...
```

model
```php

<?php

namespace common\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $position_id
 * @property string $items
 */
class Menu extends \yii\db\ActiveRecord {

....

    public static function getItems($pos_id) {
        $menu = self::findOne(['position_id' => $pos_id]);
        if ($menu === null) {
            return [];
        }
        $items = Json::decode(strtr($menu->items, [
                '"children":' => '"items":',
        ]));
        return $items;
    }
...
}
```

use 
```php
<?=
yii\widgets\Menu::widget([
    'items' => Menu::getItems(Menu::POS_HEADER),
    'options' => ['id' => 'menu']
])
?>
```
