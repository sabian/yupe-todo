<?php
use yupe\models\YModel;

/**
 * Class Todo
 *
 * @property integer $id
 * @property string $description
 * @property integer $status
 * @property integer $sort
 */
class Todo extends YModel
{
    /**
     * @return string
     */
    public function tableName()
    {
        return '{{todo}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['description', 'required'],
            ['description', 'length', 'max' => 255],
            ['status, sort', 'numerical', 'integerOnly' => true],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'description' => 'Описание',
            'status' => 'Статус',
            'sort' => 'Сортировка',
        ];
    }
}