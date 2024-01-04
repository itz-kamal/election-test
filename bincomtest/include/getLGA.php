<?php
// db connection
require_once("../class/dbh.class.php");
// Election Data Controller
require_once("../class/data_class.php");

// state Id
$stateId = $_POST['l'];

$electionData = new ElectionData();
$lga = $electionData->getLGA($stateId, "radio");

echo $lga;