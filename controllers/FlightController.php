<?php
namespace app\controllers;
use Yii;
use app\models\Flight;
use yii\filters\auth\HttpBearerAuth;
use function PHPUnit\Framework\returnArgument;
use yii\rest\ActiveController;
class FlightController extends FunctionController
{

    public function behaviors()
    {
        /*
         * Указание на аутентификации по токену
         */
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['create', 'red', 'del'] //Перечислите для контроллера методы, требующие аутентификации
            //здесь метод actionAccount()
        ];
        return $behaviors;
    }

    public $modelClass = 'app\models\Flight';

    public function actionCreate(){
        $request=Yii::$app->request->post(); //получение данных из post запроса
        $flight=Yii::$app->user->identity;
        $flight=new Flight($request); // Создание модели на основе присланных данных
        if (!$flight->validate()) return $this->validation($flight); //Валидация модели
        $flight->save();//Сохранение модели в БД
        return $this->send(200, ['content'=>['code'=>200, 'status'=>'ok']]);//Отправка сообщения пользователю
    }
    public function actionTickets()
    {
        $flight = Flight::find()->indexBy('id')->all();
        return $this->send(200, ['content'=> ['Билеты'=>$flight]]);
    }
    public function  actionRed($id)
    {

        $user=Yii::$app->user->identity; // Получить идентифицированного пользователя
        $request=Yii::$app->request->getBodyParams();
        $flight=Flight::findOne($id);
       // die($flight-$id);
        if (!$flight) return $this->send(404,  ['content'=>['code'=>404, 'message'=>'Рейс не найден']]);
       // return $this->send(200, $flight);
        if (isset($request['code'])) $flight->code = $request['code'];
        if (isset($request['FlightFrom'])) $flight->FlightFrom = $request['FlightFrom'];
        if (isset($request['FlightTo'])) $flight->FlightTo = $request['FlightTo'];
        if (isset($request['count'])) $flight->count = $request['count'];
        if (isset($request['timestart'])) $flight->timestart = $request['timestart'];
        if (isset($request['timefinish'])) $flight->timefinish = $request['timefinish'];
        if (isset($request['status'])) $flight->status = $request['status'];

        if (!$flight->validate()) return $this->validation($flight);
        $flight->save();
        return $this->send(200, ['content'=>['code'=>200, 'message'=>'Данные обновлены']]);

    }
    public function actionDel($id)
    {
        $flight = Flight::findOne($id);
        $flight->delete();
        return $this->send(200, ['content'=> ['Status'=>'ok']]);
    }
}
?>
