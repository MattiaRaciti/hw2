<!DOCTYPE html>
<html>
  <head>
    <script>
        const BASE_URL = "{{ url('/') }}/"
    </script>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PicturesDB - home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/home.css">
    <script src="{{ url('js/home.js') }}" defer="true"></script>
  </head>

  <body>
    <header>
      <nav>
        <div id="links">
          <a2>PicturesDB</a2>
          <a href="{{ url('home') }}" class="button">Clear</a>
          <a href="{{ url('preferiti') }}" class="button">Favorites</a>
          <a href="{{ url('login') }}" class="button_b">Log out</a>

          <div id="details">
          </div>
        </div>

        <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>

      <h1>
        <strong>Image Search</strong><br/>
        <em>Collect images and share them with your friends!</em><br/>
        <br><a3>Welcome, {{ $username }}!</a3></br>
      </h1>
    </header>

    <section id="search-view">
      <form>
        <label>
          Search:
          <input type="text" name="content" id="content">
        </label>

        <select name="tipo" id="tipo">
          <option value="image">Image</option>
          <option value="user">User</option>
        </select>

        <label>
          &nbsp;<input class="submit" type="submit">
        </label>
      </form>
    </section>

    <section id="header-view">
    </section>

    <section id="library-view">
    </section>

    <footer>
        <p>
            Image search powered by the Openverse API.
            This application is not endorsed or certified by Openverse.
        </p>
        <p>Built by Mattia Raciti</p>
    </footer>
  </body>
</html>