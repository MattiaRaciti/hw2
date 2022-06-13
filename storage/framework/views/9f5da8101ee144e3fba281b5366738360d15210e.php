<!DOCTYPE html>
<html>
    <head>
        <script>
            const BASE_URL = "<?php echo e(url('/')); ?>/"
        </script>

        <link rel='stylesheet' href='./css/signup.css'>
        <script src='./js/signup.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>PicturesDB - Registrazione</title>
    </head>
    <body>
        <main>
			<header>

			</header>
        <section class="main_picturesDB">
			<h1>PicturesDB</h1>
			<div id = "details">
				<motto> Colleziona immagini e condividile con i tuoi amici!</motto>
			</div>
            <h2>REGISTRAZIONE</h2>
			<div id = "details">
				<p> ATTENZIONE: la password deve contenere minimo 8 caratteri e almeno un numero, una lettera maiuscola, una lettera minuscola e un carattere speciale.</p>
			</div>
			
            <?php if($error == 'empty_fields'): ?>
            <span class = "error"> Compilare tutti i campi </span>
            <?php endif; ?>

            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
                <?php echo csrf_field(); ?>
                <div class="username">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username' value = '<?php echo e(old("username")); ?>'></div>
                    
                    <?php if($error == 'existing'): ?>
                    <span class = "error"> Nome utente già esistente </span>
                    <?php endif; ?>

                    <span class = "error" ></span>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' value = '<?php echo e(old("password")); ?>'></div>
                    
                    <?php if($error == 'wrong_characters'): ?>
                    <span class = "error"> La password non rispetta le specifiche richieste </span>
                    <?php endif; ?>
                    
                    <span class = "error" ></span>
                </div>
				
				<div class="confirm_password">
                    <div><label for='confirm_password'>Conferma Password</label></div>
                    <div><input type='password' name='confirm_password' value = '<?php echo e(old("confirm_password")); ?>'></div>

                    <?php if($error == 'bad_passwords'): ?>
                    <span class = "error"> Le password non corrispondono </span>
                    <?php endif; ?>
                
                </div>
             
                <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
                </div>
            </form>
            <div class="signup">Possiedi già un account? <a href="<?php echo e(url('login')); ?>" class="button" >Accedi</a>
        </section>
			<footer>
				<p>Realizzato da: <strong>Mattia Raciti 1000001206</strong></p>
			</footer>
        </main>
    </body>
</html><?php /**PATH C:\Users\matti\example-app\resources\views/signup.blade.php ENDPATH**/ ?>