
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/homework.css">
    <link rel="stylesheet" href="/css/anime.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="/javascripts/homework.js" defer="true"></script>
    <script src="/javascripts/anime.js" defer="true"></script>
    <title>{{ $result->data->title}}</title>
</head>
<body>
    
    @include("navbar")
    <div id = "title">
        <div>
            <img id = "animeImage" src= "{{ $result->data->images->jpg->image_url }}" >
        </div>
        <div id = "description">
            <div 
                @if($saved) 
                    class='filled flexbox'>
                @else
                    class= 'unfilled flexbox'>
                @endif
                <span id = "name">{{ $result->data->title}}</span>
                <span id = "like" class="material-symbols-outlined">favorite</span>
            </div>
            <div>{{ $result->data->synopsis}}</div>
        </div>
    </div>
    <section id= "anime-content">
        <div id= "information">
            <div>Tipo: {{ $result->data->type }}</div>
            <div>Numero episodi: {{ $result->data->episodes }}</div>
            <div>Anno di produzione: {{ $result->data->year }}</div>
            <div>Tempo di uscita: {{ $result->data->aired->string }}</div>
            <div>Studio di produzione: {{ $result->data->studios[0]->name }}</div>
            <div>Produttori:
                    @foreach($result->data->producers as $producer) 
                        {{ $producer->name }}/
                    @endforeach
            </div>
            <div>Generi:
                    @foreach($result->data->genres as $genre) 
                        {{ $genre->name }}/
                    @endforeach
            </div>
        </div>
        <form id ="commentForm" name="comment">
        @csrf
            <p>Inserisci un commento qui:</p>
            <textarea name="comment" required></textarea>
            <input type="submit" value="Aggiungi il commento">
        </form>
        <div id="comments"></div>
    </section>
    
    @include ("logout")
    @include ("footer") 
</body>
</html>