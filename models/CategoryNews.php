<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_news".
 *
 * @property int $category_id
 * @property int $news_id
 */
class CategoryNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'news_id'], 'required'],
            [['category_id', 'news_id'], 'integer'],
            [['category_id', 'news_id'], 'unique', 'targetAttribute' => ['category_id', 'news_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'news_id' => 'News ID',
        ];
    }
}
