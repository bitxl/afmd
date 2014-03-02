<?
$title = " | Home";
include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/header.php');?>

	<div class="container">
		<p>In this project we will experiment with keeping an algorithm running in the case in which you have a large
			memory that is reliable but only allows indirect access, and a small memory that allows direct access but is
			buggy.</p>
		<h3 class="text-center">The algorithms tested</h3>
		<div class="row">
			<div class="col-md-4">
				<h2>Mergesort</h2>
				<p>A merge sort is an O comparison-based sorting algorithm. Most implementations produce a stable sort,
					which means that the implementation preserves the input order of equal elements in the sorted
					output.</p>
				<table class="table">
					<thead><tr><th colspan="2">Running times</th> </tr></thead>
					<tr>
						<th>Worst case</th>
						<td>O(n log n)</td>
					</tr>
					<tr>
						<th>Average case</th>
						<td>O(n log n)</td>
					</tr>
				</table>
				<img src="http://upload.wikimedia.org/wikipedia/commons/c/cc/Merge-sort-example-300px.gif" alt="Mergesort visualized"/>
			</div>
			<div class="col-md-4">
				<h2>Quicksort</h2>
				<p>Quicksort, or partition-exchange sort, is a sorting algorithm developed by Tony Hoare that, on
					average, makes O comparisons to sort n items. In the worst case, it makes O comparisons, though this
					behavior is rare.</p>
				<table class="table">
					<thead><tr><th colspan="2">Running times</th> </tr></thead>
					<tr>
						<th>Worst case</th>
						<td>O(n<sup>2</sup>)</td>
					</tr>
					<tr>
						<th>Average case</th>
						<td>O(n log n)</td>
					</tr>
				</table>
				<img src="http://upload.wikimedia.org/wikipedia/commons/6/6a/Sorting_quicksort_anim.gif" alt="Quicksort visualized"/>
			</div>
			<div class="col-md-4">
				<h2>Heapsort</h2>
				<p>Heapsort is a comparison-based sorting algorithm. Heapsort is part of the selection sort family; it
					improves on the basic selection sort by using a logarithmic-time priority queue rather than a
					linear-time search.</p>
				<table class="table">
					<thead><tr><th colspan="2">Running times</th> </tr></thead>
					<tr>
						<th>Worst case</th>
						<td>O(n log n)</td>
					</tr>
					<tr>
						<th>Average case</th>
						<td>O(n log n)</td>
					</tr>
				</table>
				<img src="http://upload.wikimedia.org/wikipedia/commons/1/1b/Sorting_heapsort_anim.gif" alt="Heapsort visualized"/>
			</div>
		</div>
	</div>

<? include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/footer.php');?>