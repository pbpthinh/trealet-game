@extends('layouts.app')

@section('page-title', 'Play details')
@section('page-heading', 'Play details')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        The details of your Trealet
    </li>
@stop

<?php
	$h = "https://" . $_SERVER["HTTP_HOST"].'/';
	$score = NULL;	
	$play_selected = false;
?>

@section('content')
    @include('partials.messages')
	
	<h1>{{ $tr['title'] }}</h1>
	<div> - Creator: {{$creator->get_fullname()}}</div>
	<div> - Created at: {{ $tr['created_at'] }}</div>
	
	@if(isset($players))
		<div class="card"><div class="card-body"><div class="table-responsive" id="users-table-wrapper">
		<h2>{{ $players->count() }} Plays:</h2>
		@foreach ($players as $player)
			@if($player['id']!=$pl_id)
				<a href="trealet-play-details?tr={{ $tr['id_str'] }}&pl={{ $player['id'] }}"><span class="badge badge-lg badge-dark">{{ $player->get_fullname() }}</span></a>
			@else
				<?php
				$play_selected = true;
				?>
				<a href="trealet-play-details?tr={{ $tr['id_str'] }}&pl={{ $player['id'] }}"><span class="badge badge-lg badge-success">{{ $player->get_fullname() }}</span><a>
			@endif
		@endforeach
		</div></div>
	@endif
	
@if($play_selected || !isset($players))
	<div class="card"><div class="card-body">
		<div class="table-responsive" id="users-table-wrapper">
			<table class="table table-borderless table-striped">
				<thead>
				<tr>
					<th class="min-width-80">@lang('Order')</th>
					<th class="min-width-80">@lang('Type')</th>
					<th class="min-width-80">@lang('Input at')</th>
					<th class="min-width-200">@lang('Content')</th>
				</tr>
				</thead>
				<tbody>
					@if (count($utts))
						@foreach ($utts as $utt)
							<?php
							if($utt->type=='score')
							{
								$score = $utt;
							}
							else{
							?>
								<tr>
									<td class="align-middle">{{ $utt->no_in_json }}</td>
									<td class="align-middle">{{ $utt->type }}</td>
									<td class="align-middle">{{ $utt->created_at->format('y-m-d h:m') }}</td>
									<td class="align-middle">
										@if ($utt->type=='picture')
										<img src='{{ $h.$utt->data }}'>
										@elseif ($utt->type=='audio')
										<audio controls>  
											<source src='{{ $h.$utt->data }}' type="audio/mpeg">
										</audio>
										@else
											{{ $utt->data }}
										@endif
									</td>
								</tr>
							<?php
							}
							?>
						@endforeach
					@else
						<tr>
							<td colspan="4"><em>@lang('No records found.')</em></td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

	@include('trealets.partials.scores')
@endif
@stop

@section('styles')
    <style>
        .user.media {
            float: left;
            border: 1px solid #dfdfdf;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 4px;
            margin-right: 15px;
        }
    </style>
@stop