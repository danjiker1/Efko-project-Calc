<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

class CalcController extends Controller
{
    public $month;
    public $type;
    public $tonnage;
    public static $prices;

    public static function initPrices()
    {
        self::$prices = require_once __DIR__ . '/../config/prices.php';
    }

    public function options($actionID)
    {
        return ['month', 'type', 'tonnage'];
    }

    public function actionIndex()
    {
        self::initPrices();

        if (!$this->month || !$this->type || !$this->tonnage) {
            echo "error:\n";
            if (!isset($this->month)) echo "MONTH обязателен.\n";
            if (!isset($this->type)) echo "TYPE обязателен.\n";
            if (!isset($this->tonnage)) echo "TONNAGE обязателен.\n";
            // echo "All options are required.\n";
        }

        if (
            !isset(self::$prices[$this->type])
        ) {
            echo "error:\n";
            echo "прайса для --type=$this->type нет\n";
            echo "проверьте корректность введенных данных.\n";

            return;
        } else if (
            !isset(self::$prices[$this->type][$this->month])
        ) {
            echo "error:\n";
            echo "прайса для --month=$this->month нет.\n";
            echo "проверьте корректность введенных данных.\n";
            return;
        } else if (
            !isset(self::$prices[$this->type][$this->month][$this->tonnage])
        ) {
            echo "error:\n";
            echo "прайса для --tonnage=$this->tonnage нет\n";
            echo "проверьте корректность введенных данных.\n";

            return;
        }

        if ($this->month && $this->type && $this->tonnage) {

            if (
                self::$prices[$this->type] &&
                self::$prices[$this->type][$this->month] &&
                self::$prices[$this->type][$this->month][$this->tonnage]

            ) {

                echo "month: $this->month" . "\n";
                echo "type: $this->type" . "\n";
                echo "tonnage: $this->tonnage" . "\n";
                echo 'result: ' .
                    self::$prices[$this->type][$this->month][$this->tonnage];
                echo "\n";
            }
        }
        return ExitCode::OK;
    }
}