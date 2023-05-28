
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/homework.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="/javascripts/homework.js" defer="true"></script>
    <script src="/javascripts/profile.js" defer="true"></script>
    <title>{{$user->username}}</title>
</head>
<body>
    @include ("navbar")
  
    <div id="logo">
        <img 
            @if($user->avatar != "default.jpeg") 
                src = '{{$user->avatar}}' 
            @else 
                src = '/images/default.jpeg'
            @endif
            @if($user->username == Session::get('username')) 
                id='profileImage' 
            @endif>
    </div>

    <div class ="content">
        <div id= "change-image" class="hidden"></div>
        <p>Username: {{$user->username}} </p>
        <p>Email: {{$user->mail}}</p>
        <p>Data di nascita: {{$user->dataNascita}} </p>
        @if( $user->username == Session::get('username'))
            <form>
                <textarea id ='bio' name='bio'>{{$user->BIO}}</textarea></br>
                <button>Modifica Bio</button>
            </form>
        @else
            <p id='bio'> {{$user->BIO}} </p>
        
        @endif
        <h1>Anime Salvati</h1>
        <div id="container">
        </div>
    </div>

    @include ("logout")
    @include ("footer") 

</body>
</html>