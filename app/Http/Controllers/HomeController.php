<?php 
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;
use App\Models\User;
use App\Models\Event;
use App\Models\SavedAnime;

class HomeController extends BaseController
{
    private function controlSession()
    {
        if(!Session::has('username'))
            //Reindirizzo alla home
            return redirect('login');
    }

    public function home(){
        $this->controlSession();
        return view('home');
    }

    public function restoreEvents(){
        $user = User::where('username', Session::get('username'))->first();
        $events = \DB::select("SELECT user, TIME(date) as time, animeID, title, type FROM EVENT WHERE user =? and DATE(date) > DATE_SUB(current_date(), interval 1 day) order by time desc", [$user->username]);
        return json_encode($events);
    }

    public function profile($username){
        $this->controlSession();
        $user = User::find($username);
        return view('profile')->with('user', $user);
    }

 
}