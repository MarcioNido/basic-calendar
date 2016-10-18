<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category`.
 */
class m161017_225813_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cal_category', [
            'category_id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'active' => $this->integer(1)->defaultValue(1),
        ]);
        
        // insert a general category ... 
        $this->insert('cal_category', [
            'name' => 'General',
        ]);
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cal_category');
    }
    
}
