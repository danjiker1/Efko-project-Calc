<?php

namespace app\models;

use yii\base\Model;

class CalcForm extends Model {
    public $raw_types;
    public $tonnage;
    public $months;

    public function rules()
    {
        return [
        
            [['raw_types', 'tonnage', 'months'], 'required']
        ];
    }

};
