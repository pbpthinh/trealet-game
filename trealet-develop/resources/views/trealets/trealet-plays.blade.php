@extends('layouts.app')

@section('page-title', 'Trealet plays')
@section('page-heading', 'Trealet plays')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        You have played the following Trealets, click to see the details.
    </li>
@stop

@section('content')
    @include('partials.messages')
	
	<div class="card"><div class="card-body">
		<div class="table-responsive" id="users-table-wrapper">
			<table class="table table-borderless table-striped">
				<thead>
				<tr>
					<th class="min-width-80">@lang('ID')</th>
					<th class="min-width-200">@lang('Title')</th>
					<th class="min-width-80">@lang('Played at')</th>
					<th class="text-center min-width-150">@lang('Action')</th>
				</tr>
				</thead>
				<tbody>
					@if (count($utts))
						@foreach ($utts as $utt)
					<tr>
						<td class="align-middle"><a href="trealet-play-details?tr={{ $utt->id_str }}">{{ $utt->id_str }}</a></td>
						<td class="align-middle">{{ $utt->title }} ({{ $utt->username }})</td>
						<td class="align-middle">{{ $utt->played_at->format('y-m-d h:m') }}</td>
						<td class="text-center align-middle">
							<a href="#"
							   class="btn btn-icon"
							   title="@lang('Delete Trealet')"
							   data-toggle="tooltip"
							   data-placement="top"
							   data-method="DELETE"
							   data-confirm-title="@lang('Please Confirm')"
							   data-confirm-text="@lang('Are you sure that you want to delete this trealet?')"
							   data-confirm-delete="@lang('Yes, delete it!')">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
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