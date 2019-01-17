<?php
namespace common\models;

use Yii;
use yii\base\Model;
use \common\models\User;
use \common\components\M;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        M::printr('LoginForm.php function validatePassword($attribute, $params)');
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            M::printr($user, '$this->getUser()');
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        M::printr('LoginForm.php function login()');
        if ($this->validate()) {
            M::printr('to Yii::$app->user->login');
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            M::printr('FALSE');
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        M::printr('LoginForm.php function getUser()');
        M::printr($this->_user, '$this->_user');
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        M::printr($this->_user, '$this->_user');
        //exit;
        return $this->_user;
    }
}
