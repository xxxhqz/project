<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard" id="member-listing">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<br/>
    Total Member =  {{count}}
    <table class="table table-hover table-bordered  table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(member, index)  in members" v:on="table_row_color(member.status)">
                <td>{{ index+1 }}</td>
                <td>{{ member.name }}</td>
                <td>{{ member.username }}</td>
                <td>{{ member.email }}</td>
                <td>{{ member.address }}</td>
                <td><span v-if="member.status == 2" class="badge progress-bar-danger">NOT ACTIVE</span>
                <span v-else="member.status == 2" class="badge progress-bar-success">ACTIVE</span></td>
                <td><center>
                    <a v-show="accountOwner(member._id.$oid)" v-bind:href="'view?id='+ member._id.$oid"><span class="glyphicon glyphicon-eye-open"></span></a> &nbsp;
                    <a v-show="accountOwner(member._id.$oid)" v-bind:href="'update?id='+ member._id.$oid"><span class="glyphicon glyphicon-pencil"></span></a> &nbsp;
                    <a v-show="accountOwner(member._id.$oid)" v-on:click="deleteThis(member)"><span class="glyphicon glyphicon-remove"></span></a>
                </center></td>
            </tr>
        </tbody>
        <tfoot></tfoot>
    </table>

</div>


<script>
var member;
var count;
var app = new Vue({
    el: '#member-listing',
    data: {
        members : <?= json_encode($members)?>,
        count : <?= json_encode($count)?>,
        current_user_id: '<?= $_SESSION['current_user']->_id?>'
    },
    methods:{
        deleteThis: function(member){
            var confirmation = confirm("Are you sure to delete "+member.name+" ?");
            var $id =  member._id.$oid;
            if(confirmation){
                window.location.href = "delete?id="+$id;
            }
        },
        accountOwner:function(member_id){
            return (this.current_user_id === member_id);
        }
    }
})
</script>