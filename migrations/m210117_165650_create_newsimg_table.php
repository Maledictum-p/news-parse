<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%newsimg}}`.
 */
class m210117_165650_create_newsimg_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%newsimg}}', [
            'imgId' => $this->primaryKey(),
            'extlink' => $this->string(),
            'link' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%newsimg}}');
    }
}
