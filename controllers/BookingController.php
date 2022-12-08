<?php
namespace app\controllers;
use app\models\Flight;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use function PHPUnit\Framework\returnArgument;
use Yii;
use app\models\Booking;
use app\models\User;
class BookingController extends FunctionController
{

    public function behaviors()
    {
        /*
         * Указание на аутентификации по токену
         */
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['order'] //Перечислите для контроллера методы, требующие аутентификации
            //здесь метод actionAccount()
        ];
        return $behaviors;
    }

    public $modelClass = 'app\models\Booking';

    public function actionOrder($id){
        $user=Yii::$app->user->identity; // Получить идентифицированного пользователя
        $request=Yii::$app->request->getBodyParams();

        $flight=Flight::findOne($id);
        if (!$flight) return $this->send(404,  ['content'=>['code'=>404, 'message'=>'Рейс не найден']]);


        if (!$user) return $this->send(404,  ['content'=>['code'=>404, 'message'=>'Пользователь не найден']]);

        $booking=new Booking();
        $booking->flight_id=$id;
        $booking->user_id=$user->id;
        $booking->flight_data=$request['flight_data'];
        if (!$booking->validate()) return $this->validation($booking); //Валидация модели
        $booking->save();//Сохранение модели в БД
        return $this->send(200, $booking);//Отправка сообщения пользователю
    }
}
?>
