<?php
require_once('class.algorithm.php');
class MergeSort extends Algorithm{

	public function __construct(){
		parent::__construct('MergeSort');
	}

	public function sort(){
		return $this->mergesort($this->buggy_data);
	}

	private function mergesort(BuggyArray $data){
		// Only process if we're not down to one piece of data
		$count = $data->getCount();
		if($count > 1){
			// Find out the middle of the current data set and split it there to obtain to halfs
			$data_middle = round($count / 2, 0, PHP_ROUND_HALF_DOWN);
			// and now for some recursive magic
			$data_part1 = $this->mergesort($data->slice(0, $data_middle));
			$data_part2 = $this->mergesort($data->slice($data_middle, $count));
			// Setup counters so we can remember which piece of data in each half we're looking at
			$counter1 = $counter2 = 0;

			// iterate over all pieces of the currently processed array, compare size & reassemble
			for($i = 0; $i < $count; $i++){
				// if we're done processing one half, take the rest from the 2nd half
				if($counter1 == $data_part1->getCount()){
					$data->set($i, $data_part2->get($counter2));
					++$counter2;
					// if we're done with the 2nd half as well or as long as pieces in the first half are still smaller than the 2nd half
				} elseif(($counter2 == $data_part2->getCount()) || ($data_part1->get($counter1) < $data_part2->get($counter2))) {
					$data->set($i, $data_part1->get($counter1));
					++$counter1;
				} else {
					$data->set($i, $data_part2->get($counter2));
					++$counter2;
				}
			}
		}
		return $data;
	}
}