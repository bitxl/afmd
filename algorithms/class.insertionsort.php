<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.algorithm.php');

class InsertionSort extends Algorithm{
	//Algorithm rebuild from: http://algorithmik.wordpress.com/2012/11/26/insertion-sort-algorithm-php-implementation-2/

	public function __construct(){
		parent::__construct('InsertionSort');
	}

	public function sort(){
		return $this->insertionsort($this->buggy_data);
	}

	private function insertionSort(BuggyArray $array){
		$length = $array->getCount();
		for($i = 1; $i < $length; $i++){
			$element = $array->get($i);
			$j       = $i;
			while($j > 0 && $array->get($j - 1) > $element){
				//move value to right and key to previous smaller index
				$array->set($j, $array->get($j - 1));
				$j         = $j - 1;
			}
			//put the element at index $j
			$array->set($j, $element);
		}
		return $array;
	}
}