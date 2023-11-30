<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
        ];
    }

    public function login()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = User::findByUsername($this->username);
        
        if (!$user || !$user->validatePassword($this->password)) {
            return null;
        }
        
        return Yii::$app->user->login($user);
    }
}
