<?php
use yii\db\Query;

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';


class Animal {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

interface MammalInterface {
    public function milkFeeding();
}

class Mammal implements MammalInterface {
    protected $name;
    protected $furColor; 

    public function __construct($name, $furColor) {
        $this->name = $name;
        $this->furColor = $furColor; 
    }

    public function milkFeeding() {
        return $this->name . " кормится молоком.";
    }

    public function setFurColor($furColor) {
        $this->furColor = $furColor;
    }

    public function getFurColor() {
        return $this->furColor;
    }
}

class Predator extends Animal {
    public function hunt() {
        return $this->name . " охотится.";
    }
}

class Feline extends Mammal {
    public function purr() {
        return $this->name . " мурлычет.";
    }
    
}

class Cat extends Feline {
    public function catchMouse() {
        return $this->name . " ловит мышей.";
    }
}

class Dog extends Mammal {
    public function bark() {
        return $this->name . " лает.";
    }

    public function run() {
        return $this->name . " бежит.";
    }
}

class Bird extends Animal {
    public function fly() {
        return $this->name . " летит.";
    }

    public function sing() {
        return $this->name . " поет.";
    }
}

    $cat = new Cat("Кошка", "рыжая");
    $dog = new Dog("Собака", "серая");
    $bird = new Bird("Птица");
   
    $cat_methods = [
        'purr' => $cat->purr(),
        'catchMouse' => $cat->catchMouse()
    ];

    $dog_methods = [
        'bark' => $dog->bark(),
        'run' => $dog->run()
    ];

    $bird_methods = [
        'fly' => $bird->fly(),
        'sing' => $bird->sing()
    ];

   // dd($cat, $cat_methods, $bird, $bird_methods, $dog, $dog_methods);


// $price = (new Query())->select('value')->from('tonnages')->all();
// dd($price);

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();



