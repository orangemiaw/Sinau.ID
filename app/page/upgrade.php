<?php
$title = "Upgrade Membership";
include ROOT."app/theme/header.php";

?>
    <div class="br-mainpanel">
		<div class="br-pagetitle">
			<h4><?=isset($title) ? $title : 'Untitled';?></h4>
		</div>

        <div class="br-pagebody">

        <!-- Main content -->

        <?=$GLOBALS['notice']->showSuccess();?>
        <?=$GLOBALS['notice']->showError();?>

            <div class="row row-sm mg-t-20 tx-center">
                <div class="col-lg-9">
                    <div class="card shadow-base bd-0 ht-100p">
                    </div>
                </div>
                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                    <div class="card bd-0 bg-transparent ht-100p">
                        <img src="<?=HTTP.'app/theme/assets/img/img40.jpg';?>" class="img-fit-cover rounded" alt="">
                        <div class="overlay-body bg-black-5 rounded"></div>
                            <div class="pos-absolute b-0 x-0 tx-center pd-30">
                                <h3 class="tx-white tx-light tx-shadow">Premium Membership</h3>
                                <p class="tx-13 tx-white-8 mg-b-25">Get access to all private contents.</p>
                                <a href="" class="btn btn-warning btn-oblong tx-11 pd-y-12 tx-uppercase d-block tx-semibold tx-mont">Shop Now - $50 USD</a>
                            </div><!-- overlay-body -->
                        </div>
                    </div><!-- col-3 -->
                </div><!-- row -->
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