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
<div class="row">

    <div class="col-md-2">
        <div class="card widget">
            <div class="card-body">
                <a href="streamline-edit">New streamline</a>
            </div>
        </div>
    </div>
    

    <div class="col-md-2">
        <div class="card widget">
            <div class="card-body">
                <a href="stepquest-edit">New stepquest</a>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card widget">
            <div class="card-body">
                <a href="qrMedia-edit">New qrMedia</a>
            </div>
        </div>
</div>

    <div class="col-md-2">
        <div class="card widget">
            <div class="card-body">
                <a href="map-edit">New map</a>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <h3>My Trealet</h3>
        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th class="min-width-80">@lang('ID')</th>
                        <th class="min-width-200">@lang('Title')</th>
                        <th class="min-width-80">@lang('Type')</th>
                        <th class="min-width-80">@lang('Create at')</th>

                        <th class="min-width-80">@lang('Open at')</th>
                        <th class="min-width-80">@lang('Close at')</th>
                        <th class="min-width-80">@lang('Published')</th>
                        <th class="text-center min-width-150">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($trs))
                    @foreach ($trs as $tr)
                    @if($tr->active == 0)
                    @include('trealets.partials.trealet-row')
                    @endif
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9"><em>@lang('No records found.')</em></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>


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

    #users-table-wrapper {
        min-height: 200px;
    }
    </style>
    @stop