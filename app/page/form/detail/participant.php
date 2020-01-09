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

$title = "Detail Participant";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_regencie.php';
include PATH_MODEL . 'model_province.php';
include PATH_MODEL . 'model_participant.php';
include PATH_MODEL . 'model_participant_group.php';

$m_regencie 	= new model_regencie($db);
$m_province 	= new model_province($db);
$m_participant 	= new model_participant($db);
$m_group 	    = new model_participant_group($db);
$arr_data 		= $m_participant->get_row(array("participant_id" => $_GET['id']/1909));
if(!$arr_data) {
    $notice->addError("Data not found in our database !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return;
}
$arr_regencie	= $m_regencie->get_results(array(), 'all');
$arr_province	= $m_province->get_results(array(), 'all');
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
                        <div class="col-md-12 tx-center">
                            <div class="form-group">
                                <label class="form-control-label">Current Photo </label><br />
                                <img src="<?=$arr_data['profile_image'] ? HTTP . $arr_data['profile_image'] : HTTP . DEFAULT_PROFILE_IMAGE;?>" width="300" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Full Name </label>
                                <input class="form-control" type="text" value="<?=$arr_data['participant_name'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Login </label>
                                <input class="form-control" type="text" value="<?=$arr_data['participant_login'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Participant Group </label>
                                <input class="form-control" type="text" value="<?=$arr_data['participant_group_name'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Email </label>
                                <input class="form-control" type="email" value="<?=$arr_data['participant_email'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Address </label>
                                <input class="form-control" type="text" value="<?=$arr_data['address'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Province </label>
                                <select id="select-brand" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_province as $value): ?>
                                        <option value="<?php print $value['province_id'];?>" <?=set_select_disable($value['province_id'], $arr_data['province']);?> >
                                            <?php print $value['name'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Regencie </label>
                                <select id="select-brand" class="form-control select-two" data-placeholder="-- Select --" >
                                    <option></option>
                                    <?php foreach ($arr_regencie as $value): ?>
                                        <option value="<?php print $value['regencie_id'];?>" <?=set_select_disable($value['regencie_id'], $arr_data['regencie']);?> >
                                            <?php print $value['name'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Postal Code </label>
                                <input class="form-control" type="text" placeholder="Postal Code" value="<?=$arr_data['postal_code'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Telephone </label>
                                <input class="form-control" type="text" placeholder="Telephone" value="<?=$arr_data['telephone'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Last Login</label>
                                <input class="form-control" type="text" placeholder="Last Login" value="<?=timestamp_to_date($arr_data['participant_last_login']);?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Last IP </label>
                                <input class="form-control" type="text" placeholder="Last IP" value="<?=$arr_data['participant_last_ip'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Last Browser </label>
                                <input class="form-control" type="text" placeholder="Last Browser" value="<?=$arr_data['participant_last_browser'];?>">
                                <ul class="fields-message"></ul>
                            </div>
                        </div>
						<div class="col-md-6">
							<div class="form-group mg-b-0">
								<label class="form-control-label">Status: <span class="tx-danger">*</span></label>
								<select class="form-control select-two" data-placeholder=" -- Pilih Status --" required>
									<option></option>
									<option value="<?=STATUS_ENABLE;?>" <?=set_select_disable(STATUS_ENABLE, $arr_data['participant_status']);?>>Enable</option>
									<option value="<?=STATUS_DISABLE;?>" <?=set_select_disable(STATUS_DISABLE, $arr_data['participant_status']);?>>Disable</option>
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