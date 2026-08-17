<!DOCTYPE html>
<html>
	<head>
        <script>
            const BASE_URL = "{{ url('/') }}/"
        </script>

		<meta charset="utf-8">
		<title>PicturesDB - favorites</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="./css/preferiti.css">
		<script src="{{ url('js/preferiti.js') }}" defer="true"></script>
	</head>
		<header>
			<div>
				<h1>
					<strong>Your favorites</strong>
				</h1>
			</div>
		</header>
		
		<nav id="links">
			<a href="{{url('home')}}" class="button">Back</a>
		</nav>
		<section id = "error-view">
		
		</section>
		
		<section id = "library-view">
		
		</section>
	<body>
</html>

<section id = "library-view">
  </section>