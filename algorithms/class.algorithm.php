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
		unset($this->stats[$this->name]['averages']);
		$averages = array();
		$runs = count($this->stats[$this->name]);
		foreach($this->stats[$this->name] as $run){
			$averages['runtime'] += ($run['stop'] - $run['start']) * 1000;
			$averages['appearance'] += $run['measures']['appearance'];
			$averages['changes'] += $run['measures']['changes'];
		}
		$averages['runtime'] /= $runs;
		$averages['appearance'] /= $runs;
		$averages['changes'] /= $runs;
		$averages['totalpossiblechanges'] = $run['measures']['totalpossiblechanges'];
		$this->stats[$this->name]['averages'] = $averages;
		return $this->stats;
	}
} 