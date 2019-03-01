<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Dashboard ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>

    </p>

    <div id="member-dashboard">
        <a class="btn btn-primary" href="member/list">{{ list_button }}</a><br/><br/>
        <a class="btn btn-primary" href="member/create">{{ create_button }}</a>
    </div>
</div>



<script>
var app = new Vue({
    el: '#member-dashboard',
    data: {
        list_button: 'List of member',
        create_button: 'Create New member',

    }
})
</script>