<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' href='./css/login.css'>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PicturesDB - Login</title>
    </head>
    <body>
        <main class="login">

        <section class="main_piscturesDB">
			<h1>PicturesDB</h1>
			<div id = "details">
				<motto> Colleziona immagini e condividile con i tuoi amici!</motto>
			</div>
            <h3>ACCEDI</h3>

            @if($error == 'empty_fields')
            <span class = "error"> Compilare tutti i campi </span>
            @elseif($error == 'wrong')
            <span class = "error"> Credenziali non valide </span>
            @endif

            <form name='login' method='post'>
                @csrf
                <div class="username">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username' value = '{{ old("username") }}'></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' value = '{{ old("password") }}'></div>
                </div>
                <div class="submit">
                    <input type='submit' value="Accedi" id = "submit">
                </div>
            </form>
            <div class="signup">Non hai un account? <a href="{{ url('signup')}}" class = "button">Iscriviti</a>
        </section>
        </main>
		<footer>
			<p>Realizzato da: <strong>Mattia Raciti 1000001206</strong></p>
		</footer>
    </body>
</html>
