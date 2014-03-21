<?php

class BuggyArray{
	private $data = array();
	private $data_original = array();
	private $error_rate = 0; //chance that the value returned is wrong
	private $random_max = 0;
	private $changes = 0;
	private $totalpossiblechanges = 0;

	//constructor with error rate for the buggy memory
	public function __construct($error = 0){
		$this->error_rate = $error;
		$this->random_max = pow(10, strlen(substr(strrchr($this->error_rate, "."), 1)));
	}

	//load data from 'disk' to buggy memory
	public function loadFromDisk($array){
		$this->data          = $array;
		$this->data_original = $array;
	}

	public function writeToDisk(){
		return $this->data;
	}

	public function reset(){
		$this->changes = 0;
		$this->totalpossiblechanges = 0;
		$this->data = $this->data_original;
	}

	public function prettyPrint(){
		echo "<pre>";
		print_r($this->data);
		echo "</pre>";
	}

	//getting a value in an array with buggy memory
	public function get($index){
		$this->traverse();
		return $this->data[$index];
	}

	//setting the value in an array with buggy memory
	public function set($index, $value){
		$this->traverse();
		return $this->data[$index] = $value;
	}

	//slicing an array with buggy memory
	public function slice($start, $end){
		$sliced = array();
		for($i = $start; $i < $end; $i++){
			$sliced [] = $this->get($i);
		}
		$slicedBuggy = new BuggyArray($this->error_rate);
		$slicedBuggy->loadFromDisk($sliced);
		return $slicedBuggy;
	}

	public function getCount(){
		return count($this->data);
	}

	public static function merge(){
		$arguments = func_get_args();
		$result = new BuggyArray();
		$resultindex = 0;
		foreach($arguments as $a){
			$count = $a->getCount();
			for($i = 0; $i < $count; $i++){
				$result->set($resultindex, $a->get($i));
				$resultindex++;
			}
		}
		return $result;
	}

	private function traverse(){
		foreach($this->data as &$element){
			$random_number = mt_rand(0, $this->random_max) / $this->random_max;
			if($random_number < $this->error_rate){
				$this->changes++;
				$element = rand();
			}
			$this->totalpossiblechanges++;
		}
	}

	public function compareToOriginal(){
		$results                         = array();
		$results['appearance']           = $this->measureAppearance();
		$results['sorted'] = $this->measureIsSorted();
		$results['outoforder'] = $this->measureOutOfOrder();
		$results['levenshtein'] = $this->measureLevenshtein();
		$results['binarysearch'] = $this->measureBinarySearchable();
		$results['changes']              = $this->changes;
		$results['totalpossiblechanges'] = $this->totalpossiblechanges;
		return $results;
	}

	private function measureAppearance(){
		return count(array_intersect($this->data_original, $this->data)) / count($this->data_original);
	}

	private function measureAppearanceInOrder(){
		$leftover       = array_intersect($this->data_original, $this->data);
		$initial_sorted = $this->data_original;
		sort($initial_sorted);
		foreach($initial_sorted as $sorted){

		}
	}

	//measure for each 1/2*(n)*(n-1) pairs if they are in order
	private function measureOutOfOrder(){
		$totalincorrect = 0;
		for($i = 0; $i < count($this->data); $i++){
			if(!isset($this->data[$i + 1])){
				break;
			}
			if($this->data[$i] > $this->data[$i + 1]){
				$totalincorrect++;
			}
		}
		return $totalincorrect;
	}

	private function measureLevenshtein(){
		$maxlength = strlen((string) max($this->data_original));
		return levenshtein($this->convertArrayToString($maxlength, $this->data), $this->convertArrayToString($maxlength, $this->data_original));
	}

	private function convertArrayToString($maxlength, $array){
		$string = "";
		foreach($array as $value){
			$string .= str_pad((string) $value, $maxlength).",";
		}
		return $string;
	}

	private function measureBinarySearchable(){
		$found = 0;
		$leftover = array_intersect($this->data_original, $this->data);
		foreach($leftover as $original_value){
			if($this->binary_search($this->data, 1, count($this->data), $original_value)){
				$found++;
			}
		}
		return $found;
	}

	private function measureIsSorted(){
		$current = $this->data;
		sort($this->data);
		return array_values($current) == array_values($this->data);
	}

	private function binary_search(array $a, $first, $last, $key){
		$lo = $first;
		$hi = $last - 1;

		while($lo <= $hi){
			$mid = (int) (($hi - $lo) / 2) + $lo;
			$cmp = $this->cmp($a[$mid], $key);

			if($cmp < 0){
				$lo = $mid + 1;
			} elseif($cmp > 0) {
				$hi = $mid - 1;
			} else {
				return $mid;
			}
		}
		return -($lo + 1);
	}

	private function cmp($a, $b){
		return ($a < $b) ? -1 : (($a > $b) ? 1 : 0);
	}

}