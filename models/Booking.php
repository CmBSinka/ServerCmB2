<?php

namespace app\models;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int|null $flight_id
 * @property int|null $user_id
 * @property string $flight_data
 *
 * @property Flight $flight
 * @property User $user
 */
class Booking extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flight_data'], 'required'],
            [['id', 'flight_id', 'user_id'], 'integer'],
            [['flight_data'], 'safe'],
            [['id'], 'unique'],
            [['flight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flight::className(), 'targetAttribute' => ['flight_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flight_id' => 'Flight ID',
            'user_id' => 'User ID',
            'flight_data' => 'Flight Data',
        ];
    }

    /**
     * Gets query for [[Flight]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlight()
    {
        return $this->hasOne(Flight::className(), ['id' => 'flight_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
