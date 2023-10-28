<?php

namespace app\models;

use webvimark\modules\UserManagement\components\UserIdentity;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['email', 'password'], 'required', 'message' => 'Complete el campo'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword()
    {
        if(!Yii::$app->getModule('user-management')->checkAttempts()){
            $this->addError('password', UserManagementModule::t('front', 'Demasiados intentos'));

            return false;
        }

        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', UserManagementModule::t('front', 'Correo electrinico o contraseña incorrecta'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        if ($this->validate()) { //$this->rememberMe ? 3600*24*30 : 0
            $user = $this->getUser();
            if($user == null){
                Yii::$app->session->setFlash('error', 'Error no pudimos recuperar su información');
                return false;
            }

            return Yii::$app->user->login($user, $this->rememberMe ? Yii::$app->user->cookieLifetime : 0);
        }
        return false;
    }

    private function getUser() : UserIdentity
    {
        if($this->_user === false){
            $identity = new Yii::$app->user->identityClass;

            if(!$identity instanceof User){
                $this->_user = User::findByEmail($this->email);
            }else{
                $this->_user = $identity->findByEmail($this->email);
            }
        }

        return $this->_user;
    }
}
