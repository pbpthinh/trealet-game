<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<tr>
    <td class="align-middle">{{ $tr->id_str }}</a>
    </td>
    <td class="align-middle">{{ $tr->title }}</td>
    <td class="align-middle">{{ $tr->type }}</td>
    <td class="align-middle">{{ $tr->created_at->format('d-m-Y H:i:s')}}</td>

    <td class="align-middle">{{ $tr->open_at }}</td>
    <td class="align-middle">{{ $tr->close_at }}</td>

    @if ($tr->published == 0)

        <td class="align-middle">No one</td>
    @endif
    @if ($tr->published == 1)

        <td class="align-middle">Everyone</td>

    @endif
    @if ($tr->published == 2)

        <td class="align-middle">Everyone with key</td>
    @endif
        <td class="text-center align-middle">
            <div class="dropdown show d-inline-block">
                <a class="btn btn-icon"
                   href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                    @if ($tr->role == 1 || $tr->role == 0)
                        <a href="trealet-play-details?tr={{ $tr->id_str }}" class="dropdown-item text-gray-500">
                            <i class="fas fa-th-list mr-2"></i>
                            @lang('Check plays')
                        </a>
                    @endif
                    @if ($tr->role == 1 || $tr->role == 0)
                        <a href="qr/{{$tr->id}}" class="dropdown-item text-gray-500">
                            <i class="fas fa-th-list mr-2"></i>
                            @lang('Mã QR')
                        </a>
                    @endif

                    @if ($tr->type == "stepquest")
                    <a href="stepquest/{{$tr->id}}" class="dropdown-item text-gray-500">
                        <i class="fas fa-play mr-2"></i>
                        @lang('Play')
                    </a>
                    @else 
                    <a href="play/{{$tr->id}}" class="dropdown-item text-gray-500">
                        <i class="fas fa-play mr-2"></i>
                        @lang('Play')
                    </a>
                    @endif

                    @if ($tr->role == 1 || $tr->role == 0)
                        <a href="duplicate/{{$tr->id}}" class="dropdown-item text-gray-500">
                            <i class="fas fa-clone mr-2"></i>
                            @lang('Make a copy')
                        </a>
                    @endif
                    @if ($tr->role == 0 )
                        <a href="invite/{{$tr->id}} " class="dropdown-item text-gray-500">
                            <i class="fas fa-users   mr-2"></i>
                            @lang('Share')
                        </a>
                    @endif
                    @if ($tr->type == "maps" )
                        <a href="map-edit/{{$tr->id}} " class="dropdown-item text-gray-500">
                            <i class="fas fa-wrench mr-2"></i>
                                @lang('Update')
                        </a>
                    @endif
                   
                </div>
            </div>

            @if ($tr->role == 1 || $tr->role == 0 )
                <a href="show_edit_trealet/{{$tr->id}}"
                   class="btn btn-icon edit"
                   title="@lang('Edit Trealet')"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fas fa-edit"></i>
                </a>
            @endif
            @if ($tr->role == 0 )
                <a href='delete/{{ $tr->id }}'
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
            @endif
        </td>
</tr>
<style>
    .custom-select{
        background-color: unset;
        border: unset;
        color: black;
    }
</style>

