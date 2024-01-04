<?php
// db connection
require_once("../class/dbh.class.php");
// Election Data Controller
require_once("../class/data_class.php");

// state Id
$pollId = $_POST['l'];

$electionData = new ElectionData();
$results = $electionData->getResults($pollId);

echo $results;