<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if(!isset($title)){
	$title = "";
}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bad Small Memory - Web interface <?= $title; ?></title>
		<meta name="description" content="The HTML5 Herald">
		<meta name="author" content="SAA Alers, K Triantos">

		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/main.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/main.js"></script>
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>        <![endif]-->
	</head>
	<body>
		<div class="navbar navbar-inverse" role="navigation" style="border-radius:0px;">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
						<span class="icon-bar"></span> <span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Bad small memory</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="<?=$page=='home'?'active':''?>"><a href="/">Home</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Algorithms <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">Standard</li>
								<li><a href="/algorithms/mergesort">Mergesort</a></li>
								<li><a href="/algorithms/quicksort">Quicksort</a></li>
								<li><a href="/algorithms/heapsort">Heapsort</a></li>
								<li><a href="/algorithms/insertionsort">Insertionsort</a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Improved</li>
							</ul>
						</li>
						<li class="<?=$page=='input'?'active':''?>"><a href="/input/">Input sets</a></li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
		<div class="container">