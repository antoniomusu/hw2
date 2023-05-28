
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/homework.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="/javascripts/homework.js" defer="true"></script>
    <script src="/javascripts/home.js" defer="true"></script>
    <title>home</title>
</head>
<body>
    
    @include ("navbar")

    <div class ="content">
        
        <h1> Benvenuto {{Session::get('username')}}!</h1>   
    
        <div>Le tue attività giornaliere:</div>
    </div>
        @include ("logout")
        @include ("footer") 
</body>
</html>