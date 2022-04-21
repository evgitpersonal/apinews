<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_news}}`.
 */
class m220421_081848_create_category_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_news', [
            'category_id' => $this->integer()->notNull()->defaultValue(0),
            'news_id' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-category_news-category_id-news_id',
            'category_news',
            ['category_id', 'news_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-category_news-category_id-news_id',
            'category_news'
        );
        $this->dropTable('category_news');
    }
}
