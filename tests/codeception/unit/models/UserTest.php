<?php

namespace tests\codeception\unit\models;

use Yii;
use yii\codeception\DbTestCase;
use app\tests\codeception\fixtures\UserFixture;
use app\models\User;

use Codeception\Specify;

/**
 * Test Class for model \app\models\User
 * @author Marcio Nido <marcionido@gmail.com>
 */
class UserTest extends DbTestCase
{
    use \Codeception\Specify;
    
    /**
     * Load fixtures for the tests
     * @return array fixtures to be loaded
     */
    public function fixtures() 
    {
        return [
            'users' => UserFixture::className(),
        ];
    }
    
    /**
     * Executes before tests
     */
    protected function setUp()
    {
        // nothing else to do for this test
        parent::setUp();
    }
    
    /**
     * Tests user model validation 
     */
    public function testValidators() 
    {

        $this->specify('Fixtures should be loaded', function() {
           expect('User BUDDY is in the table', User::findOne(['name'=>'BUDDY']))->notNull(); 
        });
        
        $this->specify('User model should not accept empty required fields', function () {
            $model = new User();
            $model->validate();
            expect('name is required', $model->errors)->hasKey('name');
            expect('username is required', $model->errors)->hasKey('username');
            expect('password is required', $model->errors)->hasKey('password');
            expect('no more fields required', count($model->errors))->equals(3);
        });
        
        $this->specify('validate fields too long', function () {
            $model = new User();
            $model->name = str_repeat('A', 51);
            $model->username = str_repeat('A', 31);
            $model->password = str_repeat('A', 101);
            $model->access_token = str_repeat('A', 101);
            $model->auth_key = str_repeat('A', 101);
            expect('name too long', $model->validate(['name']))->false();
            expect('username too long', $model->validate(['username']))->false();
            expect('password too long', $model->validate(['password']))->false();
            expect('access_token too long', $model->validate(['access_token']))->false();
            expect('auth_key too long', $model->validate(['auth_key']))->false();
        });

        $this->specify('validate username cannot be duplicated', function() {
            $model = new User();
            $model->username = 'ADMIN';
            expect('username is duplicated', $model->validate(['username']))->false();
        });
        
    }
    
    /**
     * Tests Create, Update and Delete for the user model
     */
    public function testCrudUser() 
    {
        $this->specify('Create New User', function () {
            $model = new User();
            $model->name = 'John Doe';
            $model->username = 'JohnDoe';
            $model->password = Yii::$app->getSecurity()->generatePasswordHash('123456');
            $model->active = 1;
            expect('Saves successfuly', $model->save())->true();
            expect('Record is in database', $model->findOne(['username'=>'JohnDoe']))->notNull();
        });
        
        $this->specify('Update User Data', function() { 
            $model = User::findOne(['username'=>'JohnDoe']);
            $model->name = 'Jane Doe';
            expect('Saves successfuly', $model->save())->true();
            expect('Updated Record is in database', $model->findOne(['name'=>'Jane Doe']))->notNull();
        });
        
        $this->specify('Delete User', function() {
            $model = User::findOne(['username'=>'JohnDoe']);
            expect('Deletes record', $model->delete())->equals(1);
            expect('Record no longer exists', $model->findOne(['username'=>'JohnDoe']))->null();
        });
        
    }
    
}
