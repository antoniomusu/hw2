<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/homework.css">
    <link rel="stylesheet" href="css/entry.css">
    <script src="javascripts/entry.js" defer="true"></script>
    <title>login</title>
</head>
<body @if(isset($entryFlag)) class='no-scroll' @endif>
   
    <div id="login_flex">
        @if(isset($errors))
            @foreach($errors as $err)
                <p id='error'>{{$err}}</p>
            @endforeach
        @endif
        <form name = "registration_form" method = 'post' class = "data" autocomplete="off" >
        @csrf
            <p>
                <label>Username <input type = 'text' name ="username" value = '{{ old("username") }}' ></label>
            </p>
            <p>
                <label>Password <input type = 'password' name ="password"></label>
            </p>
            <p>
                <label>Email <input type = 'email' placeholder="example123@gmail.com" name ="mail" value = "{{ old('mail') }}"></label>
            </p>
            <p>
                <label>Conferma Password <input type = 'password' name ="cpassword"></label>
            </p>    
            <p>
                <label>Data di nascita <input type="date" name="dataNascita" min="1900-01-01" max="2010-01-01" value ='{{ old("dataNascita") }}' ></label>
            </p>
            <p>    
                <input type="submit" value="Registrati">
            </p>
            <a href="login">Hai già un account?</a>
        </form>
        <div id="message" class = "hidden">
            <h3>La Password deve contenere:</h3>
            <p id="letter" class="invalid"><b>Almeno una lettera minuscola</b></p>
            <p id="capital" class="invalid"> <b>Almeno una lettera maiuscola</b></p>
            <p id="number" class="invalid"><b>Almeno un numero</b></p>
            <p id="length" class="invalid"><b>Minimo 8 caratteri</b></p>
        </div>
    </div>
   
    <div id='modal-logout' @if(!isset($entryFlag)||!$entryFlag) class = "hidden" @endif>
            <img src='images/entry.png' class='waifu-img'>
            <div>
                <p>Registrazione effettuata con successo!</p>
                <button>Okay</button>
            </div>
    </div>
    @include('footer')
</body>
</html>