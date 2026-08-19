<!DOCTYPE html>
<html>
    <head>
        <script>
            const BASE_URL = "{{ url('/') }}/"
        </script>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='./css/signup.css'>
        <script src='./js/signup.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>PicturesDB - Create an account</title>
    </head>
    <body>
        <main>
			<header>

			</header>
        <section class="main_picturesDB">
			<h1>PicturesDB</h1>
			<div id = "details">
				<motto> Collect images and share them with your friends!</motto>
			</div>
            <h2>CREATE AN ACCOUNT</h2>
			<div id = "details">
				<p> Note: Your password must contain at least 8 characters, including at least one number, one uppercase letter, one lowercase letter, and one special character.</p>
			</div>
			
            @if($error == 'empty_fields')
            <span class = "error"> Please fill in all fields. </span>
            @endif

            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="username">
                    <div><label for='username'>Username</label></div>
                    <div><input type='text' name='username' value = '{{ old("username") }}'></div>
                    
                    @if($error == 'existing')
                    <span class = "error"> That username is already taken. </span>
                    @endif

                    <span class = "error" ></span>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' value = '{{ old("password") }}'></div>
                    
                    @if($error == 'wrong_characters')
                    <span class = "error"> Password must meet the required criteria. </span>
                    @endif
                    
                    <span class = "error" ></span>
                </div>
				
				<div class="confirm_password">
                    <div><label for='confirm_password'>Confirm password</label></div>
                    <div><input type='password' name='confirm_password' value = '{{ old("confirm_password") }}'></div>

                    @if($error == 'bad_passwords')
                    <span class = "error"> Passwords do not match. </span>
                    @endif
                
                </div>
             
                <div class="submit">
                    <input type='submit' value="Create account" id="submit">
                </div>
            </form>
            <div class="signup">Already have an account? <a href="{{ url('login')}}" class="button" >Log in</a>
        </section>
			<footer>
				<p>Built by Mattia Raciti</p>
			</footer>
        </main>
    </body>
</html>