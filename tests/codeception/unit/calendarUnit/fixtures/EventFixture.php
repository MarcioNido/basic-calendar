<?php
namespace app\tests\codeception\unit\calendarUnit\fixtures;
use yii\test\ActiveFixture;
/**
 * Description of CategoryFixture
 *
 * @author Marcio
 */
class EventFixture extends ActiveFixture {
    
    public $modelClass = 'app\modules\calendar\models\Event';
    public $depends = ['app\tests\codeception\fixtures\UserFixture', 'app\tests\codeception\calendarUnit\fixtures\CategoryFixture'];
    
}
