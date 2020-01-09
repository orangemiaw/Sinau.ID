<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
if (!isset($_SESSION['role']->{$_GET['detail']}->detail)) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=" . $_GET['update']);
    return;
}

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}

$title = "Detail Admin";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_admin.php';
include PATH_MODEL . 'model_admin_group.php';

$m_admin 	= new model_admin($db);
$m_group    = new model_admin_group($db);
$arr_data   = $m_admin->get_row(array("admin_id" => $_GET['id']/1909));
if(!$arr_data) {
    $notice->addError("Data not found in our database !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}
$arr_group	    = $m_group->get_results(array(), 'all');

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

    <!-- Main content -->
	<div class="row">
		<div class="col-md-12">
			<form id="form-update" class="card shadow-base bd-0">
				<div class="card-body">
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Full Name </label>
                                <input class="form-control" type="text" placeholder="Full Name" value="<?=$arr_data['admin_name'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Login </label>
                                <input class="form-control" type="text" placeholder="Login" value="<?=$arr_data['admin_login'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Admin Group </label>
                                <input class="form-control" type="text" placeholder="Admin Group" value="<?=$arr_data['admin_group_name'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Email </label>
                                <input class="form-control" type="email" placeholder="Email" value="<?=$arr_data['admin_email'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Last Login</label>
                                <input class="form-control" type="text" placeholder="Last Login" value="<?=timestamp_to_date($arr_data['admin_last_login']);?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Last IP </label>
                                <input class="form-control" type="text" placeholder="Last IP" value="<?=$arr_data['admin_last_ip'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Last Browser </label>
                                <input class="form-control" type="text" placeholder="Last Browser" value="<?=$arr_data['admin_last_browser'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="<?=STATUS_ENABLE;?>" <?=set_select(STATUS_ENABLE, $arr_data['admin_status']);?>>Enable</option>
									<option value="<?=STATUS_DISABLE;?>" <?=set_select(STATUS_DISABLE, $arr_data['admin_status']);?>>Disable</option>
								</select>
								<ul class="fields-message"></ul>
							</div>
						</div>
					</div>
				</div>			
			</form>
		</div>
	</div>

<script>
    $('#selection').css('pointer-events','none');
</script>
<footer class="br-footer">
    <div class="footer-left">
    </div>
    <div class="footer-right d-flex align-items-center">
    </div>
</footer>
</div>
</div>
<?php include ROOT."app/theme/footer.php";?>