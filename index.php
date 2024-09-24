<?php
try {

    $user = "root";
    $password = "";
    $dbname = "formulario";
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare
    $stmt = $dbh->prepare("INSERT INTO encuesta (nombre, apellido, fecha_nacimiento, dni, nacionalidad, genero, embarazada, jubilado, discapacidad) VALUES 
    (:nombre, :apellido, :fecha_nacimiento, :dni, :nacionalidad, :genero, :embarazada, :jubilado, :discapacidad)");
    // Bind

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $dni = $_POST['dni'];
    $nacionalidad = $_POST['nacionalidad'];
    $genero = $_POST['genero'];
    $embarazada = isset($_POST['embarazada']) && $_POST['embarazada'] === 'Si';
    $jubilado = isset($_POST['jubilado']) && $_POST['jubilado'] === 'Si';

    if (isset($_POST['discapacidadCheckbox'])) {
        $discapacidadesSeleccionadas = [];

        if (isset($_POST['discapacidad'])) {
            $discapacidadesSeleccionadas = $_POST['discapacidad']; // Esto será un array
        }

        if (empty($discapacidadesSeleccionadas)) {
            $discapacidad = "no";
        } else {
            $discapacidad = implode(", ", $discapacidadesSeleccionadas);
        }
    } else {
        $discapacidad = "no";
    }

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':nacionalidad', $nacionalidad);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':embarazada', $embarazada);
    $stmt->bindParam(':jubilado', $jubilado);
    $stmt->bindParam(':discapacidad', $discapacidad);

    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Completo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <header>
        <h1>BANCO CINCO SALTOS.CS</h1>
    </header>
    <main>
        <form action="#" method="POST" class="formulario1" id="miFormulario">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 form">
                        <div id="contenedor1">
                            <h1 class="mt-4">Información Personal</h1>
                            <div class="mb-3 px-4 row">
                                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input name="nombre" type="text" placeholder="Ingrese su nombre" class="form-control" id="nombre">
                                </div>
                            </div>

                            <div class="mb-3 px-4 row">
                                <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
                                <div class="col-sm-10">
                                    <input name="apellido" type="text" placeholder="Ingrese su apellido" class="form-control" id="apellido">
                                </div>
                            </div>

                            <div class="mb-3 px-4 row">
                                <label for="fecha_nacimiento" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
                                <div class="col-sm-10">
                                    <input name="fecha_nacimiento" id="fecha_nacimiento" type="date" placeholder="Fecha de nacimiento" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 px-4 row">
                                <label for="dni" class="col-sm-2 col-form-label">DNI</label>
                                <div class="col-sm-10">
                                    <input name="dni" type="text" placeholder="Ingrese su DNI" class="form-control" id="dni">
                                </div>
                            </div>
                            <div class="mb-3 px-4 row">
                                <label for="nacionalidad" class="col-sm-2 col-form-label">Nacionalidad</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="nacionalidad" id="nacionalidad" aria-label="Nacionalidades">
                                        <option value="Argentina">Argentina</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Brasil">Brasil</option>
                                        <option value="Chile">Chile</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="España">España</option>
                                        <option value="México">México</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Perú">Perú</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Venezuela">Venezuela</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 px-4 row">
                                <label for="nacionalidad" class="col-sm-2 col-form-label">Genero</label>
                                <div class="col-sm-10">

                                    <select class="form-select" name="genero" id="genero" aria-label="genero">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Sin definir">Sin definir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 px-4">
                                <button type="button" class="btn btn-primary" onclick="mostrarFormulario2()">Siguiente</button>

                            </div>
                        </div>
                        <div class="hidden" id="contenedor2">
                            <h1>Información Adicional</h1>

                            <div class="mb-3 px-4 row justify-content-center">
                                <label for="embarazada" class="col-sm-2 col-form-label">¿Está embarazada?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="embarazada" id="si" value="Si">
                                        <label class="form-check-label" for="si">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="embarazada" id="no" value="No">
                                        <label class="form-check-label" for="no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 px-4 row justify-content-center">
                                <label for="jubilado" class="col-sm-2 col-form-label">¿Es jubilado?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jubilado" id="si" value="Si">
                                        <label class="form-check-label" for="si">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jubilado" id="no" value="No">
                                        <label class="form-check-label" for="no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 px-4 row justify-content-center">
                                <label for="discapacidad" class="col-sm-2 col-form-label">¿Tiene alguna Discapacidad?</label>

                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="discapacidad" id="siDiscapacidad" value="Si">
                                        <label class="form-check-label" for="siDiscapacidad">Si</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="discapacidad" id="noDiscapacidad" value="No">
                                        <label class="form-check-label" for="noDiscapacidad">No</label>
                                    </div>
                                    <div class="discapacidades d-none mt-5" id="discapacidades">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Visual" id="visual">
                                            <label class="form-check-label" for="visual">
                                                Visual
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Motora" id="motora">
                                            <label class="form-check-label" for="motora">
                                                Motora
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Auditiva" id="auditiva">
                                            <label class="form-check-label" for="auditiva">
                                                Auditiva
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Intelectual" id="intelectual">
                                            <label class="form-check-label" for="intelectual">
                                                Intelectual
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-warning" onclick="atras()">Atrás</button>
                                <input type="submit" class="btn btn-primary" value="Enviar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <footer class="fixed-bottom">
        <p>footer</p>
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script>
        function mostrarFormulario2() {
            document.getElementById('contenedor1').classList.add('hidden');
            document.getElementById('contenedor2').classList.remove('hidden');
        }

        function atras() {
            document.getElementById('contenedor2').classList.add('hidden');
            document.getElementById('contenedor1').classList.remove('hidden');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const siRadio = document.getElementById("siDiscapacidad");
            const noRadio = document.getElementById("noDiscapacidad");
            const discapacidadesContainer = document.querySelector("#discapacidades");

            // Evento para mostrar/ocultar el contenedor
            siRadio.addEventListener("change", function() {
                if (siRadio.checked) {
                    discapacidadesContainer.classList.remove('d-none');
                }
            });

            noRadio.addEventListener("change", function() {
                if (noRadio.checked) {
                    discapacidadesContainer.classList.add('d-none');
                }
            });
        });
    </script>


    <script src="/js/validation.js">
    </script>
</body>

</html>