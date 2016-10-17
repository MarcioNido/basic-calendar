<?php

namespace tests\codeception\unit\calendarUnit\models;

use Yii;
use yii\codeception\DbTestCase;
use app\tests\codeception\unit\calendarUnit\fixtures\EventFixture;
use app\tests\codeception\unit\calendarUnit\fixtures\CategoryFixture;
use app\modules\calendar\models\Event;

use Codeception\Specify;

/**
 * Test Class for model \app\modules\calendar\models\Category
 * @author Marcio Nido <marcionido@gmail.com>
 */
class EventTest extends DbTestCase
{
    use \Codeception\Specify;
    
    /**
     * Load fixtures for the tests
     * @return array fixtures to be loaded
     */
    public function fixtures() 
    {
        return [
            'events' => EventFixture::className(),
            'categories' => CategoryFixture::className(),
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
     * Tests model validation 
     */
    public function testEventValidation() 
    {
        
        $this->specify('Fixtures should be loaded', function () {
            $model = \app\modules\calendar\models\Category::findOne(['name' => 'General']);
            expect('model should not be null', $model)->notNull();
        });

        $this->specify('Event model should not accept empty required fields', function () {
            $model = new Event();
            $model->validate();
            expect('user_id is required', $model->errors)->hasKey('user_id');
            expect('category_id is required', $model->errors)->hasKey('category_id');
            expect('date is required', $model->errors)->hasKey('date');
            expect('time is required', $model->errors)->hasKey('time');
            expect('description is required', $model->errors)->hasKey('description');
            expect('no more fields required', count($model->errors))->equals(5);
        });
        
        $this->specify('Integer fields should not accept other types', function () {
            $model = new Event();
            $model->user_id = "aaa";
            $model->category_id = "bbb";
            expect('user_id must be a number', $model->validate(['user_id']))->false();
            expect('category_id must be a number', $model->validate(['category_id']))->false();
       });
       
       $this->specify('Foreign keys validation', function() {
           $model = new Event();
           $model->user_id = 999;
           $model->category_id = 999;
           expect('user_id is invalid', $model->validate(['user_id']))->false();
           expect('category_id is invalid', $model->validate(['category_id']))->false();
       });
        
    }
    
    /**
     * Tests CRUD
     */
    
    public function testEventCrud() 
    {
        $this->specify('Create New Event', function () {
            $model = new Event();
            $model->user_id = 2; // DEMO
            $model->category_id = 1; // General
            $model->date = '2016-09-28';
            $model->time = '19:00:00';
            $model->description = "Test event CRUD";
            expect('Saves successfuly', $model->save())->true();
            expect('Record is in database', $model->findOne(['description'=>'Test event CRUD']))->notNull();
        });
        
        $this->specify('Update Event Data', function() { 
            $model = Event::findOne(['description'=>'Test event CRUD']);
            $model->description = 'The test was ok';
//            if (! $model->save()) {
//                throw new \yii\base\Exception(print_r($model->errors, true));
//            }
            expect('Saves successfuly', $model->save())->true();
            expect('Updated Record is in database', $model->findOne(['description'=>'The test was ok']))->notNull();
            expect('Old data is not found', $model->findOne(['description' => 'Test event CRUD']))->null();
        });
        
        $this->specify('Delete Event', function() {
            $model = Event::findOne(['description'=>'The test was ok']);
            expect('Deletes record', $model->delete())->equals(1);
            expect('Record no longer exists', $model->findOne(['description'=>'The test was ok']))->null();
        });

        
    }

    
}
