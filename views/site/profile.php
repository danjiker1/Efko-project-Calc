<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">
    <h2><?= $userProfile->username ?></h2>
    <p>Почта: <?= $userProfile->email ?></p>
    <p>Роль: <?= $userProfile->role ?></p>
</div>

<style>
    .user-profile {
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    p {
        font-size: 16px;
        margin-bottom: 5px;
    }
</style>