<?php
require_once('class.buggyarray.php');

class Algorithm{

	protected $buggy_data = null;
	private $stats = array();
	private $name = null;
	private $runcount = 0;

	public function __construct($name){
		$this->name = $name;
	}

	public function setBuggyData(BuggyArray $array){
		$this->buggy_data = $array;
	}

	protected function startTimer(&$arr){
		list($usec, $sec) = explode(' ', microtime());
		$arr['start'] = number_format($sec + $usec, 5, ".", "");
	}

	protected function stopTimer(&$arr){
		list($usec, $sec) = explode(' ', microtime());
		$arr['stop'] = number_format($sec + $usec, 5, ".", "");
	}

	protected function sort(){
	}

	public function run(){
		$this->buggy_data->reset();
		$this->stats[$this->name][$this->runcount]['data']['unsorted'] = $this->buggy_data->writeToDisk();
		$this->startTimer($this->stats[$this->name][$this->runcount]);
		$this->stats[$this->name][$this->runcount]['data']['sorted'] = $this->sort()->writeToDisk();
		$this->stopTimer($this->stats[$this->name][$this->runcount]);
		$this->stats[$this->name][$this->runcount]['measures'] = $this->buggy_data->compareToOriginal();
		$this->runcount++;

	}

	public function getStats(){
		return $this->stats;
	}
} 