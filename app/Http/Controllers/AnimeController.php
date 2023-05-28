<?php 
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;
use App\Models\User;
use App\Models\SavedAnime;
use App\Models\Comment;

class AnimeController extends BaseController
{
    private function controlSession()
    {
        if(!Session::has('username'))
            //Reindirizzo alla home
            return redirect('login');
    }

    public function searchAnime(){
        $this->controlSession();
        $dati = array("q" => Request::get('anime'));
        $dati = http_build_query($dati);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,"https://api.jikan.moe/v4/anime?sfw&".$dati."&limit=12");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $result = json_decode($result);
        curl_close($curl);
        return view("searchAnime")->with("result", $result)->with('search', Request::get('anime'));
    }

    public function showAnime($animeID){
        //Curl per dati dell'anime
        $curl = curl_init();
        $saved = false;
        curl_setopt($curl, CURLOPT_URL,"https://api.jikan.moe/v4/anime/".$animeID);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $result = json_decode($result);
        curl_close($curl);
        //Verifico se è tra i salvati
        $user = User::find(Session::get('username'));
        if($user->saves()->where('animeID', $animeID)->exists()){
          $saved = true;  
        }
        return view('anime')->with('result', $result)->with('saved',$saved);
    }

    public function addSaved(){
        $user = User::find(Session::get('username'));
        $saved = $user->saves()->where("animeID", Request::get('animeID'));
        if($saved->exists()){
            $saved->delete();
        }else{
            $newSave = new SavedAnime;
            $newSave->animeID = Request::get('animeID');
            $newSave->username = $user->username;
            $newSave->title = Request::get('title');
            $newSave->image = Request::get('image');
            $newSave->save();
        }
    }

    public function restoreComments(){
        $obj = \DB::table('COMMENTS')
        ->select('comment', 'user', 'avatar', 'date')
        ->join('USER','user','=','username')
        ->where('animeID','=',Request::get('animeID'))
        ->get();
        return json_encode($obj);
    }

    public function addComment(){
        $user = User::find(Session::get('username'));
        $comment = new Comment;
        $comment -> user = $user -> username;
        $comment -> comment = Request::post('comment');
        $comment -> title = Request::post('title');
        $comment -> animeID = Request::post('animeID');
        $comment -> save();
    }
}