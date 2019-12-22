<?php
$title = "OVO Payment Step 1 of 3";
include ROOT."app/theme/header.php";

if ($_SESSION['is_admin'] == true || empty($_SESSION['id']) || empty($_SESSION['tmp_upgrade'])) {
    $notice->addError("You don't have permission to access the feature !");
    header("location:".HTTP."?page=dashboard");
    die();
}

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
                <form id="form-upgrade" class="card shadow-base bd-0" action="<?=HTTP.'?merchant=ovo_request&act=step1';?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 tx-center">
                                <img src="<?=HTTP.'app/theme/assets/img/ovo.png';?>" height="100" />
                            </div>
                            <br />
                            <div class="col-md-12">
                                <div class="form-group mg-b-0">
                                    <label class="form-control-label">Your OVO Phone Number: <span class="tx-danger">*</span></label>
                                    <input type="text" name="txtOVOPhoneNumber" class="form-control" placeholder="0856xxxxxxxx" required autofocus>
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