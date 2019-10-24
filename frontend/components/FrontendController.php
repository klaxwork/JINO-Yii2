<?php
namespace frontend\components;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\M;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\controllers;

/**
 * Site controller
 */
class FrontendController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['*'], //['logout', 'signup'],
                'rules' => [
                    [
                        //'actions' => ['index'],
                        'allow' => true,
                        //'roles' => ['?'],
                    ],
                    /*/
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    //*/
                ],
            ],
            /*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            //*/
        ];
    }

    public function accessCheckFunction()
    {
        $res = [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
        return $res;
        /*/
        //M::printr(Yii::app()->user->returnUrl, 'Yii::app()->user->returnUrl');
        //exit;
        if (Yii::app()->region->domain == "2fs.ru") {
            //return true;
        }
        $module = $this->module ? $this->module->id . '.' : '';
        $controller = $this->id;
        $action = $this->action->id;

        //M::printr($module, '$module');
        //M::printr($controller, '$controller');
        //M::printr($action, '$action');

        $routes = array();
        $routes[] = $module . $controller . '.' . $action;
        $routes[] = $module . $controller . '.*';
        $routes[] = $module . '*';
        $routes[] = '*';
        //M::printr($routes, '$routes');

        $auth = [
            'cabinet.cabinet.*',
        ];
        $allow = [
            '*',
        ];

        //найти адрес среди требующих авторизацию
        $is_allow = true;
        foreach ($routes as $route) {
            if (in_array($route, $auth)) {
                if (!Yii::app()->user->id) {
                    $is_allow = false;
                    $this->redirect(array('/cabinet/auth/login'));
                }
            }
        }
        return $is_allow;
        //*/

    }
}
