<?php

use yii\db\Migration;

/**
 * Handles the creation for table `event`.
 */
class m161018_010248_create_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cal_event', [
            'event_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'date'=>$this->date()->notNull(),
            'time'=>$this->time()->notNull(),
            'description'=>$this->string(500)->notNull(),
            'active' => $this->integer(1)->defaultValue(1),
            'done' => $this->integer(1)->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-cal_event-user_id',
            'cal_event',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-cal_event-user_id',
            'cal_event',
            'user_id',
            'user',
            'user_id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-cal_event-category_id',
            'cal_event',
            'category_id'
        );

        // add foreign key for table `cal_category`
        $this->addForeignKey(
            'fk-cal_event-category_id',
            'cal_event',
            'category_id',
            'cal_category',
            'category_id',
            'CASCADE'
        );
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-cal_event-user_id',
            'cal_event'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-cal_event-user_id',
            'cal_event'
        );

        // drops foreign key for table `cal_category`
        $this->dropForeignKey(
            'fk-cal_event-category_id',
            'cal_event'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-cal_event-category_id',
            'cal_event'
        );

        $this->dropTable('cal_event');
    }

}
