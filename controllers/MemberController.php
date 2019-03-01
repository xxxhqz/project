<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\mongodb\Query;
use app\models\Member;
use yii\mongodb\Collection;
use yii\filters\AccessControl;

class MemberController extends Controller
{

    public $member_table = 'member';

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

    public function actionList(){
        $members = $this->get_members();

        return $this->render('list', $members);
    }

    public function actionCreate()
    {
        $model = new Member;

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $request = $post['member'];

            $collection = Yii::$app->mongodb->getCollection($this->member_table);

            $id = $collection->insert([
                'name' => $request['name'],
                'address' =>  $request['address'],
                'email' =>  $request['email'],
                'status' =>  2,//default
            ]);

            if(isset($id)){
                return $this->redirect(['view', 'id' => (string)$id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $this->logs($this->findModel($id));
        return $this->render('view', [
            'member' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id)
    {
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
                    'status' =>  $request['status'],
                     ];

                $post = Yii::$app->request->post();
                $request = $post['member'];

                $member->update(['_id' => $id],$updated);
            }
        }else{
            Yii::$app->session->setFlash('error','Something gone wrong!, Member does not exist ');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $member = $this->findModel($id);
        if($member){
            $member->delete();
            Yii::$app->session->setFlash('success','Member has been successfully deleted');
        }  else{
            Yii::$app->session->setFlash('error','Something gone wrong!, Member does not exist ');
        }

        $members = $this->get_members();

        return $this->render('list', $members);
    }

    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        }
        else return null;
        //throw new NotFoundHttpException('The requested page does not exist.');
    }

    //DELETE THIS FUNCTION FOR TESTING ONLY.
    //DELETE $this->logs() too
    public function logs($message){
        $date = date('d.m.Y h:i:s');
        $log = "[Date:  ".$date."]  -  Msg: display ".print_r($message, true) ."\n";
        error_log($log, 3, "c:/code/my-errors.log");
    }

}
