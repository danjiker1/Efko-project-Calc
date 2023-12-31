<?php

use yii\db\Migration;

class m231017_134920_insert_prices extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('prices', ['raw_type_id', 'month_id', 'tonnage_id', 'price'], [
            [2, 1, 1, 125],
            [2, 1, 2, 145],
            [2, 1, 3, 136],
            [2, 1, 4, 138],
            [2, 2, 1, 121],
            [2, 2, 2, 118],
            [2, 2, 3, 137],
            [2, 2, 4, 142],
            [2, 3, 1, 137],
            [2, 3, 2, 119],
            [2, 3, 3, 141],
            [2, 3, 4, 117],
            [2, 4, 1, 126],
            [2, 4, 2, 121],
            [2, 4, 3, 137],
            [2, 4, 4, 124],
            [2, 5, 1, 124],
            [2, 5, 2, 122],
            [2, 5, 3, 131],
            [2, 5, 4, 147],
            [2, 6, 1, 128],
            [2, 6, 2, 147],
            [2, 6, 3, 143],
            [2, 6, 4, 112],
            [3, 1, 1, 121],
            [3, 1, 2, 118],
            [3, 1, 3, 137],
            [3, 1, 4, 142],
            [3, 2, 1, 137],
            [3, 2, 2, 121],
            [3, 2, 3, 124],
            [3, 2, 4, 131],
            [3, 3, 1, 124],
            [3, 3, 2, 145],
            [3, 3, 3, 136],
            [3, 3, 4, 138],
            [3, 4, 1, 137],
            [3, 4, 2, 147],
            [3, 4, 3, 143],
            [3, 4, 4, 112],
            [3, 5, 1, 122],
            [3, 5, 2, 143],
            [3, 5, 3, 112],
            [3, 5, 4, 117],
            [3, 6, 1, 125],
            [3, 6, 2, 145],
            [3, 6, 3, 136],
            [3, 6, 4, 138],
            [1, 1, 1, 137],
            [1, 1, 2, 147],
            [1, 1, 3, 112],
            [1, 1, 4, 122],
            [1, 2, 1, 125],
            [1, 2, 2, 145],
            [1, 2, 3, 136],
            [1, 2, 4, 138],
            [1, 3, 1, 124],
            [1, 3, 2, 145],
            [1, 3, 3, 136],
            [1, 3, 4, 138],
            [1, 4, 1, 122],
            [1, 4, 2, 143],
            [1, 4, 3, 112],
            [1, 4, 4, 117],
            [1, 5, 1, 137],
            [1, 5, 2, 119],
            [1, 5, 3, 141],
            [1, 5, 4, 117],
            [1, 6, 1, 121],
            [1, 6, 2, 118],
            [1, 6, 3, 137],
            [1, 6, 4, 142],
        ]);
    }

    public function safeDown()
    {
        
    }
}