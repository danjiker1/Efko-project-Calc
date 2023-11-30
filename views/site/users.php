<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $users app\models\User[] */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Имя пользователя</th>
            <th>Электронная почта</th>
            <th>Роль</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->role ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>