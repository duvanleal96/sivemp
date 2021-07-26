
<?php

class Mensajes extends Controller{

    function __construct(){
    }

    function crearMensaje($mensaje){
      /*
    	echo '<!-- Modal -->'.
          '<div class="modal fade" id="myModal" role="dialog">'.
            '<div class="modal-dialog modal-sm">'.

              '<!-- Modal content-->'.
              '<div class="modal-content-sm">'.
                '<div class="modal-header">'.
                  '<button type="button" class="close" data-dismiss="modal">&times;</button>'.
                  '<h3 class="modal-title" id="modal-title">'.$mensaje.'</h3>'.
                '</div>'.
                '<div class="modal-footer">'.
                  '<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>'.
                '</div>'.
              '</div>'.
              
            '</div>'.
          '</div>';
          */
    }

    function show($mensaje){
      echo "<script >alert('".$mensaje."');</script>";
      /*
    	echo '<script>$(".btn").click(function(){'.
         '// AJAX code here.'.
         '$.ajax('.
         '....'.
         'success: function($data){'.
           '$(".target").html(data)'.
           '$("#myModal").modal("show");'.
         '}'.
         ');'.
      '});</script>';
      */
    }

}

?>