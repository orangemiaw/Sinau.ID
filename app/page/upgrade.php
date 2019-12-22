<?php
$title = "Upgrade Membership";
include ROOT."app/theme/header.php";
require_once PATH_MODEL . 'model_participant_group.php';

$m_participant_group    = new model_participant_group($db);
$arr_participant_group  = $m_participant_group->get_results(array('participant_group_status' => STATUS_ENABLE));
?>
    <div class="br-mainpanel">
		<div class="br-pagetitle">
			<h4><?=isset($title) ? $title : 'Untitled';?></h4>
		</div>
        <div class="br-pagebody">

        <!-- Main content -->

        <?=$GLOBALS['notice']->showSuccess();?>
        <?=$GLOBALS['notice']->showError();?>

        <div class="row">
            <div class="col-md-6">
                <form id="form-upgrade" class="card shadow-base bd-0" action="<?=HTTP.'?merchant=payment_request';?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mg-b-0">
                                    <label class="form-control-label">Membership Type: <span class="tx-danger">*</span></label>
                                    <select id="select-brand" name="cbParticipantGroup" class="form-control select-two" data-placeholder="-- Select --" >
                                        <option></option>
                                        <?php foreach ($arr_participant_group as $value): ?>
                                            <?php if(strtolower($_SESSION['group']) != strtolower($value['participant_group_name'])): ?>
                                                <option value="<?php print $value['participant_group_id'];?>" >
                                                    <?php print $value['participant_group_name'];?>
                                                </option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                    <ul class="fields-message"></ul>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mg-b-0">
                                    <label class="form-control-label">Select Payment Method: <span class="tx-danger">*</span></label>
                                    <label class="rdiobox">
                                        <input name="rdPaymentMethod" value="paypal" type="radio" checked>
                                        <span>PayPal</span>
                                    </label>
                                    <label class="rdiobox">
                                        <input name="rdPaymentMethod" value="ovo" type="radio">
                                        <span>OVO</span>
                                    </label>
                                    <ul class="fields-message"></ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer bd-color-gray-lighter text-right">
                        <button type="submit" class="btn btn-primary tx-size-xs ">Submit</button>
                    </div>
                
                </form>
            </div>
        </div>

        <!-- End of main content -->

			<footer class="br-footer">
				<div class="footer-left">
				</div>
				<div class="footer-right d-flex align-items-center">
				</div>
			</footer>
		</div>
    </div>
<?php include ROOT."app/theme/footer.php";?>