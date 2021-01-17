<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%newstag}}`.
 */
class m210116_180326_create_newstag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{newstag}}', [
            'tagId' => $this->primaryKey(),
            'newsId' => $this->integer(),
            'name' => $this->string(),
						'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{newstag}}');
    }
}
