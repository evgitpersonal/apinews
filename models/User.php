<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;


class User extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string'],
        ];
    }

    /**
     * @throws Exception
     */
    public function beforeSave($insert)
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $this->accessToken = Yii::$app->security->generateRandomString(15);
        return parent::beforeSave($insert);
    }


}
