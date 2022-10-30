@extends('layouts.app')

@section('page-title', 'Streamline')
@section('page-heading', 'Streamline')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
	{{ $tr->title }}
    </li>
@stop

<?php
	$nij = 0;
	$css_display='';
	$css_input='';
	$trealet_id = $tr->id_str;	
?>


@if(!$scored)
	@section('trealet-desc',$d['desc'])
@endif

@section('content')
	<center><h1>{{ $tr['title'] }}</h1>
	<h4 class='text-muted'>({{ $creator->get_fullname() }})</h4></center>
	@if($scored)
		<div class="alert alert-info">
		<h3>Bạn nhận được phản hồi từ hệ thống. Hãy bấm vào <a href="trealet-play-details?tr={{ $trealet_id }}">đây</a> để xem nhận xét.</h3>
		</div>
	@else
		<div class="card">
		<h4 class="card-header">Lời giới thiệu</h4>
		<div class="card-body">{{ $d['desc'] }}</p></div>	
		</div>
		@foreach($items as $item)
			@include('trealets.partials.item')
			<?php
				$nij++;
			?>
		@endforeach
	@endif
@stop

@section('styles')
@stop