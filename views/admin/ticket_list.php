<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ticket List';
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/admin">Admin Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$this->title?></li>
  </ol>
</nav>
<div class="dashboard" id="ticket-listing">

    <h1><?= Html::encode($this->title) ?></h1>
<br/>
    Total Ticket =  {{count}}
    <table class="table table-hover table-bordered  table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Body</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(ticket, index)  in tickets" v:on="table_row_color(ticket.status)">
                <td>{{ index+1 }}</td>
                <td>{{ ticket.name }}</td>
                <td>{{ ticket.email }}</td>
                <td>{{ ticket.subject }}</td>
                <td>{{ ticket.body }}</td>
                <td>
                    <a v-bind:href="'ticket_view?id='+ ticket._id.$oid"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;
                    <a v-bind:href="'ticket_update?id='+ ticket._id.$oid"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
                    <a v-on:click="deleteThis(ticket)"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
        </tbody>
        <tfoot></tfoot>
    </table>

</div>


<script>
var ticket;
var count;
var app = new Vue({
    el: '#ticket-listing',
    data: {
        tickets : <?= json_encode($tickets)?>,
        count : <?= json_encode($count)?>
    },
    methods:{
        deleteThis: function(ticket){
            var confirmation = confirm("Are you sure to delete "+ticket.name+" ?");
            var $id =  ticket._id.$oid;
            if(confirmation){
                window.location.href = "ticket_delete?id="+$id;
            }
        }
    }
})
</script>