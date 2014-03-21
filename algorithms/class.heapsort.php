<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.algorithm.php');

class HeapSort extends Algorithm{
	//Algorithm rebuild from http://php.dzone.com/articles/algorithm-week-heap-and

	public function __construct(){
		parent::__construct('HeapSort');
	}

	public function sort(){
		return $this->heap_sort($this->buggy_data);
	}

	private function build_heap(BuggyArray &$array, $i, $t){
		$tmp_var = $array->get($i);
		$j       = $i * 2 + 1;

		while($j <= $t){
			if($j < $t){
				if($array->get($j) < $array->get($j + 1)){
					$j = $j + 1;
				}
			}
			if($tmp_var < $array->get($j)){
				$array->set($i, $array->get($j));
				$i         = $j;
				$j         = 2 * $i + 1;
			} else {
				$j = $t + 1;
			}
		}
		$array->set($i, $tmp_var);
	}

	private function heap_sort(BuggyArray &$array){
		//This will heapify the array
		$init = (int) floor(($array->getCount() - 1) / 2);
		// Thanks jimHuang for bug report
		for($i = $init; $i >= 0; $i--){
			$count = $array->getCount() - 1;
			$this->build_heap($array, $i, $count);
		}

		//swaping of nodes
		for($i = $array->getCount() - 1; $i >= 1; $i--){
			$tmp_var    = $array->get(0);
			$array->set(0, $array->get($i));
			$array->set($i, $tmp_var);
			$this->build_heap($array, 0, $i - 1);
		}

		return $array;
	}
}