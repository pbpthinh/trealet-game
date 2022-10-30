<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpOption\None;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Vanguard\Invite;
use Vanguard\Mail\InviteCreated;
use Vanguard\Trealets;
use Vanguard\User;


class  VideoController  extends Controller
{
    public function index($id)
    {
        return view('trealets.360video', ['id' => $id]);
    }
}
