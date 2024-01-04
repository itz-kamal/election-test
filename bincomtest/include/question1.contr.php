<?php
// db connection
require_once("class/dbh.class.php");
// Election Data Controller
require_once("class/data_class.php");


$electionData = new ElectionData();
$states = $electionData->getStates();
