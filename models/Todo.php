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
            ['description, sort', 'safe', 'on' => 'search'],
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

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->sort = Yii::app()->db->createCommand()
                ->select('MAX(sort) + 1')
                ->from($this->tableName())
                ->queryScalar();
        }

        return parent::beforeSave();
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('description', $this->description, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'sort' => [
                'defaultOrder' => 'sort'
            ]
        ]);
    }

    /**
     * Count all unfinished tasks
     *
     * @return int
     */
    public function countUnfinished()
    {
        return self::model()->count('status != :status', [':status' => TodoStatusHelper::STATUS_DONE]);
    }
}