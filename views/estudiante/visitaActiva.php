<?php
require_once 'layout/estudiante_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detalles </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped table-responsive table-hover">

                            <tbody>

                                <tr>
                                    <td class="col-md-2" rowspan="7" >
                                        <div class="pull-right">
                                            <img src="<?php echo constant('URL'); ?>dist/img/avatar5.png"  class= "img-responsive img-circle" alt="">
                                        </div>
                                    </td>

                                    <th>Nombre de la visita:</th>

                                    <th>
                                        <?php
                                        echo $this->datos->nombre;
                                        ?></th>

                                </tr>

                                <tr>

                                    <th>Nombre de la Empresa:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->empresa;
                                        ?></th>

                                </tr>

                                <tr>

                                    <th>Descripcion:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->descripcion;
                                        ?></th>

                                </tr>

                                <tr>

                                    <th>Nombre de la Empresa transportadora:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->transportadora;
                                        ?></th>

                                </tr>
                                <tr>

                                    <th>Fecha Inicio:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->fecha;
                                        ?></th>

                                </tr>
                                <tr>

                                    <th>Estado:</th>
                                    <th>
                                        <?php
                                        echo $this->datos->estado;
                                        ?></th>

                                </tr>



                                <tr>
                                    <th><p></p></th>
                                    <th>

                                        <?php
                                        if ($this->datos->estado == "Aprobado") {
                                            echo '<form action="' . constant('URL') . 'visitas/cancelarRegistro" method="post">';
                                            echo '<input type="hidden" name="visita" value="' . $this->datos->id . '">';
                                            ?>
                                            <button type="submit" onclick="return confirm('¿esta seguro?, este proceso es irreversible');" class="btn btn-primary">Cancelar  <i class="glyphicon glyphicon-pencil"></i></button>
                                            <?php
                                        } else {

                                            echo '<form action="' . constant('URL') . 'visitas/informes" method="post">';
                                            echo '<input type="hidden" name="visita" value="' . $this->datos->id . '">';
                                            echo '<button type="submit"  class="btn btn-primary">informes  <i class="glyphicon glyphicon-pencil"></i></button>';
                                        }
                                        ?>
                                        </form>
                                    </th>
                                </tr>




                            </tbody>


                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content -->
</div>
<?php
require_once 'layout/estudiante_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
?>