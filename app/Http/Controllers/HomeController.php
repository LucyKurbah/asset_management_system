<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Device;
use App\Models\Allocation;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role   = Auth::user()->role->role_name;
        $users  = User::where([['id','!=',1],['id','!=',2]])->count();
        $device  = Device::count();
        $allocatedDevices  = Allocation::count();
        // $bills  = Bill::count();
        // $advertisements  = Advertisement::count(); 
        // $sidebars = Sidebar::with('subMenus')->get();
        // $hod  = Advertisement::count('hod'); 
        // $empanelledCounts = Empanelled::with(['assigned_news' => function ($query) {
        //     $query->select('empanelled_id', 'advertisement_id')->groupBy('empanelled_id', 'advertisement_id');
        // }])->get(); 
   
        session()->put('role', $role);
        return view('home')->with(compact('role','users','device','allocatedDevices'));
    }

    
}
