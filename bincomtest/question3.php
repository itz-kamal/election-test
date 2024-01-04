<?php
// db connection
require_once("class/dbh.class.php");
// Election Data Controller
require_once("class/data_class.php");

$report = null;

if (isset($_POST['submit_btn'])) {
	$wardId = htmlentities($_POST['ward']);
	$lagId = htmlentities($_POST['lga']);
	$pollNum = htmlentities($_POST['poll_num']);
	$pollName = htmlentities($_POST['poll_name']);
	$pollDesc = htmlentities($_POST['poll_desc']);
	$user = htmlentities($_POST['user']);

	$electionData = new ElectionData();
	$pollDataId = $electionData->addNewPollUnit($wardId, $lagId, $pollNum, $pollName, $pollDesc, $user);

	$pdp = htmlentities($_POST['pdp']);
	$dpp = htmlentities($_POST['dpp']);
	$acn = htmlentities($_POST['acn']);
	$ppa = htmlentities($_POST['ppa']);
	$cdc = htmlentities($_POST['cdc']);
	$jp = htmlentities($_POST['jp']);
	$scores = $pdp .",". $dpp .",". $acn .",". $ppa .",". $cdc .",". $jp;

	if (!empty($pollDataId)) {
		$enteredData = $electionData->addNewResult($pollDataId, $scores, $user);
		$report = "<div style='color:green'>Data sent successfully</div>";
	} else {
		$report = "<div style='color:red'>Data Not sent</div>";
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Question 3</title>
	<link rel="stylesheet" type="text/css" href="css/header_footer.css">
	<style type="text/css">
		.main_block {
			padding: 2rem;
		}
		.list_block {
		  width: 85%;
		  display: flex;
		  flex-direction: row;
		  justify-content: space-between;
		  flex-wrap: wrap;
		}
		.list_block li {
		  flex-basis: 25%;
		  margin-bottom: 10px;
		}
		.input_block {
	    margin-bottom: 10px;
		}
		.input_block label {
	    display: inline-block;
    	width: 13%;
		}
		.input_block input {
	    padding: 8px;
	    width: 20%;
	    border: 2px solid black;
	    border-radius: 10px;
		}
		.submit_block {
	 	 margin-top: 15px;
		}
		.submit_btn {
		  padding: 12px 20px;
	    background-color: #2692ad;
	    border: none;
	    color: #ffffff;
	    border-radius: 20px;
	    cursor: pointer;
	    width: 12%;
			}
	</style>
</head>
<body>
	<?php
	// header html design
	require_once("include/header.php");
	?>
	<main>
		<div class="main_block">
			<h2>Results for my polling unit</h2>
			<div>Note: Click on data to show futher information.</div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div><?php echo $report; ?></div>
				<h3>States</h3>
				<ul class="list_block">
					<?php 
						// require_once("include/question1.contr.php"); 
						$electionData = new ElectionData();
						$states = $electionData->getStates();
					?>
				</ul>
				<h3>Local Government</h3>
				<div id="lga_block">
					<ul class="list_block" id="lga_list">
						<!-- list of LGA appears here -->
					</ul>
				</div>
				<h3>Wards</h3>
				<div id="ward_block">
					<ul class="list_block" id="ward_list">
						<!-- list of Wards appears here -->
					</ul>
				</div>
				<div>
					<h3>Polling Unit</h3>
					<div class="input_block">
						<label>Unit Name: </label>
						<input type="text" name="poll_name">
					</div>
					<div class="input_block">
						<label>Unit Number: </label>
						<input type="text" name="poll_num">
					</div>
					<div class="input_block">
						<label>Unit Description: </label>
						<input type="text" name="poll_desc">
					</div>
					<h3>Results</h3>
					<div class="input_block">
						<label>PDP: </label>
						<input type="number" name="pdp">
					</div>
					<div class="input_block">
						<label>DPP: </label>
						<input type="text" name="dpp">
					</div>
					<div class="input_block">
						<label>ACN: </label>
						<input type="text" name="acn">
					</div>
					<div class="input_block">
						<label>PPA: </label>
						<input type="text" name="ppa">
					</div>
					<div class="input_block">
						<label>CDC: </label>
						<input type="text" name="cdc">
					</div>
					<div class="input_block">
						<label>JP: </label>
						<input type="text" name="jp">
					</div>
				</div>
				<div class="input_block">
					<label>Data Entered by: </label>
					<input type="text" name="user">
				</div>
				<div class="submit_block">
					<input type="submit" name="submit_btn" value="SEND" class="submit_btn">
				</div>
			</form>
			
		</div>
	</main>
	<?php
	// footer html design
	require_once("include/footer.php");
	?>

	<script type="module" src="js/question1.js"></script>
</body>
</html>