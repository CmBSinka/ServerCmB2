<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Test".
 *
 * @property int $1
 * @property int $2
 * @property int $3
 * @property int $4
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['2', '3', '4'], 'required'],
            [['2', '3', '4'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ];
    }
}
