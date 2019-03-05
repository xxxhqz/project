<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = "Member Details";
\yii\web\YiiAsset::register($this);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/admin">Admin Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/admin/member_list">Members List</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$this->title?></li>
  </ol>
</nav>

<div class="posts-view" id="member-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a class="btn btn-primary" v-bind:href="'member_update?id='+ id.$oid"> Update </a>
        <a v-on:click="deleteThis" class="btn btn-danger">Delete</a>

</p>
<br/>
    <table class="table table-hover table-bordered  table-striped">
        <tr>
            <th width="200px">Name:</th>
            <td>{{ name }}</td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{ username }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ email }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ address }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td><span v-if="status == 2" class="badge progress-bar-danger">NOT ACTIVE</span>
                <span v-else="status == 2" class="badge progress-bar-success">ACTIVE</span></td>
        </tr>
    </table>
</div>

<script>
    var member;
    var count;
    var app = new Vue({
        el: '#member-view',
        data: {
            name : <?=json_encode($member->name); ?>,
            address : <?=json_encode($member->address); ?>,
            email : <?=json_encode($member->email); ?>,
            username : <?=json_encode($member->username); ?>,
            status : <?=json_encode($member->status); ?>,
            id : <?=json_encode($member->_id); ?>
        },
        methods:{
            deleteThis:function(){
                var confirmation = confirm("Are you sure to delete "+this.name+" ?");
                var _id = this.id.$oid;
                if(confirmation){
                    window.location.href = "member_delete?id="+ _id;
                    console.log(this.name);
                }
            }
        }
    })
</script>