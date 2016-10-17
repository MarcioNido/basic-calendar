<?php

namespace tests\codeception\unit\calendarUnit\models;

use Yii;
use yii\codeception\DbTestCase;
use app\tests\codeception\unit\calendarUnit\fixtures\CategoryFixture;
use app\tests\codeception\unit\calendarUnit\fixtures\EventFixture;
use app\modules\calendar\models\Category;
use app\modules\calendar\models\Event;

use Codeception\Specify;

/**
 * Test Class for model \app\modules\calendar\models\Category
 * @author Marcio Nido <marcionido@gmail.com>
 */
class CategoryTest extends DbTestCase
{
    use \Codeception\Specify;
    
    /**
     * Load fixtures for the tests
     * @return array fixtures to be loaded
     */
    public function fixtures() 
    {
        return [
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
    
    
    public function testFixturesAreLoaded() { 
        $this->specify('Fixture data should be loaded', function() {
            expect('Category 1 is loaded', Category::findOne(1))->notNull();
        });
    }
    
    /**
     * Tests model validation 
     */
    public function testCategoryValidators() 
    {

        $this->specify('Category model should not accept empty required fields', function () {
            $model = new Category();
            $model->validate();
            expect('name is required', $model->errors)->hasKey('name');
            expect('no more fields required', count($model->errors))->equals(1);
        });
        
        $this->specify('String fields too long', function () {
            $model = new Category();
            $model->name = str_repeat('A', 31);
            expect('name too long', $model->validate(['name']))->false();
       });
        
    }
    
    /**
     * Tests CRUD
     */
    public function testCategoryCrud() 
    {
        $this->specify('Create New Category', function () {
            $model = new Category();
            $model->name = 'New Category';
            expect('Saves successfuly', $model->save())->true();
            expect('Record is in database', $model->findOne(['name'=>'New Category']))->notNull();
        });
        
        $this->specify('Update Category Data', function() { 
            $model = Category::findOne(['name'=>'New Category']);
            $model->name = 'Old Category';
            expect('Saves successfuly', $model->save())->true();
            expect('Updated Record is in database', $model->findOne(['name'=>'Old Category']))->notNull();
        });
        
        $this->specify('Delete Category', function() {
            $model = Category::findOne(['name'=>'Old Category']);
            expect('Deletes record', $model->delete())->equals(1);
            expect('Record no longer exists', $model->findOne(['name'=>'Old Category']))->null();
        });
               
    }
    
}
