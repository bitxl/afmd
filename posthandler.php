<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once($_SERVER['DOCUMENT_ROOT']."/input/class.input.php");
switch($_POST['action']){
	case 'saveInput':
		Input::saveFile(str_replace(" ", "-", $_POST['name']), $_POST['data']);
		header("Location: /input/");
		break;
	case 'deleteInput':
		Input::deleteFile($_POST['name']);
		header("Location: /input/");
		break;
	default:
		echo "UNKNOWN ACTION";
		break;
}