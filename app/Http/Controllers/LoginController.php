<?php 
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Request;
use Session;
use App\Models\User;

class LoginController extends BaseController
{
    private function controlSession()
    {
        if(Session::has('username'))
            //Reindirizzo alla home
            return redirect('home');
    }

    public function redirect_login(){
        return redirect('login');
    }

    public function login()
    {
        $this->controlSession();
        $text = "Per accedere ai contenuti devi prima effettuare il login:";
        $source= "images/login.png";
        return view('login')->with('text', $text)->with('source', $source);
    }

    public function do_login(){
        //Verifico l'esistenza di dati POST
        if(!empty(Request::post('username')) && !empty(Request::post('password')))
        {   
            $username = Request::post("username");
            $password = Request::post("password");
            $user = User::where('username', $username)->first();
            if($user){
                if(password_verify($password, $user->password)){
                    //Imposto la variabile di sessione
                    Session::put("username", $username);
                    //Rimando alla home
                    return redirect("home");
                }
            }

            //Rimando al login con modifiche
            $text = "Ops.. Credenziali errate!"; 
            $source = "images/error.png";
            return view("login")->with('text', $text)->with('source', $source);
        }
    }

    public function entry(){
        return view('entry');
    }

    public function signup(){
        $this->controlSession();
        $error = array();
        $entryFlag = false;
        if(!empty(Request::post("username")) && !empty(Request::post("password")) && !empty(Request::post("mail")) && !empty(Request::post("username"))){
            //#USERNAME
            //Assegnamento dell'input
            $username = Request::post("username");
            if (User::where('username', $username)->first()) {
                $error[] = "Username già utilizzato";
            }
            #PASSWORD
            $password = Request::post('password');
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            if(!$uppercase||!$lowercase||!$number ||strlen($password) < 8)
                $error[] = "Password non conforme";
            //#EMAIL
            if (!filter_var(Request::post('mail'), FILTER_VALIDATE_EMAIL)){
                $error[] = "Email non valida";
            }else{
                $email = strtolower( Request::post("mail"));
                if(User::where('mail', $email)->first()){ 
                    $error[] = "Email già in uso";
                }
            }
            if(count($error) == 0){
                $password_enc = password_hash($password, PASSWORD_BCRYPT);
                $user = new User;
                $user -> username = $username;
                $user -> password = $password_enc;
                $user -> mail = $email;
                $user -> dataNascita = Request::post('dataNascita');
                $user -> save();
                $entryFlag = true;
            } 
            
        }else{
            $error[] = "Campi vuoti";
        }
        //return dd($error);
        return view('entry')->with("entryFlag", $entryFlag)->with("errors",$error);
    }

    public function logout(){
        Session::flush();
        return redirect('login');
    }
}