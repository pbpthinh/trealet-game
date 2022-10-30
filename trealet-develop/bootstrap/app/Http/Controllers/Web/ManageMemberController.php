<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\UserToTrealet;
use Vanguard\Groups;
use Mail;
class ManageMemberController extends Controller
{
    public function __construct()
    {
        // Allow access to authenticated users only.
        $this->middleware('auth');
    }

    public function index($trealet_id)
    {
        $output = new ConsoleOutput();
        $members = array();
        $gr = Groups::select('member_id', 'role')->where('trealet_id', $trealet_id)->get();
        $output->writeln($gr);
        foreach ($gr as $value) {
            $member = User::select()
                ->where('id', $value['member_id'])
                ->first();
            $member->role = $value['role'];
            $output->writeln($member);
            array_push($members, $member);

        };
        $emails = array();
        return view('trealets.trealet-share', compact('members'), compact('trealet_id')
            ,compact('emails'));
    }

    public function delete_member($member_id, $trealet_id)
    {
        $member = Groups::select()
            ->where('member_id', $member_id)
            ->where('trealet_id', $trealet_id)
            ->first();
        $member->delete();

        return redirect()->back()->withSuccess('Bạn đã xóa member thành công !');


    }

}
