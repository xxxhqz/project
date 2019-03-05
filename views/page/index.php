<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hey!</h1>
        <p class="lead">Congrats! you are finally here</p>

        <?php if(isset($_SESSION['login_as']) && ($_SESSION['login_as'] == 'admin' || $_SESSION['login_as'] =='member')):
            echo "<h3>You are logged in as ".$_SESSION['login_as']."</h3>";
        endif;?>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>Introduction</h2>

                <p>This is a project given by our development team leader Por from December but we started it 2 weeks before the dateline. we are sorry >_< </p><br/>
                <p>BUT HERE!, READ MORE ABOUT Yii2, by clicking this below button  ^_^</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
        </div>
    </div>
</div>
