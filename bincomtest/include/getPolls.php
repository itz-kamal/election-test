<?php
// db connection
require_once("../class/dbh.class.php");
// Election Data Controller
require_once("../class/data_class.php");

// state Id
$wardId = $_POST['l'];

$electionData = new ElectionData();
$polls = $electionData->getPolls($wardId);

echo $polls;