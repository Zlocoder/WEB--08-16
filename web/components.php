<?php

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

use yii\base\Component;

class MyBehavior extends \yii\base\Behavior {
    public $property1;

    public function getProperty2($value) {
        return $this->property1 * 2;
    }

    public function someMethod() {
        echo 'Behavior method <br/>';
    }
}

class MyClass extends Component {
    public function behaviors() {
        return [
            'my-behavior1' => [
                'class' => MyBehavior::className(),
                'property1' => 123
            ]
        ];
    }

    public function some() {
        $this->trigger('before-some-event');

        echo 'hello world <br/>';

        $this->trigger('after-some-event');
    }
}

class MyClass2 extends MyClass {

}

$obj = new MyClass();
//$obj->on('some-event', ['SomeClass', 'StaticMethod']);
//$obj->on('some-event', [$someObject, 'method']);
//$obj->on('some-event', 'globalFunc');

/*
$funcInVar = 'someFuncName';
$funcInVar = function() {};
$obj->on('some-event', $funcInVar);
*/

$obj->on('before-some-event', function($event) {
    echo 'Event handled before 1 <br/>';
    $event->handled = true;
});

$obj->on('before-some-event', function($event) {
    echo 'Event handled before  2 <br/>';
});

$obj->on('before-some-event', function($event) {
    echo 'Event handled before  3 <br/>';
});

$obj->on('after-some-event', function($event) {
    echo 'Event handled after 1 <br/>';
});

$obj->on('after-some-event', function($event) {
    echo 'Event handled after 2 <br/>';
    //$event->handled = true;
});

$obj->on('after-some-event', function($event) {
    echo 'Event handled after 3 <br/>';
});

\yii\base\Event::on(MyClass::className(), 'before-some-event', function() {
    echo 'Event handled globally before <br/>';
});

\yii\base\Event::on(MyClass::className(), 'after-some-event', function() {
    echo 'Event handled globally after <br/>';
});

$obj->some();

echo '<br/><br/>';

$obj2 = new MyClass2();
$obj2->some();

$obj->attachBehavior('my-behavior2', [ // Можно передать уже готовый объект поведения, а можно конфигурационный массив для него
    'class' => MyBehavior::className(),
    'property1' => 456
]);

echo '<br/><br/>';

echo $obj->property1; echo '<br/>';
$obj->someMethod();

echo $obj->getBehavior('my-behavior2')->property1;





