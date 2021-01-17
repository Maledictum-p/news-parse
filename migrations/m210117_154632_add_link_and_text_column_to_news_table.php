<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%news}}`.
 */
class m210117_154632_add_link_and_text_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{news}}', 'link', $this->string());
        $this->addColumn('{{news}}', 'text', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{news}}', 'link');
        $this->dropColumn('{{news}}', 'text');
    }
}
