<?php
// db connection
require_once("class/dbh.class.php");
// Election Data Controller
require_once("class/data_class.php");

if (isset($_POST['submit_lgas'])) {
	// get selecteds lgas
	$selectedLgas =  $_POST['lgas'];
	$lgaIds = implode(",", $selectedLgas);

	// get their unique poll ids
	$electionData = new ElectionData();
	$pollIds = $electionData->getPollIds($lgaIds);

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Question 2</title>
	<link rel="stylesheet" type="text/css" href="css/header_footer.css">
</head>
<style type="text/css">
	.main_block {
		padding: 2rem;
	}
	.list_block {
	  display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
	}
	.list_block li {
	  flex-basis: 25%;
    margin-bottom: 5px;
	}
	.submit_block {
	  margin-top: 15px;
	}
	.submit_btn {
	  padding: 10px 20px;
    background-color: #2692ad;
    border: none;
    color: #ffffff;
    border-radius: 20px;
    cursor: pointer;
	}
</style>
<body>
	<?php
	// header html design
	require_once("include/header.php");
	?>
	<div class="main_block">
		<h2>Result Datas</h2>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<h3>Local Governments</h3>
				<ul class="list_block">
					<?php 
						// require_once("include/question1.contr.php"); 
						$electionData = new ElectionData();
						$lgas = $electionData->getLGA("", "checkbox");
						echo $lgas;
					?>
				</ul>
				<div class="submit_block">
					<input type="submit" name="submit_lgas" value="GET VOTES" class="submit_btn">
				</div>
			</form>
			<div>
				<h3>Results (Selected LGAs)</h3>
				<div>
					<div>Total: 
						<?php
							$totalResults = $electionData->getLgasResult($pollIds);
							echo $totalResults;
						?> Votes
					</div>
					
				</div>
			</div>
	</div>
	<?php
	// footer html design
	require_once("include/footer.php");
	?>
</body>
</html>