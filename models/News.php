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
            [['title', 'content'], 'required'],
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

    /**
     * @return string[]
     */
    public function fields()
    {
        return [
            'id',
            'title',
            'content',
            'categories',
        ];
    }

    /**
     * @return Category[]|array|ActiveRecord[]
     */
    public function getCategories()
    {
        return Category::find()->select('id, title')
            ->leftJoin('category_news',"category_news.category_id = category.id")
            ->where(['category_news.news_id' => $this->id])->asArray()->all();
    }

    /**
     * @throws \Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $categories = Yii::$app->request->getBodyParam('categories', 0);
        CategoryNews::deleteAll([
            'news_id' => $this->id
        ]);
        if( is_array($categories) ) {
            foreach ($categories as $category_id) {
                $category_id = (int)$category_id;
                if( Category::find()->where("id = $category_id")->exists() ) {
                    $CategoryNews = new CategoryNews();
                    $CategoryNews->category_id = $category_id;
                    $CategoryNews->news_id = $this->id;
                    $CategoryNews->save();
                }
            }
        } else {
            $CategoryNews = new CategoryNews();
            $CategoryNews->category_id = (int)$categories;
            $CategoryNews->news_id = $this->id;
            $CategoryNews->save();
        }
    }

    /**
     * @return void
     */
    public function afterDelete()
    {
        CategoryNews::deleteAll([
            'news_id' => $this->id
        ]);
    }

}
