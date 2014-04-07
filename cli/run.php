<?php
$_SERVER['DOCUMENT_ROOT'] = str_replace('/cli', '', getcwd());
include_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.mergesort.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.quicksort.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.heapsort.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.insertionsort.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/input/class.input.php');

parse_str(implode('&', array_slice($argv, 1)), $_GET);

if(!isset($_GET['amount']) || $_GET['amount'] == ""){
	echo "No amount of runs specified\n";
	die();
} else {
	$amount = $_GET['amount'];
}
if(!isset($_GET['input']) || $_GET['input'] == ""){
	echo "No input specified\n";
	die();
} else {
	$input_name = $_GET['input'];
}
if(!isset($_GET['type']) || $_GET['type'] == ""){
	echo "No type of algorithm specified\n";
	die();
} else {
	$type = $_GET['type'];
}

if(!isset($_GET['error']) || $_GET['error'] == ""){
	$error_rate = 0;
} else {
	$error_rate = $_GET['error'];
}
set_time_limit(0);

switch($type){
	case 'mergesort':
		$algorithm = new MergeSort();
		$name = 'MergeSort';
		break;
	case 'quicksort':
		$algorithm = new QuickSort();
		$name = 'QuickSort';
		break;
	case 'heapsort':
		$algorithm = new HeapSort();
		$name = 'HeapSort';
		break;
	case 'insertionsort':
		$algorithm = new InsertionSort();
		$name = 'InsertionSort';
		break;
}

$input = new Input($input_name);
$buggydata = new BuggyArray($error_rate);
$buggydata->loadFromDisk($input->getInputData());

//echo "Running $name\n";

$algorithm->setBuggyData($buggydata);
for($i = 0; $i < $amount; $i++){
	$algorithm->run();
}
$stats = $algorithm->getStats();
$stats[$name]['averages']['amount'] = $amount;
$stats[$name]['averages']['error_rate'] = $error_rate;

$handle = fopen($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."cli".DIRECTORY_SEPARATOR."results".DIRECTORY_SEPARATOR.$name.".json", "a");
fwrite($handle, json_encode(array('averages' => $stats[$name]['averages']))."\n");
fclose($handle);

echo "Written $name ($error_rate)\n";