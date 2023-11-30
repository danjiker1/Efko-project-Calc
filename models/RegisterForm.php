<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $password_repeat;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        
            [['username', 'password', 'email'], 'required'],
            ['username', 'unique', 'targetClass'=>'\app\models\User', 'message'=>'Такой пользователь уже существует'],
            ['email', 'unique', 'targetClass'=>'\app\models\User', 'message'=>'Такой email уже есть в системе'],
            ['email', 'email'],
            ['password', 'string', 'min'=>6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password'],
        ];
    }

    public function register()
    {
        if(!$this->validate()){
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->password = $this->password;
        $user->email = $this->email;
        $user->HashPassword($this->password);
    
        return $user->save() ? $user : null;
    }
}
