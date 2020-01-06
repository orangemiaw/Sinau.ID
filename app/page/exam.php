<?php
defined('SINAUID') OR exit('No direct script access allowed');

// Chcek role and block if not have access role
// if (!isset($_SESSION['role']->{$_GET['detail']}->detail)) {
//     $notice->addError("You don't have permission to access the feature !");
//     header("location:".HTTP."?page=" . $_GET['detail']);
//     return;
// }

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $notice->addError("Parameter id can't be empty !");
    header("location:".HTTP."?page=" . $_GET['detail']);
    return; 
}

$title = "Online Exam 1/10";
include ROOT."app/theme/header.php";
include PATH_MODEL . 'model_question.php';
include PATH_MODEL . 'model_answer.php';

$m_question     = new model_question($db);
$m_answer       = new model_answer($db);
$page_number    = is_numeric($_GET['hal']) ? $_GET['hal'] : 1;
$data_per_page  = 20;
$total_rows     = $m_question->total_rows();
$arr_question   = $m_question->get_results(array('question_type_id' => $_GET['id']), $page_number, $data_per_page);

?>
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <h4><?=isset($title) ? $title : 'Untitled';?></h4>
    </div>
    <div class="br-pagebody">

<div class="row">
	<div class="col-md-7 col-sm-12">
        <form id="form-detail" class="card shadow-base bd-0">

            <div class="card-body">
                <div class="row">
                    <?php if (!empty($arr_question)): ?>
                        <?php 
                            $no = 1;
                            foreach($arr_question as $value): 
                        ?>
                                <div class="col-lg-12">
                                    <b><?=$no;?>. <?=$value['question_text'];?></b><br /><br />
                                </div>
                                
                            <?php
                                $arr_answer = $m_answer->get_results(array('question_id' => $value['question_id']), $page_number, $data_per_page);
                                foreach($arr_answer as $answer):
                            ?>
                                <div class="col-lg-12">
                                    <input type="radio" name="answer"> <?=$answer['answer_text'];?><br/>
                                </div>
                                <?php endforeach;?>
                        <?php 
                            $no++;
                            endforeach;
                        ?>

                    <?php else: ?>
                        <b>No question found.</b>
                    <?php endif;?>

                </div>
            </div>

            <div class="card-footer bd-color-gray-lighter text-right">
                <button type="submit" class="btn btn-primary tx-size-xs ">Submit Answer & Next</button>
            </div>

            </form>

    </div>
	
	<div class="col-md-5 col-sm-12 mg-t-20 mg-md-t-0">
		<div class="card shadow-base bd-0">
			<div class="card-header bd-gray-200 mg-t-auto">
				<span>Online Webcam Exam Monitoring</span>
			</div>
			<div class="card-body pd-0">
				<div id="inputImage" class="col-md-12 tx-center pd-15">
                    <center>
                        <div id="my_camera"></div>
                        <div id="results"></div>
                    </center>
                    <input type="hidden" type="file" accept="image/*" name="image_base64" class="image-tag">
                    <br />
                    <p>Kejujuran itu seperti cermin. Sekali dia retak, pecah, maka jangan harap dia akan pulih seperti sedia kala. Jangan coba-coba bermain dengan cermin.</p>
				</div>
			</div>
		</div>

		<div id="elm-log-row" style="display:none;">
			<span class="col time"></span>
			<span class="col created-by"></span>
			<span class="col text-right ip-address"></span>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
<script language="JavaScript">
	Webcam.set({
		width: 320,
		height: 240,
		dest_width: 640,
		dest_height: 480,
		image_format: 'jpeg',
		jpeg_quality: 100
	});
	Webcam.attach( '#my_camera' );
 
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('my_camera').style.display = "none";
            document.getElementById('takeSnapshot').style.display = "none";
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
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