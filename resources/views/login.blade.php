<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='./css/login.css'>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PicturesDB - Login</title>
    </head>
    <body>
        <main class="login">

        <section class="main_piscturesDB">
			<h1>PicturesDB</h1>
			<div id = "details">
				<motto> Collect images and share them with your friends!</motto>
			</div>
            <h3>LOG IN</h3>

            @if($error == 'empty_fields')
            <span class = "error"> Please fill in all fields. </span>
            @elseif($error == 'wrong')
            <span class = "error"> 	The username or password is incorrect. </span>
            @endif

            <form name='login' method='post'>
                @csrf
                <div class="username">
                    <div><label for='username'>Username</label></div>
                    <div><input type='text' name='username' value = '{{ old("username") }}'></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' value = '{{ old("password") }}'></div>
                </div>
                <div class="submit">
                    <input type='submit' value="Log in" id = "submit">
                </div>
            </form>
            <div class="signup">Don't have an account? <a href="{{ url('signup')}}" class = "button">Create an account</a>
        </section>
        </main>
		<footer>
			<p>Built by Mattia Raciti</p>
		</footer>
    </body>
</html>
