<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['detail']}->detail)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return; 
}

$title = "Detail Question Type";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_question_type.php';

$m_question_type   = new model_question_type($db);
$arr_question_type = $m_question_type->get_row(array("question_type_id" => $_GET['id']/1909));
if(!$arr_question_type) {
    $notice->addError("Data not found in our database !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

<div class="row">
	<div class="col-md-12 col-sm-12">

    <form id="form-detail" class="card shadow-base bd-0">

		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Created: </label>
						<input type="text" value="<?=timestamp_to_date($arr_question_type['created']);?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Question Type: </label>
						<input type="text" value="<?=$arr_question_type['question_type'];?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Question Group: </label>
						<input type="text" value="<?=$arr_question_type['question_group_name'];?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">Question Total: </label>
						<input type="text" value="<?=$arr_question_type['total'];?>" class="form-control" disabled="disabled">
						<ul class="fields-message"></ul>
					</div>
				</div>
			</div>
		</div>

		</form>

	</div>
</div>

<footer class="br-footer">
    <div class="footer-left">
    </div>
    <div class="footer-right d-flex align-items-center">
    </div>
</footer>
</div>
</div>
<?php include ROOT."app/theme/footer.php";?>