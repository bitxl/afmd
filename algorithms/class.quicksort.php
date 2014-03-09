<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.algorithm.php');
class QuickSort extends Algorithm{
	//Algorithm rebuild from: http://andrewbaxter.net/quicksort.php

	public function __construct(){
		parent::__construct('QuickSort');
	}

	public function sort(){
		return $this->quicksort($this->buggy_data);
	}

	private function quicksort(BuggyArray $array){
		// find array size
		$length = $array->getCount();

		// base case test, if array of length 0 then just return array to caller
		if($length <= 1){
			return $array;
		} else {
			// select an item to act as our pivot point, since list is unsorted first position is easiest
			$pivot = $array->get(0);

			// declare our two arrays to act as partitions
			$left = new BuggyArray();
			$right = new BuggyArray();

			// loop and compare each item in the array to the pivot value, place item in appropriate partition
			$leftindex = $rightindex = 0;
			for($i = 1; $i < $array->getCount(); $i++){
				if($array->get($i) < $pivot){
					$left->set($leftindex, $array->get($i));
					$leftindex++;
				} else {
					$right->set($rightindex, $array->get($i));
					$rightindex++;
				}
			}

			// use recursion to now sort the left and right lists
			$pivotArray = new BuggyArray();
			$pivotArray->set(0, $pivot);
			return BuggyArray::merge($this->quicksort($left), $pivotArray, $this->quicksort($right));
		}
	}
}