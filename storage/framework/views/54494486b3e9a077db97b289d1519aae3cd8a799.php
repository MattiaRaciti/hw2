<!DOCTYPE html>
<html>
  <head>
    <script>
        const BASE_URL = "<?php echo e(url('/')); ?>/"
    </script>

    <meta charset="utf-8">
    <title>PicturesDB - home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='./css/home.css'>
	<script src= "<?php echo e(url('js/home.js')); ?>" defer="true"></script>
  </head>
  <body>
    <header>
      <nav>
        <div id="links">
			<a2>PicturesDB</a2>
			<a href="<?php echo e(url('home')); ?>" class="button">Clear</a>
			<a href="<?php echo e(url('preferiti')); ?>" class="button">Preferiti</a>
			<a href="<?php echo e(url('login')); ?>" class="button_b">Logout</a>
			<div id = "details">
			</div>
        </div>
		<div id="menu"> 
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>

      <h1>
        <strong>Ricerca Immagini</strong><br/>
        <em>Colleziona immagini e condividile con i tuoi amici!</em><br/>
        <br><a3> Benvenuto, <?php echo e($username); ?> !</a3></br>
      </h1>
    </header>
	
	<section id = "search-view">
		<form>
			<label>Cerca: <input type='text' name = 'content' id ='content'></label>	
				<select name = 'tipo' id='tipo'>
				<option value='image'>Immagine</option>
				<option value='user'>Utente</option>
			</select>
			<label>&nbsp;<input class="submit" type='submit'></label>
        </form>
	</section>
	
	<section id = "header-view">
	</section>
	
	<section id = "library-view">
	</section>
	  
    <footer>
      <address>Powered by: Bing Image Search</address>
      <p>Realizzato da: <strong>Mattia Raciti 1000001206</strong></p>
    </footer>
  </body>
</html>


<?php /**PATH C:\Users\matti\example-app\resources\views/home.blade.php ENDPATH**/ ?>