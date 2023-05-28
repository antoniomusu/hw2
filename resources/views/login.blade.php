<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/homework.css">
    <script src="/javascripts/login.js" defer="true"></script>
    <title>login</title>
</head>
<body>
    
    <div id="login_flex">
            <h1>{{$text}}</h1>
            <img src= {{$source}}>
        <form class = "data" name = "access_form" method = 'post' autocomplete= "off">
        @csrf
            <p>
                <label>Username <input type = 'text' placeholder="User" name ="username"></label>
            </p>
            <p>
                <label>Password <input type = 'password' placeholder="Password" name ="password"></label>
            </p>
            <p>    
                <input type="submit" value="Login">
            </p>
            <a href="">Password dimenticata?</a>
            <a href="entry">Non hai ancora un account?</a>
        </form>
    </div>
    @include('footer')
</body>
</html>