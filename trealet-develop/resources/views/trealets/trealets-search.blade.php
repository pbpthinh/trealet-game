@extends('layouts.app')

@section('page-title', 'Search a trealet to play')
@section('page-heading', 'Search a trealet to play')


@section('content')
    @include('partials.messages')

    <div class="card">
	<h4 class="card-header">Nhập từ khóa để tìm trealets</h4>

	<div class="card-body">	<center><input id="search" type="text" placeholder="" style='width:70%' autofocus/>
	<button type="submit" class="btn btn-dark" name='search' id='search'>Tìm</button>
	</center>
	</div>
	</div>

	@foreach($trs as $tr)
	<?php
		$play_tr = 'play/'.$tr->id;
		
		
        if($tr->type == "maps") {
		    $play_tr = $tr->type.'?tr='.$tr->id_str;
        }
	?>
    @if($tr->published == "1")
        <div class="user media d-flex align-items-center">
			<a href='{{ $play_tr }}'>
            <div class="d-flex justify-content-center flex-column">
				<h5 class="mb-0">{{ $tr->title }}</h5>
                <small class="text-muted">{{ $tr->creator }}</small>
            </div>
			</a>
        </div>
    @endif
    @if($tr->published == "2" )
        <div class="user media d-flex align-items-center">
            <a>
            <div href='{{ $play_tr }}' href="" data-toggle="modal" data-target="#exampleModalLong">
                <div class="d-flex justify-content-center flex-column">
                    <h5 style="color: #179970" class="mb-0">{{ $tr->title }}</h5>
                    <small class="text-muted">{{ $tr->creator }}</small>
                </div>
            </div>
            </a>
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="check_pass_tr/{{$tr->id}}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                Hãy điền key của trealet...

                                <input style="margin-top: 20px" type="password"  name="key" id="search" class="form-control input-lg" placeholder="" />
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Vào chơi</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endforeach
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