<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.algorithm.php');

class HeapSort extends Algorithm{
	//Algorithm rebuild from http://php.dzone.com/articles/algorithm-week-heap-and

	public function __construct(){
		parent::__construct('HeapSort');
	}

	public function sort(){
		return $this->heapsort($this->buggy_data);
	}

	private function heapify(BuggyArray &$a, &$i, &$heap_size){
		$l = $i * 2 + 1;
		$r = $i * 2 + 2;

		if($l < $heap_size && $a->get($i) < $a->get($l)){
			$largest = $l;
		} else {
			$largest = $i;
		}

		if($r < $heap_size && $a->get($largest) < $a->get($r)){
			$largest = $r;
		}

		if($largest != $i){
			$t = $a->get($i);
			$a->set($i, $a->get($largest));
			$a->set($largest, $t);
			$this->heapify($a, $largest, $heap_size);
		}
	}

	private function build_heap(BuggyArray &$a, &$heap_size){
		$len = floor($heap_size / 2);
		for($i = $len; $i > -1; $i--){
			$this->heapify($a, $i, $heap_size);
		}
	}

	private function heapsort(BuggyArray &$a){
		$heap_size = $a->getCount();
		$this->build_heap($a, $heap_size);

		while($heap_size--){
			$t = $a->get($heap_size);
			$a->set($heap_size, $a->get(0));
			$a->set(0, $t);
			$this->build_heap($a, $heap_size);
		}
		return $a;
	}
}