<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property-read mixed $news
 * @property string $description
 */
class Category extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'description',
            'news',
        ];
    }

    public function getNews()
    {
        return News::find()->select('id, title, content')
            ->leftJoin('category_news',"category_news.news_id = news.id")
            ->where(['category_news.category_id' => $this->id])->asArray()->all();
    }
}
