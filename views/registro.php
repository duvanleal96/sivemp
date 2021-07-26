
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

                <div>
                    <h3></h3>
                </div>

                <div >
                    <img src="<?php echo constant('URL'); ?>images/logo.jpg" id="icon" alt="logo" />
                </div>

                <form action="<?php echo constant('URL'); ?>registro/registrar" method="POST">

                    <input required type="text" id="name" name="name" class="fadeIn second" name="name" placeholder="Nombre">

                    <input required type="text" id="cc" class="fadeIn second" name="cc" placeholder="Cedula">

                    <input required type="text" id="codigo" class="fadeIn second" name="codigo" placeholder="Codigo">

                    <input required type="text" id="tel" class="fadeIn second" name="tel" placeholder="Telefono">

                    <input required type="date" id="fechan" class="fadeIn second" name="fechan" placeholder="Fecha de Nacimiento">

                    <input required type="text" id="dir" class="fadeIn second" name="dir" placeholder="Dirección">


                    <div class="input-field col s12">
                        <select name="arl">
                            <option value="-1" selected>Seleccione su Arl</option>
                            <?php
                            foreach ($this->arl as $dato) {
                                echo "<option value='" . $dato->id . "'>" . $dato->nombre . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-field col s12">
                        <select name="eps">
                            <option value="-1"  selected>Seleccione su Eps</option>
                            <?php
                            foreach ($this->eps as $datos) {
                                echo "<option value='" . $datos->id . "'>" . $datos->nombre . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <input required type="password" id="pass" class="fadeIn third" name="pass" placeholder="Contraseña">

                    <input required type="password" id="pass2" class="fadeIn third" name="pass2" placeholder="Verificar Contraseña">

                    <input type="submit" class="fadeIn fourth" value="Registrar">
                </form>




            </div>
        </div>





        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">

        </script>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            M.AutoInit();

        </script>


    </body>

</html>