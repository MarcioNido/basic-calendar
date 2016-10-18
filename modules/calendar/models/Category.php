<?php

namespace app\modules\calendar\models;

use Yii;

/**
 * This is the model class for table "cal_category".
 *
 * @property integer $category_id
 * @property string $name
 * @property integer $active
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cal_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'name' => 'Name',
            'active' => 'Active',
        ];
    }
    
    /**
     * Used in dropdownlists 
     * @return array list of active records
     */
    public static function getDropDownList()
    {
        $array = static::find()->asArray()->where(['active' => 1])->orderBy('name')->all();
        return \yii\helpers\ArrayHelper::map($array, 'category_id', 'name');
    }
    
    
}
