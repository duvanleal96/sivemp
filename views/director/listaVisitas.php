<?php
require_once 'layout/director_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Visitas</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <tbody>



                            <th>Nombre de la visita:</th>
                            <th>Nombre de la Empresa:</th>
                            <th>Empresa Transportadora:</th>
                            <th>Numero de cupos:</th>




                            <?php
                            if (empty($this->datos)) {
                                echo '<tr><td>No hay visitas disponibles</td></tr>';
                            } else {
                                foreach ($this->datos as $dato) {
                                    echo "<tr>";

                                    echo "<td>" . $dato->nombre . "</td>";
                                    echo "<td>" . $dato->empresa . "</td>";
                                    echo "<td>" . $dato->transportadora . "</td>";
                                    echo "<td>" . $dato->cupos . "</td>";
                                    echo '<td>' .
                                    '<form action="' . constant('URL') . 'visitas/detalles" method="post">' .
                                    '<input type="hidden" name="visita" value="' . $dato->id . '">' .
                                    '<input type="submit"  class="btn btn-primary" value="detalles">' .
                                    '</form>' .
                                    '</td>';
                                    echo "</tr>";
                                }
                            }
                            ?> 






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
require_once 'layout/director_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
?>