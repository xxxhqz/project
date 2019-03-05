<?php
$user_id = $_SESSION['current_user']->id;
?>

<div class="container">
    <br>
    <h3>Admin</h3>
	<div class="row">
        <div class="col-md-3">
            <a href="/admin/view?id=<?=$user_id?>" class="btn btn-primary btn-lg btn-block btn-huge">View Personal Personal</a>
        </div>
        <div class="col-md-3">
            <a href="/admin/update?id=<?=$user_id?>" class="btn btn-primary btn-lg btn-block btn-huge">Edit Personal Details</a>
        </div>
        <div class="col-md-3">
            <!-- <a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Test button</a> -->
        </div>
	</div>
    <br>
    <h3>Members</h3>
	<div class="row">
        <div class="col-md-3">
            <a href="/admin/member_list" class="btn btn-primary btn-lg btn-block btn-huge">List of Members</a>
        </div>
        <div class="col-md-3">
            <a href="/admin/member_create" class="btn btn-primary btn-lg btn-block btn-huge">Create New Member</a>
        </div>
        <div class="col-md-3">
            <!-- <a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Test button</a> -->
        </div>
        <div class="col-md-3">
            <!-- <a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Test button</a> -->
        </div>
	</div>
    <br>
    <h3>Ticket</h3>
	<div class="row">
        <div class="col-md-3">
            <a href="/admin/ticket_list" class="btn btn-primary btn-lg btn-block btn-huge">List of Ticket</a>
        </div>
        <div class="col-md-3">
            <!-- <a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Test button</a> -->
        </div>
        <div class="col-md-3">
            <!-- <a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Test button</a> -->
        </div>
        <div class="col-md-3">
            <!-- <a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Test button</a> -->
        </div>
	</div>
</div>