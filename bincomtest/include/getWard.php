<?php
// db connection
require_once("../class/dbh.class.php");
// Election Data Controller
require_once("../class/data_class.php");

// state Id
$lgaId = $_POST['l'];

$electionData = new ElectionData();
$wards = $electionData->getWards($lgaId);

echo $wards;