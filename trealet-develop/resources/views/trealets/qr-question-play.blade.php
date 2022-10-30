@extends('layouts.app')

@section('page-title', 'My Trealets')
@section('page-heading', 'My Trealets')

@section('breadcrumbs')
	<li class="breadcrumb-item active">
		You can create your own Trealets and share it to play
	</li>
@stop

@section('content')
	@include('partials.messages')
<div>
    <div id="app">
    </div>
    <!-- <script src="./js/qr.js"></script> -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- <script src="{% static 'js/app.js' %}"></script> -->

</div>
@stop

@section('styles')
<style>
    .content-page {
        flex: 1 !important;
        margin-left: 0 !important;
    }
</style>
@stop
