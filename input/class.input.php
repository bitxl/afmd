<?php

class Input{

	private $directory = null;
	private $inputData = null;
	public $name = null;

	public function __construct($name){
		$this->directory = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."input".DIRECTORY_SEPARATOR."data";
		if(!file_exists($this->directory.DIRECTORY_SEPARATOR.$name)){
			throw new ErrorException("Could not find filename");
		} else {
			$this->name = $name;
		}
	}

	public function getInputData(){
		if($this->inputData == null){
			$this->inputData = $this->readFile();
		}
		return $this->inputData;
	}
	public function getSortedInputData(){
		$inputData = $this->getInputData();
		sort($inputData);
		return $inputData;
	}

	private function readFile(){
		$contents = file_get_contents($this->directory.DIRECTORY_SEPARATOR.$this->name);
		$contents = explode("\n", $contents);
		foreach($contents as $key => &$value){
			$value = trim($value);
			if(!is_numeric($value)){
				unset($contents[$key]);
			}
		}
		return array_values($contents);
	}

	public static function saveFile($name, $contents){
		$handle = fopen($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."input".DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.$name, "w");
		fwrite($handle, $contents);
		fclose($handle);
	}
	public static function deleteFile($name){
		unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."input".DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.$name);
	}
	public static function getAll(){
		$inputs = array();
		if($handle = opendir($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."input".DIRECTORY_SEPARATOR."data")){
			while (false !== ($entry = readdir($handle))) {
				if(in_array($entry, array(".", ".."))) continue;
				$inputs []= new Input($entry);
			}
		}
		return $inputs;
	}

}