<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m161017_174848_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'user_id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'username' => $this->string(30)->notNull(),
            'password' => $this->string(100)->notNull(),
            'active' => $this->smallInteger(1)->defaultValue(1)->notNull(),
            'access_token' => $this->string(100)->null(),
            'auth_key' => $this->string(100)->null(),
        ]);
        
        $this->createIndex('idx_username', 'user', 'username', true);
        
        $this->insert('user', array(
            'name' => 'ADMIN',
            'username' => 'ADMIN',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('ADMIN'),
            'active' => 1,
            'access_token' => null,
            'auth_key' => '9CEQD9h51DASTja10X1zCaGDCPyp9Lnv',
        ));
        
        $this->insert('user', array(
            'name' => 'DEMO',
            'username' => 'DEMO',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('DEMO'),
            'active' => 1,
            'access_token' => null,
            'auth_key' => 'qN38K8lRV7nVmrJPhkcVpUmsceLqoeKN',
        ));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
