<!-- 
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="step-quest"></div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html> -->

@extends('layouts.app')

@section('page-title', 'Search a trealet to play')
@section('page-heading', 'Search a trealet to play')


@section('content')
<div>
    <div id="stepquest"></div>
    <script src="{{asset('js/app.js')}}"></script>
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