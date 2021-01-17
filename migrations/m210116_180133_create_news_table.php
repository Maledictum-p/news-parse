<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m210116_180133_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */


    public function safeUp()
    {
        $this->createTable('{{news}}', [
            'newsId' => $this->primaryKey(),
            'name' => $this->string(),
            'mainTag' => $this->string(),
            'date' => $this->timestamp(),
            'html' => $this->text(),
						'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{news}}');
    }
}
