<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\base\Model;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class BaseApiController extends ActiveController
{

    /**
    * @param string $action the ID of the action to be executed
    * @param Model $model
    * @param array $params
    * @throws ForbiddenHttpException|ForbiddenHttpException if the user does not have access
    */
    public function checkAccess($action, $model = null, $params = [])
    {
        if ( in_array($action, ['create', 'update', 'delete'])) {
            $users = User::find()->all();
            foreach ($users as $user) {
                if ($user->accessToken === Yii::$app->request->get('access-token')) {
                    return true;
                }
            }
            throw new ForbiddenHttpException('Wrong access token');
        }
        return true;
    }
}