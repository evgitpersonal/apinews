<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220421_081837_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->text()->notNull()->defaultValue(''),
        ]);

        $this->batchInsert('category', ['title', 'description'], [
            ['Ukraine', 'News from Ukraine'],
            ['Europe', 'News from Europe'],
            ['World', 'News from World'],
        ]);
        echo "\nTest category news: Ukraine, Europe, World \n\n";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
