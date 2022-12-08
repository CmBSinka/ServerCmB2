<?php

namespace app\models;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "flight".
 *
 * @property int $id
 * @property string|null $code
 * @property string $FlightFrom
 * @property string $FlightTo
 * @property string|null $timestart
 * @property string|null $timefinish
 * @property string $status
 *
 * @property Booking[] $bookings
 */
class Flight extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'flight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FlightFrom', 'FlightTo', 'status'], 'required'],
            [['timestart', 'timefinish'], 'safe'],
            [['code'], 'string', 'max' => 5],
            [['FlightFrom', 'FlightTo', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'FlightFrom' => 'Flight From',
            'FlightTo' => 'Flight To',
            'timestart' => 'Timestart',
            'timefinish' => 'Timefinish',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['flight_id' => 'id']);
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return ;
    }

    public function validateAuthKey($authKey)
    {
        return ;
    }
    public function validatePassword($password)

    {
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);

        if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
            return $this;
        } else {
            return 0;
        }


    }
}
