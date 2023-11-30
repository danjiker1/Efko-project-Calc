<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

use app\models\Months;
use app\models\Tonnages;
use app\models\RawTypes;

$username = Yii::$app->user->identity->username;
?>
<?php $this->title = 'Калькулятор';

if (Yii::$app->user->can('User') || Yii::$app->user->can('Admin')) {
    echo '<h1 class="text-center"><span style="font-size: 16px;">Добро пожаловать ' . $username . '!</span></h1>';
}
?>

<h1 class="text-center">Калькулятор расчета стоимости</h1>

<style>
.btn-lowered {
    margin-top: 20px;
    margin-right: 20px; /* Add this line to move the button to the right */
}

.center {
    display: flex;
    justify-content: center;
}
</style>

<?php Pjax::begin() ?>

<div class="row justify-content-md-center mt-4">
    <div class="col-md-4 mb-4">
        <?php $form = ActiveForm::begin([
            'options' => ['data' => ['pjax' => true]],
        ]) ?>

        <?= $form->field($model, 'month_id',['options' => ['class' => 'formLabel']])
            ->dropDownList(Months::getListForSelect(), ['prompt' => 'Выберите месяц...', 'id' => 'monthInput']); ?>

        <?= $form->field($model, 'raw_type_id', ['options' => ['class' => 'formLabel']])
            ->dropDownList(RawTypes::getListForSelect(), ['prompt' => 'Выберите тип...', 'id' => 'typeInput']); ?>

        <?= $form->field($model, 'tonnage_id', ['options' => ['class' => 'formLabel']])
            ->dropDownList(Tonnages::getListForSelect(), ['prompt' => 'Выберите тип...', 'id' => 'tonnageInput']); ?>
        
        <div class="center">
            <?= Html::submitButton('Рассчитать', ['class' => 'btn btn-dark btn-lowered']) ?>
        </div>
        
        <?php ActiveForm::end() ?>
    </div>
    

    
    <?php if (!empty($calculation)) : ?>
        <div class="col-md-4 mb-4 border border-dark rounded text-center p-3">
            <h3>Итого</h3>
            <div class="row align-items-center mt-3">
                <div class="col-md-12 align-items-center">
                    <p><span>Выбранный месяц: </span><span id="month"><?= $calculation->month_id ?></span></p>
                    <p><span>Тип сырья: </span><span id="type"><?= $calculation->raw_type_id ?></span></p>
                    <p><span>Тоннаж: </span><span id="tonnage"><?= $calculation->tonnage_id ?></span></p>
                    <p>
                        <span>Цена: </span>
                        <span>
                            <?php if(!empty($calculation->price)){ 
                                echo number_format($calculation->price)."₽"; 
                            }?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
    <?php endif; ?>
    
    <?php if (!empty($message)) : ?>
        <div class="col-md-4 mb-4 border border-dark rounded text-center p-3">
            <h3>Предупреждение</h3>
            <div class="row align-items-center mt-3">
                <div class="col-md-12 align-items-center">
                    <p><?= $message ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php Pjax::end() ?>

<script src="js/index.js"></script>