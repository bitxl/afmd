<?php
if(!isset($_GET['amount']) || $_GET['amount'] == ""){
	echo "<p class='text-danger'>No amount of runs specified</p>";
	die();
} else {
	$amount = $_GET['amount'];
}
if(!isset($_GET['input']) || $_GET['input'] == ""){
	echo "<p class='text-danger'>No input specified</p>";
	die();
} else {
	$input = $_GET['input'];
}
if(!isset($_GET['type']) || $_GET['type'] == ""){
	echo "<p class='text-danger'>No type of algorithm specified</p>";
	die();
} else {
	$type = $_GET['type'];
}

if(!isset($_GET['error']) || $_GET['error'] == ""){
	$error_rate = 0;
} else {
	$error_rate = $_GET['error'];
}
set_time_limit(0);
include_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.mergesort.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/algorithms/class.quicksort.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/input/class.input.php');

switch($type){
	case 'mergesort':
		$algorithm = new MergeSort();
		$name = 'MergeSort';
		break;
	case 'quicksort':
		$algorithm = new QuickSort();
		$name = 'QuickSort';
		break;
}

$input = new Input($input);
$buggydata = new BuggyArray($error_rate);
$buggydata->loadFromDisk($input->getInputData());

$algorithm->setBuggyData($buggydata);
for($i = 0; $i < $amount; $i++){
	$algorithm->run();
}
$stats = $algorithm->getStats();
?>
<div class="row">
	<div class="col-lg-3">
		<h2 style="margin-top:0px;">Averages - <?= $amount ?> runs<br><small><?=$type;?></small></h2>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-sm-4">
						<p><b>Time</b></p>
					</div>
					<div class="col-sm-8">
						<p><?= $stats[$name]['averages']['runtime']; ?> ms</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<p><b>Appearance</b></p>
					</div>
					<div class="col-sm-8">
						<p><?= $stats[$name]['averages']['appearance'] * 100; ?>%</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<p><b>Changes</b></p>
					</div>
					<div class="col-sm-8">
						<p><?= $stats[$name]['averages']['changes']; ?> / <?= $stats[$name]['averages']['totalpossiblechanges']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<?php
		foreach($stats[$name] as $key => $run){
			if($key === 'averages') continue;
			$succes_percentage = $run['measures']['appearance'] * 100;
			$success_classname = 'danger';
			if($succes_percentage > 20) $success_classname = 'warning';
			if($succes_percentage > 50) $success_classname = 'info';
			if($succes_percentage > 80) $success_classname = 'success';
			?>
			<div class="">
				<a href="#collapse<?=$key?>" data-toggle="collapse">
					<div class="row">
						<div class="col-md-2">
							<h3 style="margin-top:0px;">Run <?= $key ?></h3>
						</div>
						<div class="col-md-10">
							<div class="progress">
								<div class="progress-bar progress-bar-<?=$success_classname?>" role="progressbar" style="width: <?= $succes_percentage ?>%">
									<?= $succes_percentage ?>%
								</div>
							</div>
						</div>
					</div>
				</a>
				<div class="row collapse" id="collapse<?=$key?>" style="margin-bottom:20px;">
					<div class="col-md-6">
						<div class="row">
							<div class="col-sm-6">
								<p><b>Time</b></p>
							</div>
							<div class="col-sm-6">
								<p><?= ($run['stop'] - $run['start']) * 1000 ?> ms</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<p><b>Appearance</b></p>
							</div>
							<div class="col-sm-6">
								<p><?= $run['measures']['appearance'] * 100 ?>%</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<p><b>Changes</b></p>
							</div>
							<div class="col-sm-6">
								<p><?= $run['measures']['changes'] ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<p><b>Out of possible</b></p>
							</div>
							<div class="col-sm-6">
								<p><?= $run['measures']['totalpossiblechanges'] ?></p>
							</div>
						</div>
					</div>
					<div class="col-md-6" style="max-height: 200px;overflow: auto;">
						<pre style="width:49%;float:left;max-width: none;"><? echo implode("\n", $run['data']['unsorted']); ?></pre>
						<pre style="width:49%;float:right;max-width: none;"><? echo implode("\n", $run['data']['sorted']); ?></pre>
					</div>
				</div>

			</div>
		<? } ?>
	</div>