<?php

use yii\db\Migration;

class m161118_135603_test_article_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'video' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%article}}');
    }
}
