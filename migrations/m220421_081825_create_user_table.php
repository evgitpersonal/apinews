<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220421_081825_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull()->defaultValue(''),
            'password' => $this->string()->notNull()->defaultValue(''),
            'accessToken' => $this->string()->notNull()->defaultValue(''),
        ]);
        $this->createIndex(
            'idx-user-accessToken',
            'user',
            'accessToken'
        );
        $access_token = Yii::$app->security->generateRandomString(15);
        $this->insert('user', [
            'username' => 'admin',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'accessToken' => $access_token,
        ]);
        echo "\nAccess token for login 'admin': $access_token \n\n";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-user-accessToken',
            'user'
        );
        $this->delete('user', ['id' => 1]);
        $this->dropTable('user');
    }
}
