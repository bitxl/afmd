<? include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/input/class.input.php');
$allInputs = Input::getAll();
$names = array(
	'mergesort' => "MergeSort",
	'quicksort' => "QuickSort"
);
?>
	<script>
		var ajaxResult = null;
		function reloadResults(){
			$("#results").html('');
			$("#ajaxloader, #stopbutton").show();
			if(ajaxResult != null){
				ajaxResult.abort();
			}
			ajaxResult = $.ajax({
				url: '/algorithms/runner.php',
				data: $("#specsform").serialize(),
				success: function(data){
					$("#results").html(data);
					$("#ajaxloader, #stopbutton").hide();
				},
				error: function(data){
					$("#results").html("<p class='text-danger'>Something went wrong getting the results</p>");
					$("#ajaxloader, #stopbutton").hide();
				}
			});
		}
		function stopLoading(){
			ajaxResult.abort();
			$("#results").html("<p class='text-danger'>You stopped the runs</p>");
			$("#ajaxloader, #stopbutton").hide();
		}
	</script>
	<h1><?= $names[$_GET['type']] ?></h1>
	<form onsubmit="reloadResults();return false;" id="specsform">
		<input type="hidden" name="type" value="<?= $_GET['type']; ?>">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="amount">Runs</label>
					<input type="number" class="form-control" id="amount" placeholder="amount of runs" name="amount" min="0" value="5">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="input">Input</label>
					<select name="input" id="input" class="form-control">
						<? foreach($allInputs as $input){ ?>
							<option value="<?= $input->name ?>"><?= $input->name ?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="errorrate">Error rate (0 - 1)</label>
					<input type="number" step="0.001" class="form-control" id="errorrate" placeholder="error rate, between 0 and 1" name="error" min="0" value="0.001">
				</div>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-info" style="margin-top:25px;">
					run! <span class="glyphicon glyphicon-fast-forward"></span>
				</button>
				<a href="javascript:stopLoading();" class="btn btn-danger" style="margin-top:25px;display:none;" id="stopbutton">
					stop <span class="glyphicon glyphicon-stop"></span> </a> &nbsp;
				<img src="/css/img/ajax-loader.gif" alt="Loading..." style="margin-top:24px;display:none;" id="ajaxloader"/>
			</div>
		</div>
	</form>
	<hr/>
	<div id="results"></div>
<? include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/footer.php');?>