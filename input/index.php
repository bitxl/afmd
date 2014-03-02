<?
$title = "| Input sets";
$page = "input";
include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/input/class.input.php');
?>
<?php
if($_GET['name'] == ""){
	$allInputs = Input::getAll(); ?>
	<h1>Input data</h1>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#current">Available</a></li>
		<li><a href="#new">New</a></li>
	</ul>
	<br>
	<div class="tab-content">
		<div class="tab-pane active" id="current">
			<?php if(count($allInputs) == 0){ ?>
				<div class="alert alert-danger">There are no input files present yet</div>
			<? } else { ?>
				<ul class="list-group">
					<?php foreach($allInputs as $input){ ?>
						<li class="list-group-item">
							<a href="/input/<?= $input->name ?>">
								<?= $input->name."  (".count($input->getInputData()).")"; ?>
							</a>
							<form action="/posthandler.php" method="post" class="pull-right">
								<input type="hidden" value="deleteInput" name="action">
								<input type="hidden" value="<?= $input->name ?>" name="name">
								<button type="submit" style="background:none;border:none;"><span class="glyphicon glyphicon-remove text-danger"></span></button>
							</form>
						</li>
					<? } ?>
				</ul>
			<? } ?>
		</div>
		<div class="tab-pane" id="new">
			<form role="form" method="post" action="/posthandler.php">
				<input type="hidden" value="saveInput" name="action"/>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" placeholder="Enter name without spaces" name="name">
				</div>
				<div class="form-group">
					<label for="data">Data</label>
					<small>(newline seperated numbers)</small>
					<textarea class="form-control" id="data" name="data" style="resize: none;" rows="20"></textarea>
				</div>
				<button type="submit" class="btn btn-success pull-right">
					<span class="glyphicon glyphicon-floppy-disk"></span> save
				</button>
			</form>

		</div>
	</div>
<? } else {
	$input = new Input($_GET['name']);
?>
	<a href="/input/" class="pull-right btn btn-default clearfix">back to all sets</a>
	<br>
	<h2 class="text-info"><?=$_GET['name']?> <small class="pull-right" style="padding-top:20px;">&nbsp;&nbsp;<b>n</b> <?=count($input->getInputData());?> &nbsp;&nbsp; <b>average</b> <?= round(array_sum($input->getInputData())/count($input->getInputData()), 2);?></small></h2>
	<div class="row">
		<div class="col-md-6">
			<h3>Raw input</h3>
			<pre><?php echo implode("\n", $input->getInputData());?></pre>
		</div>
		<div class="col-md-6">
			<h3>Sorted input</h3>
			<pre><?php echo implode("\n", $input->getSortedInputData());?></pre>
		</div>
	</div>
<? } ?>

<? include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/footer.php'); ?>