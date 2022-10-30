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


class InviteCreatorController extends Controller
{
    public function invite($trealet_id)
    {
        $output = new ConsoleOutput();
        $members = array();
        $gr = Invite::select('email', 'status')->where('trealet_id', $trealet_id)->get();
        foreach ($gr as $value) {
            $member = User::select()
                ->where('email', $value['email'])
                ->first();
            if($member) {
                $member->status = $value['status'];
                array_push($members, $member);
            }
        };
        $emails = array();
        return view('trealets.trealet-share', compact('members'), compact('trealet_id')
            ,compact('emails'));
    }
    public function process(Request $request, $trealet_id)
    {
        $output = new ConsoleOutput();

        $iv = Invite::select()
            ->where('email',$request->get('email'))
            ->where('trealet_id',$trealet_id)
            ->first();
        if($iv){
            return redirect()->back()->withSuccess('Người dùng đã có trong danh sách creator !' ) ;
        }
        do {
            //generate a random string using Laravel's str_random helper
            $token = Str::random(15);
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token,
            'status' => 'Unconfirm',
            'trealet_id' => $trealet_id
        ]);
        // send the email
        Mail::to($request->get('email'))->send(new InviteCreated($invite));
        // redirect back where we came from
        return redirect()
            ->back();
    }
    public function accept($token)
    {

        $invite = Invite::select()->where('token', $token)->first();

        if($invite-> status == "Active"){
            return redirect('my-trealets');
        }
        if($invite-> status == "Unconfirm")
        {
        $invite-> status = "Active";
        $invite ->save();
        $user = User::select()
            ->where('email', $invite->email)
            ->first();
        $tr = Trealets::select()
            ->where('id', $invite->trealet_id)
            ->first();
        $new_tr = $tr ->replicate();
        $new_tr ->user_id = $user->id;
        $new_tr ->save();
        return redirect('my-trealets');
        }

    }


}
