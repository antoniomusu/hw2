<?php 
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;
use App\Models\User;
use App\Models\SavedAnime;

class ProfileController extends BaseController{

    public function updateBio(){
        $user = User::find(Session::get('username'));
        $user->BIO = Request::post('bio');
        $user->save();
    }

    public function restoreSaves($username){
        $user = User::find($username);
        $saves = $user->saves()->get();
        return json_encode($saves); 

    }

    public function changeImage(){
        $img_endpoint = "https://api.waifu.pics/many/sfw/waifu";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $img_endpoint);
        curl_setopt($curl, CURLOPT_POST, 1); 
        curl_setopt($curl, CURLOPT_POSTFIELDS,"{}");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));    
        $result = curl_exec($curl);
        curl_close($curl);      
    }

    public function saveImage(){
        $user = User::find(Session::get('username'));
        $user->avatar = Request::get('url');
        $user->save();
    }

}