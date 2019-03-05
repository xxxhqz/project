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

    public function checkOnlyGuest(){
        if(isset($_SESSION['login_as'])){
            // throw new \yii\web\HttpException(403, 'You are not authorized to access this area.');
            $this->goHome();
        }else
            return true;
    }

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionLogin() {
        $this->checkOnlyGuest();

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
        $this->checkOnlyGuest();

        $model = new Member;

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $request = $post['member'];

            if($request['password'] !== $request['confirm_password']){
                Yii::$app->session->setFlash('error','Confirm password did not match with Password');
            }

            if($request['password'] == $request['confirm_password']){
                $collection = Yii::$app->mongodb->getCollection($this->member_table);
                $id = $collection->insert([
                    'name' => $request['name'],
                    'address' =>  $request['address'],
                    'email' =>  $request['email'],
                    'username' =>  $request['username'],
                    'password' =>  $request['password'],
                    'status' => (int) 2,
                ]);

                if(isset($id)){
                    Yii::$app->session->setFlash('successRegister');
                }
            }

        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionResetPassword(){
        $model = new LoginForm();
        $model->password = 'reset';
        $new_password = '';

        if ($model->load($_POST)) {
            $new_password = $model->reset_password();
            Yii::$app->session->setFlash('successResetPassword');
        }

        return $this->render('reset_password', [
            'model' => $model, 'new_password' => $new_password
        ]);
    }

    //DELETE THIS FUNCTION FOR TESTING ONLY.
    //DELETE $this->logs() too
    public function logs($message){
        $date = date('d.m.Y h:i:s');
        $log = "[Date:  ".$date."]  -  Msg: display ".print_r($message, true) ."\n";
        error_log($log, 3, "c:/code/my-errors.log");
    }

}
