<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m220421_081850_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique()->defaultValue(''),
            'content' => $this->text()->notNull()->defaultValue(''),
        ]);


        $this->batchInsert('news', ['title', 'content'], [
            ['News from Ukraine 1', 'Content for news from Ukraine 1'],
            ['News from Ukraine 2', 'Content for news from Ukraine 2'],
            ['News from Europe 1', 'Content for news from Europe 1'],
            ['News from World 1', 'Content for news from World 1'],
        ]);

        $this->batchInsert('category_news', ['news_id', 'category_id'], [
            [1, 1], [2, 1], [2, 3], [3, 2], [3, 3], [4, 3]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('category_news', ['news_id' => [1, 2, 3]]);
        $this->dropTable('news');
    }
}
