<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Prueba Tecnica</title>

    <style>
        .text-response {
            font-weight: 500;
        }

        #filterSubmit {
            display: none;
        }
    </style>
</head>
<body>

    <br>

    <div class="container">
        <div class="row justify-content-md-center">
            @isset($message)
            
            <div class="alert alert-danger" role="alert" id="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    <li><strong>{{$status}}</strong></li>
                    <li><strong>{{$message}}</strong></li>
                </ul>
            </div>
            @endisset
        </div>
        <div class="row justify-content-md-center">
            <div class="col-8">
                
                <!--Card Form Filter-->
                <div class="card">
                    <div class="card-header">
                        <h5><strong>Filtros de Busqueda:</strong></h5>
                    </div>

                    <div class="card-body">
                        <form action="export" method="GET" id="formFilter">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="month">Selecciona Mes:</label>
                                    <select class="form-control" id="month" name="month">
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="day">Numero de Dia</label>
                                        <input type="number" class="form-control" id="day" name="day" placeholder="Escribe el dia">
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="type_res">Tipo de respuesta:</label>
                                    <select class="form-control" id="type_res" name="type_res">
                                        <option value="display">En Pantalla</option>
                                        <option value="file">Descargar Archivo Excel</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">

                                <button type="submit" class="btn btn-success btn-block" id="filter">Buscar</button>

                            </div>
                        </form>
                    </div>
                </div>

                <!--Card Response Data-->
                <div class="card">
                    <div class="card-header">
                        <h5><strong>Respuesta Valor del Dolar:</strong></h5>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <ul>
                                    <li class="text-response" id="valor"></li>
                                    <li class="text-response" id="date"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#filter').on('click', function(e) {

                $('#filter').prop('disabled', true);
                $('#filter').text('Procesando...');

                if ( $('#type_res').val() == 'file' ) {
                    $('#valor').text("Valor: ");
                    $('#date').text("Fecha: ");
                    $('#formFilter').submit();

                    return false;
                }
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "GET",
                    url: "/getValue",
                    data: {
                        month: $('#month').val(),
                        day: $('#day').val(),
                        type_res: $('#type_res').val()
                    }
                })
                .done(function( data ) {
            
                    if ( data.statusCode != 200 ) {
                        alert(data.message)
                        $('#valor').text("Valor: ");
                        $('#date').text("Fecha: ");
                    }
                    else {
                        $('#alert').css('display', 'none');
                        $('#valor').text("Valor: "+data.data.Valor);
                        $('#date').text("Fecha: "+data.data.Fecha);

                    }

                    $('#filter').text('Buscar');
                    $('#filter').prop( "disabled", false );
            
                })
                .fail(function() {
                    $('#alert').css('display', 'none');
                    alert("Ha ocurrido un error, Vuelve a intentar!");
                    $('#filter').text('Buscar');
                    $('#filter').prop( "disabled", false );
                });
            });
        })
    </script>
</body>
</html>