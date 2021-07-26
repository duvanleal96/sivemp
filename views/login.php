<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sivemp</title>

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo constant('URL'); ?>css/style.css">



    </head>
    <body>

        <div class="container ">
            <div id="contenido">


                <div >
                    <img src="<?php echo constant('URL'); ?>images/logo.jpg" id="icon" alt="logo" />
                </div>

                <form action="<?php echo constant('URL'); ?>login/ingresar" method="post">
                    <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="Usuario">
                    <input type="password" id="contrasenia" class="colorPlace" name="contrasenia" placeholder="Contraseña">

                    <input type="submit" class="fadeIn fourth" value="Acceder">
                </form>


                <div id="footer">
                    <a class="underlineHover" href="<?php echo constant('URL'); ?>registro">Registrarse</a>

                </div>

            </div>
        </div>

        <footer id="pie">

        </footer>




        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    </body>

</html>