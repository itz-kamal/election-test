<?php
// db connection
require_once("class/dbh.class.php");
// Election Data Controller
require_once("class/data_class.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Question 1</title>
	<link rel="stylesheet" type="text/css" href="css/header_footer.css">
	<link rel="stylesheet" type="text/css" href="css/question1.css">
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
			<form>
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
				<h3>Polling Units</h3>
				<div id="polls_block">
					<ul class="list_block" id="polls_list">
						<!-- list of Polling units appears here -->
					</ul>
				</div>
				<h3>Results</h3>
				<div id="result_block">
					<div class="result_header">
						<div>S/N</div>
						<div>PARTY</div>
						<div>VOTES</div>
					</div>
					<table class="list_block" id="result_list">
						
					</table>
					<!-- <ul class="list_block" id="result_list">
						
					</ul> -->
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