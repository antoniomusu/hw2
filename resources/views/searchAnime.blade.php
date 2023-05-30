<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/homework.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="/javascripts/homework.js" defer="true"></script>
    <script src="/javascripts/searchAnime.js" defer="true"></script>
    <title>searchAnime</title>
</head>
<body>
    
@include("navbar")

    <div class ="content">
        <h1>Risultati per {{$search}}:</h1>
        <div id=container>
            @if(count($result->data)>0)
                @foreach($result->data as $data)
                    <div id="{{ $data->mal_id }} ">
                        <img src=" {{ $data->images->jpg->image_url }} ">
                        <h3> {{ $data->title }} </h3>
                    </div>
                @endforeach   
            @else
                <h1>Nessun risultato trovato!</h1>
            @endif
        </div>
        
    </div>
    @include ("logout")
    @include ("footer") 
</body>
</html>