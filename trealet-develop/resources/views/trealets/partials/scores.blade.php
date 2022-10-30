<div class="alert alert-info">
	<h2>Scores</h2>
@if(!$score)
	@if(isset($players))
		<table width="100%">
		<tr>
		<td style="text-align: right">Comment:</td><td> <input type="text" class="form-control input-solid" id="comment" name="comment"></td>
		</tr>
		<tr>
		<td style="text-align: right">Mark:</td><td> <select id="mark" name="mark">
		  <option value="0">0</option>
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		  <option value="10">10</option>
		</select></td>
		<tr>
		<td style="text-align: right">Passed:</td> <td><input name="passed" id="passed" type="checkbox"></td>
		</tr>
		<tr>
		<td style="text-align: right"></td> <td><button type="submit" class="btn btn-primary" name='submit' id='submit' onclick="onSubmit({{ $pl_id }},'{{ $tr['id_str'] }}')">Submit</button></td>
		</tr>
		</table>
	@else
		<h3>You are not scored, please wait for the creator of the trealet!</h3>
	@endif
@else
	<?php
	$d = json_decode($score['data'], true);
	?>
	<table width="100%">
	<tr>
	<td style="text-align: right">Comment:</td><td> {{ $d['comment'] }}</td>
	</tr>
	<tr>
	<td style="text-align: right">Mark:</td><td> {{ $d['mark']}}</td>
	<tr>
	<td style="text-align: right">Passed:</td><td> {{ $d['passed'] }}</td>
	</tr>
	
	@if(isset($players))
		<tr>
		<td style="text-align: right"></td> <td><button type="submit" class="btn btn-primary" name='submit' id='submit' onclick="onClearScores({{ $pl_id }},'{{ $tr['id_str'] }}')">Clear scores</button></td>
		</tr>
	@endif
	</table>
@endif

</div>
<script>
function onSubmit(pl_id,tr_str)
{
	values = {};
	values.user_id		= pl_id;
	values.trealet_id 	= tr_str;
	
	values.scored		= true;
	values.comment		= $('#comment').val();
	values.mark			= $('#mark').val();
	values.passed		= $('#passed').is(':checked');
	
	var http = new XMLHttpRequest();
	http.open("POST", "trealet-play-details/score", true);
	http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var params = 'data=' + encodeURIComponent(JSON.stringify(values))+'&_token='+'{{ csrf_token() }}';
	
	http.send(params);
	http.onload = function() {
		$('#submit').html('<p>' + http.responseText + '</p>');
	}	
}

function onClearScores(pl_id,tr_str)
{
	values = {};
	
	values.user_id		= pl_id;
	values.trealet_id 	= tr_str;
	
	values.scored		= false;
		
	var http = new XMLHttpRequest();
	http.open("POST", "trealet-play-details/score", true);
	http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var params = 'data=' + encodeURIComponent(JSON.stringify(values))+'&_token='+'{{ csrf_token() }}';
	
	http.send(params);
	http.onload = function() {
		$('#submit').html('<p>' + http.responseText + '</p>');
	}
}
</script>
