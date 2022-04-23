<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

/**
 * NewsController implements the CRUD actions for News model.
 */
class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->enableSession = false;
    }


    /**
     * @param string $action the ID of the action to be executed
     * @param Model $model
     * @param array $params
     * @throws ForbiddenHttpException|ForbiddenHttpException if the user does not have access
     */
    public function checkAccess($action, $model = null, $params = [])
    {

        if($action === 'index'){
            throw new ForbiddenHttpException('Access denied');
        }
        elseif ( in_array($action, ['view', 'update', 'delete']) ) {
            $users = User::find()->asArray()->all();
            foreach ($users as $user) {
                if ( $user['accessToken'] === Yii::$app->request->get('access-token')
                        && (int)$user['id'] === (int)$this->actionParams['id'] ) {
                    return true;
                }
            }
            throw new ForbiddenHttpException('Access denied');
        }
        return true;
    }



}
