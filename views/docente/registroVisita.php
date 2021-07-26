<?php
require_once 'layout/docente_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>   

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            <small></small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="register-box-body ">
            <p class="login-box-msg">Registro Visitas</p>

            <form action="<?php echo constant('URL'); ?>visitas/registrarVisita" method="post">



                <div class="row">

                    <div class="col-xs-6 col-sm-12">

                        <div class="form-group has-feedback  ">
                            <input required type="text" id="name" name="name" class="form-control" placeholder="Nombre">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback  ">
                            <input required type="text" id="desc" name="desc" class="form-control" placeholder="descripcion">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Empresa</label>
                            <select id="empresa" name="empresa" class="form-control">

                                <?php
                                if (empty($this->empresa)) {
                                    echo "<option value=-1>No hay empresas registradas</option>";
                                }else{
                                    foreach ($this->empresa as $emp) {
                                        echo "<option value='" . $emp->id . "'>" . $emp->nombre . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Transportadora</label>
                            <select id="transpor" name="transpor" class="form-control">
                                <?php
                                if (empty($this->transportadora)) {
                                    echo "<option value=-1>No hay transportadoras registradas</option>";
                                }
                                foreach ($this->transportadora as $trans) {

                                    echo "<option value='" . $trans->id . "'>" . $trans->nombre . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group has-feedback  ">
                            <input required type="number" id="cupos" name="cupos" class="form-control" placeholder="Cantidad de cupos">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Fecha de registro">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-6 col-sm-4"></div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                            </div>
                            <!-- /.col -->
                        </div>

                    </div>

                </div>



            </form>



        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once 'layout/docente_footer_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>   
