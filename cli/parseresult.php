<?php
/**
 * Created by PhpStorm.
 * User: simone
 * Date: 07-04-14
 * Time: 19:22
 */

parse_str(implode('&', array_slice($argv, 1)), $_GET);

foreach(array('HeapSort', 'MergeSort', 'QuickSort') as $algo){
	$lines    = file('results/'.$algo.'.json');
	echo "**".$algo."**";
	$heapsort = array();
	foreach($lines as $line){
		$info                                                                = json_decode($line, true);
		$heapsort[$info['averages']['input']][$info['averages'][$_GET['x']]] = $info['averages'][$_GET['y']];
	}
	foreach($heapsort as $input => $info){
		echo $input."\n";
		foreach($info as $x => $y){
			echo $x."\t".$y."\n";
		}
	}
}