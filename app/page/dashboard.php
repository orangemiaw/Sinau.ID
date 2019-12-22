<?php
$title = "Dashboard";
include ROOT."app/theme/header.php";
require_once PATH_MODEL . 'model_dashboard.php';
require_once PATH_MODEL . 'model_payment.php';

$m_dashboard = new model_dashboard($db);
$m_payment   = new model_payment($db);
$arr_payment = $m_payment->get_results(array(), 1, 10);
?>
    <div class="br-mainpanel">
		<div class="br-pagetitle">
			<h4><?php print isset($title) ? $title : 'Untitled';?></h4>
		</div>
		<div class="br-pagebody">

        <!-- Main content -->

            <?=$GLOBALS['notice']->showSuccess();?>
            <?=$GLOBALS['notice']->showError();?>

            <div class="row">
            <div class="col-md-12">
                <div id="screen" class="row row-sm">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-info rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                            <i class="ion ion-md-journal tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Modules</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><?=$m_dashboard->total_modules();?></p>
                            </div>
                        </div>
                        <div id="ch1" class="ht-50 tr-y-1 rickshaw_graph">
                            <svg width="395" height="50">
                                <g>
                                    <path d="M0,25Q28.52777777777778,19.291666666666664,32.916666666666664,19.374999999999996C39.49999999999999,19.499999999999996,59.24999999999999,25.0625,65.83333333333333,26.25S92.16666666666667,30.875,98.75,31.25S125.08333333333333,30.625,131.66666666666666,30S158,24.25,164.58333333333334,25S190.91666666666666,35.625,197.5,37.5S223.83333333333334,43.75,230.41666666666669,43.75S256.75,38.4375,263.3333333333333,37.5S289.6666666666667,35.3125,296.25,34.375S322.58333333333337,27.8125,329.1666666666667,28.125S355.5,37.8125,362.0833333333333,37.5Q366.47222222222223,37.291666666666664,395,25L395,50Q366.47222222222223,50,362.0833333333333,50C355.5,50,335.75,50,329.1666666666667,50S302.8333333333333,50,296.25,50S269.91666666666663,50,263.3333333333333,50S237.00000000000003,50,230.41666666666669,50S204.08333333333334,50,197.5,50S171.16666666666669,50,164.58333333333334,50S138.25,50,131.66666666666666,50S105.33333333333333,50,98.75,50S72.41666666666666,50,65.83333333333333,50S39.49999999999999,50,32.916666666666664,50Q28.52777777777778,50,0,50Z" class="area" fill="rgba(255,255,255,0.5)"></path>
                                </g>
                            </svg>
                        </div>
                        </div>
                    </div>
                    <!-- col-3 -->
                    <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                        <div class="bg-purple rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                            <i class="ion ion-md-paper tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Assessments</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><?=$m_dashboard->total_assessments();?></p>
                            </div>
                        </div>
                        <div id="ch3" class="ht-50 tr-y-1 rickshaw_graph">
                            <svg width="395" height="50">
                                <g>
                                    <path d="M0,25Q28.52777777777778,21.458333333333332,32.916666666666664,21.875C39.49999999999999,22.5,59.24999999999999,30.9375,65.83333333333333,31.25S92.16666666666667,26.25,98.75,25S125.08333333333333,18.75,131.66666666666666,18.75S158,23.125,164.58333333333334,25S190.91666666666666,35.625,197.5,37.5S223.83333333333334,43.75,230.41666666666669,43.75S256.75,38.4375,263.3333333333333,37.5S289.6666666666667,35.3125,296.25,34.375S322.58333333333337,27.8125,329.1666666666667,28.125S355.5,37.8125,362.0833333333333,37.5Q366.47222222222223,37.291666666666664,395,25L395,50Q366.47222222222223,50,362.0833333333333,50C355.5,50,335.75,50,329.1666666666667,50S302.8333333333333,50,296.25,50S269.91666666666663,50,263.3333333333333,50S237.00000000000003,50,230.41666666666669,50S204.08333333333334,50,197.5,50S171.16666666666669,50,164.58333333333334,50S138.25,50,131.66666666666666,50S105.33333333333333,50,98.75,50S72.41666666666666,50,65.83333333333333,50S39.49999999999999,50,32.916666666666664,50Q28.52777777777778,50,0,50Z" class="area" fill="rgba(255,255,255,0.5)"></path>
                                </g>
                            </svg>
                        </div>
                        </div>
                    </div>
                    <!-- col-3 -->
                    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                        <div class="bg-teal rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                            <i class="ion ion-md-contacts tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Participants</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><?=$m_dashboard->total_participants();?></p>
                            </div>
                        </div>
                        <div id="ch2" class="ht-50 tr-y-1 rickshaw_graph">
                            <svg width="395" height="50">
                                <g>
                                    <path d="M0,25Q28.52777777777778,40.541666666666664,32.916666666666664,40.625C39.49999999999999,40.75,59.24999999999999,27.8125,65.83333333333333,26.25S92.16666666666667,24.625,98.75,25S125.08333333333333,30.625,131.66666666666666,30S158,20.8125,164.58333333333334,18.75S190.91666666666666,10.625,197.5,9.375S223.83333333333334,5,230.41666666666669,6.25S256.75,20.9375,263.3333333333333,21.875S289.6666666666667,16.5625,296.25,15.625S322.58333333333337,12.1875,329.1666666666667,12.5S355.5,17.5,362.0833333333333,18.75Q366.47222222222223,19.583333333333332,395,25L395,50Q366.47222222222223,50,362.0833333333333,50C355.5,50,335.75,50,329.1666666666667,50S302.8333333333333,50,296.25,50S269.91666666666663,50,263.3333333333333,50S237.00000000000003,50,230.41666666666669,50S204.08333333333334,50,197.5,50S171.16666666666669,50,164.58333333333334,50S138.25,50,131.66666666666666,50S105.33333333333333,50,98.75,50S72.41666666666666,50,65.83333333333333,50S39.49999999999999,50,32.916666666666664,50Q28.52777777777778,50,0,50Z" class="area" fill="rgba(255,255,255,0.5)"></path>
                                </g>
                            </svg>
                        </div>
                        </div>
                    </div>
                    <!-- col-3 -->
                    <?php if ($_SESSION['is_admin']): ?>
                        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                            <div class="bg-primary rounded overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <i class="ion ion-ios-cash tx-60 lh-0 tx-white op-7"></i>
                                <div class="mg-l-20">
                                    <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Earnings</p>
                                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><?=convert_to_rupiah($m_dashboard->total_earning());?></p>
                                </div>
                            </div>
                            <div id="ch4" class="ht-50 tr-y-1 rickshaw_graph">
                                <svg width="395" height="50">
                                    <g>
                                        <path d="M0,25Q28.52777777777778,21.458333333333332,32.916666666666664,21.875C39.49999999999999,22.5,59.24999999999999,30.9375,65.83333333333333,31.25S92.16666666666667,26.25,98.75,25S125.08333333333333,18.75,131.66666666666666,18.75S158,23.125,164.58333333333334,25S190.91666666666666,35.625,197.5,37.5S223.83333333333334,43.75,230.41666666666669,43.75S256.75,38.4375,263.3333333333333,37.5S289.6666666666667,35.3125,296.25,34.375S322.58333333333337,27.8125,329.1666666666667,28.125S355.5,37.8125,362.0833333333333,37.5Q366.47222222222223,37.291666666666664,395,25L395,50Q366.47222222222223,50,362.0833333333333,50C355.5,50,335.75,50,329.1666666666667,50S302.8333333333333,50,296.25,50S269.91666666666663,50,263.3333333333333,50S237.00000000000003,50,230.41666666666669,50S204.08333333333334,50,197.5,50S171.16666666666669,50,164.58333333333334,50S138.25,50,131.66666666666666,50S105.33333333333333,50,98.75,50S72.41666666666666,50,65.83333333333333,50S39.49999999999999,50,32.916666666666664,50Q28.52777777777778,50,0,50Z" class="area" fill="rgba(255,255,255,0.5)"></path>
                                    </g>
                                </svg>
                            </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                            <div class="bg-primary rounded overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <i class="ion ion-ios-flash tx-60 lh-0 tx-white op-7"></i>
                                <div class="mg-l-20">
                                    <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Mentors</p>
                                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><?=$m_dashboard->total_mentors();?></p>
                                </div>
                            </div>
                            <div id="ch4" class="ht-50 tr-y-1 rickshaw_graph">
                                <svg width="395" height="50">
                                    <g>
                                        <path d="M0,25Q28.52777777777778,21.458333333333332,32.916666666666664,21.875C39.49999999999999,22.5,59.24999999999999,30.9375,65.83333333333333,31.25S92.16666666666667,26.25,98.75,25S125.08333333333333,18.75,131.66666666666666,18.75S158,23.125,164.58333333333334,25S190.91666666666666,35.625,197.5,37.5S223.83333333333334,43.75,230.41666666666669,43.75S256.75,38.4375,263.3333333333333,37.5S289.6666666666667,35.3125,296.25,34.375S322.58333333333337,27.8125,329.1666666666667,28.125S355.5,37.8125,362.0833333333333,37.5Q366.47222222222223,37.291666666666664,395,25L395,50Q366.47222222222223,50,362.0833333333333,50C355.5,50,335.75,50,329.1666666666667,50S302.8333333333333,50,296.25,50S269.91666666666663,50,263.3333333333333,50S237.00000000000003,50,230.41666666666669,50S204.08333333333334,50,197.5,50S171.16666666666669,50,164.58333333333334,50S138.25,50,131.66666666666666,50S105.33333333333333,50,98.75,50S72.41666666666666,50,65.83333333333333,50S39.49999999999999,50,32.916666666666664,50Q28.52777777777778,50,0,50Z" class="area" fill="rgba(255,255,255,0.5)"></path>
                                    </g>
                                </svg>
                            </div>
                            </div>
                        </div>
                    <?php endif;?>
                    <!-- col-3 -->
                </div>
            </div>
            </div>

            <br />


        <?php if ($_SESSION['is_admin']): ?>
            <div class="card bd-0 shadow-base pd-15">
                <div class="bd pd-15 mg-b-15 rounded">
                    Latest Payment
                </div>

                <?php if (!empty($arr_payment)): ?>

                    <div class="bd bd-gray-300 rounded table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="min-w align-middle">Date</th>
                                    <th class="align-middle">Transaction ID</th>
                                    <th class="align-middle text-center">Payment Method</th>
                                    <th class="align-middle">Payment Amount</th>
                                    <th class="align-middle text-center">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($arr_payment as $value): ?>
                                <tr>
                                    <td class="min-w">
                                        <?php print timestamp_to_date($value['created']);?>
                                    </td>
                                    <td class="align-middle">
                                        <?php if ($value['payment_method'] == PAYPAL_PAYMENT_METHOD): ?>
                                            <a target="_blank" href="https://www.paypal.com/activity/payment/<?php print $value['transaction_id'];?>"><?php print $value['transaction_id'];?></a>
                                        <?php elseif ($value['payment_method'] == OVO_PAYMENT_METHOD): ?>
                                            <?php print $value['transaction_id'];?>
                                        <?php endif;?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php if ($value['payment_method'] == PAYPAL_PAYMENT_METHOD): ?>
                                            <span class="badge badge-info">PayPal</span>
                                        <?php elseif ($value['payment_method'] == OVO_PAYMENT_METHOD): ?>
                                            <span class="badge badge-info">OVO</span>
                                        <?php endif;?>
                                    </td>
                                    <td class="align-middle">
                                        <?php print convert_to_rupiah($value['payment_amount'] * RATE_USD_TO_IDR);?>
                                    </td>
                                    <td class="align-middle tx-center">
                                        <?php if (strtoupper($value['payment_status']) == 'APPROVED'): ?>
                                            <span class="badge badge-success"><?php print strtoupper($value['payment_status']);?></span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?php print strtoupper($value['payment_status']);?></span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                <?php endforeach;?>

                            </tbody>
                        </table>
                    </div>

                <?php else: ?>
                <div class="mg-t-30">
                    <h3 class="text-center">No record found</h3>
                </div>

                <?php endif;?>

            </div>
        <?php else: ?>
            <div class="card bd-0 shadow-base pd-15">
                <div class="bd pd-15 mg-b-15 rounded">
                    <p><b>Welcome back to Sinau.id !</b></p>
                    <p>We see an opportunity to help professionals improve their abilities and competencies while in the workforce without being bound by time and place. Therefore, Sinau.id was born as a tool that provides facilities to improve the skills needed in the world of work. We believe that with Sinau.id everyone can learn!.</p>
                </div>
            </div>
        <?php endif;?>

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