<? include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/input/class.input.php');
$allInputs = Input::getAll();
?>
	<script>
		function reloadResults(){
			$.ajax({
				url: '/algorithms/runner.php',
				data: $("#specsform").serialize(),
				success: function(data){
					$("#results").html(data);
				}
			});
		}
	</script>
	<form onsubmit="reloadResults();return false;" id="specsform">
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
			</div>
		</div>
	</form>
	<hr/>
	<div id="results"></div>
<? include_once($_SERVER['DOCUMENT_ROOT'].'/webincludes/footer.php');?>