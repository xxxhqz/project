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

    <p>
        <?= Html::a('Create a Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<br/>
    Total Member =  {{count}}
    <table class="table table-hover table-bordered  table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(member, index)  in members" v:on="table_row_color(member.status)">
                <td>{{ index+1 }}</td>
                <td>{{ member.name }}</td>
                <td>{{ member.address }}</td>
                <td>{{ member.email }}</td>
                <td><span v-if="member.status == 2" class="badge progress-bar-danger">NOT ACTIVE</span>
                <span v-else="member.status == 2" class="badge progress-bar-success">ACTIVE</span></td>
                <td>
                    <a v-bind:href="'view?id='+ member._id.$oid"> View </a>
                    <a v-bind:href="'update?id='+ member._id.$oid"> Edit </a>
                    <a v-on:click="deleteThis(member)"> Delete </a>
                </td>
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
        count : <?= json_encode($count)?>
    },
    methods:{
        deleteThis: function(member){
            var confirmation = confirm("Are you sure to delete "+member.name+" ?");
            var $id =  member._id.$oid;
            if(confirmation){
                window.location.href = "delete?id="+$id;
            }
        }
    }
})
</script>