<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\mongodb\Query;
use app\models\Member;
use yii\mongodb\Collection;
use yii\filters\AccessControl;

class AdminController extends Controller
{

    public $member_table = 'member';
    public $contact_table = 'contact';

    public function actionDashboard(){
        return $this->render('dashboard');
    }

    public function get_members(){
        $query = new Query;
        $members = $query->from($this->member_table)
                ->all();

        $count = $query->from($this->member_table)
                ->count();

        return array(
            'members'=>$members,
            'count' => $count
        );
    }

    public function actionMemberList(){
        $members = $this->get_members();

        return $this->render('member_list', $members);
    }

    public function actionMemberCreate(){
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
                    'status' =>  2,//default
                ]);
            }
            if(isset($id)){
                return $this->redirect(['member_view', 'id' => (string)$id]);
            }

        }

        return $this->render('member_create', [
            'model' => $model,
        ]);
    }

    public function actionMemberView($id){
        $this->logs($this->findModel($id));
        return $this->render('member_view', [
            'member' => $this->findModel($id),
        ]);
    }

    public function actionMemberUpdate($id){
        $model = $this->findModel($id);
        $existing_data = $model;

        if(isset($model)){
            if ($model->load(Yii::$app->request->post())) {

                $post = Yii::$app->request->post();
                $request = $post['member'];

                $member = Yii::$app->mongodb->getCollection($this->member_table);

                $updated = [
                    'name' => $request['name'],
                    'address' =>  $request['address'],
                    'email' =>  $request['email'],
                    'username' =>  $request['username'],
                    'status' =>  $request['status'],
                     ];

                $post = Yii::$app->request->post();
                $request = $post['member'];

                if($member->update(['_id' => $id],$updated)){
                    Yii::$app->session->setFlash('success', 'Successully updated');
                    return $this->redirect(['member_view', 'id' => (string)$id]);
                }
            }
        }else{
            Yii::$app->session->setFlash('error','Something gone wrong!, Member does not exist ');
        }

        return $this->render('member_update', [
            'model' => $model,
        ]);
    }

    public function actionMemberDelete($id){
        $member = $this->findModel($id);

        $members = $this->get_members();

        if($member){
            $member->delete();
            Yii::$app->session->setFlash('success','Member has been successfully deleted');
            return $this->render('member_list', $members);
        }  else{
            Yii::$app->session->setFlash('error','Something gone wrong!, Member does not exist ');
        }

        return $this->render('member_list', $members);
    }

    protected function findModel($id){
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        }
        else return null;
        //throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function get_tickets(){
        $query = new Query;
        $tickets = $query->from($this->contact_table)
                ->all();

        $count = $query->from($this->contact_table)
                ->count();

        return array(
            'tickets'=>$tickets,
            'count' => $count
        );
    }

    public function actionTicketList(){
        $tickets = $this->get_tickets();

        return $this->render('ticket_list', $tickets);
    }

    //DELETE THIS FUNCTION FOR TESTING ONLY.
    //DELETE $this->logs() too
    public function logs($message){
        $date = date('d.m.Y h:i:s');
        $log = "[Date:  ".$date."] A -  Msg: display ".print_r($message, true) ."\n";
        error_log($log, 3, "c:/code/my-errors.log");
    }

}
