<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\mongodb\Query;
use yii\mongodb\Collection;
use yii\filters\AccessControl;
use app\models\Member;
use app\models\Admin;
use app\models\Contact;
use app\models\LoginForm;
use app\models\SignupForm;


class PageController extends Controller
{

    public $member_table = 'member';
    public $admin_table = 'admin';
    public $contact_table = 'contact';
    public $defaultAction = 'login';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load($_POST) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);

    }

    public function actionLogout()
    {
        unset($_SESSION['current_user']);
        unset($_SESSION['login_as']);

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new contact();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $request = $post['contact'];

            $contact_collection = Yii::$app->mongodb->getCollection($this->contact_table);

            $new_entry = $contact_collection->insert([
                'name' => $request['name'],
                'email' =>  $request['email'],
                'subject' =>  $request['subject'],
                'body' =>  $request['subject'],
                'created_at' =>  strtotime("now")
            ]);

            if(isset($new_entry)){
                Yii::$app->session->setFlash('contactFormSubmitted');

                return $this->refresh();
            }

        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup(){
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

    //DELETE THIS FUNCTION FOR TESTING ONLY.
    //DELETE $this->logs() too
    public function logs($message){
        $date = date('d.m.Y h:i:s');
        $log = "[Date:  ".$date."]  -  Msg: display ".print_r($message, true) ."\n";
        error_log($log, 3, "c:/code/my-errors.log");
    }

}
