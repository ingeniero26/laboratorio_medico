var t_examenes_realizados;
function listar_realizar_examen_serverside(){

     t_examenes_realizados = $("#tabla_realizar_examen").DataTable({  
        "pageLength":10,
        "destroy":true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
      	"sAjaxSource":"../controller/realizar_examen/serverside/serversideRealizarExamen.php",
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
            {"data":3},
            {"data":1},
            {"data":2},
            {"data":4},
            {"data":6},
           
            {
                "data": 5,
                render: function(data, type, row) {
                    if (data == 'PENDIENTE') {
                        return "<span class='badge bg-success'>" + data + "</span>";
                    } else {
                        return "<span class='badge bg-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": 5,
                render: function(data, type, row) {
                    if (data == 'PENDIENTE') {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>";
                    } else {
                        return "<button style='font-size:13px;' type='button' class='btn btn-primary'><i class='fa fa-edit'></i></button>";
                    }
                }
            },
           
        
      ],
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        	$($(nRow).find("td")[1]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
        },
        "language":idioma_espanol,
        select: true
	});
	t_examenes_realizados.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_realizar_examen').DataTable().page.info();
        t_examenes_realizados.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}