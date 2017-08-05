<?php

namespace qwe\rty\yui;

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

use yii\base\Object;

class MyClass extends Object {
    public $prop1;

    public function getProp2() {

    }

    public function setProp2($value) {

    }

    public function getProp3() {

    }

    public function setProp3($value) {
        
    }

    public function getProp4() {

    }
}

$obj = new MyClass();

echo MyClass::className();

$obj->prop1 = 123;
$obj->prop2 = 123;
$obj->prop3 = 123;

echo $obj->prop1;
echo $obj->prop2;
echo $obj->prop3;

$obj2 = new MyClass([
    'prop1' => 123,
    'prop2' => 456,
    'prop3' => 789
]);

echo '<pre>'; var_dump($obj, $obj2); echo '</pre>';

$obj3 = \Yii::createObject(MyClass::className(), [
    'prop1' => 123,
    'prop2' => 456,
    'prop3' => 789
]);

$obj3 = \Yii::createObject([
    'class' => MyClass::className(),
    'prop1' => 123,
    'prop2' => 456,
    'prop3' => 789
]);

\Yii::configure($obj3, [
    'prop1' => 123,
    'prop2' => 456,
    'prop3' => 789
]);
