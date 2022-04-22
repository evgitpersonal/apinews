<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property-read mixed $categories
 * @property string $content
 */
class News extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
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
            'content' => 'Content',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'content',
            'categories',
        ];
    }

    public function getCategories()
    {
        return Category::find()->select('id, title')
            ->leftJoin('category_news',"category_news.category_id = category.id")
            ->where(['category_news.news_id' => $this->id])->asArray()->all();
    }
}
