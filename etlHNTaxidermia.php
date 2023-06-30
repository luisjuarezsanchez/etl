<?php
// Conexión a la base de datos
require 'pruebas/dockerconexion.php';
require 'pruebas/pruebabdold.php';

// Obtener la lista de archivos JSON en la carpeta /reg
$directorio = '../reg/';

// Consulta a la base de datos
$idFicha = 12;
$sql = "SELECT ID FROM registros WHERE ID_FICHA = $idFicha AND ID_ESTATUS_PAPELERA = 1 AND ID_ESTATUS_REGISTRO IN (2,3)";
$result = $connOld->query($sql);

if ($result->num_rows > 0) {
    // Recorrer los nombres de archivos obtenidos de la consulta
    while ($row = $result->fetch_assoc()) {
        $nombreArchivo = $row['ID'] . ".json";
        $archivo = $directorio . $nombreArchivo;

        echo "Archivo: $archivo<br>";
        $id = $archivo;

        // Leer el contenido del archivo JSON
        $jsonData = file_get_contents($archivo);

        // Decodificar el contenido JSON a un array asociativo
        $data = json_decode($jsonData, true);

        // Definir los nombres de las secciones a buscar
        $seccionesBuscadas = array(
            "Campos obligatorios",
            "Objetos digitales",
            "Identificación general",
            "Identificacion general",
            "Datos de identificación general",
            "Datos de identificacion general",
            "Datos de indentificación general",
            "Datos de indentificacion general",
            "Tipo de objeto",
            "Dimensiones"
        );

        // Recorrer los elementos del array
        foreach ($data as $item) {
            $nombreSeccion = $item['nombreSeccion'];

            // Verificar si la sección está en el arreglo de secciones buscadas
            if (in_array($nombreSeccion, $seccionesBuscadas)) {
                echo "$nombreSeccion" . "<br>";

                // Verificar el nombre de la sección
                switch ($nombreSeccion) {
                    case "Campos obligatorios":
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];

                            // Verificar el idCampo
                            if ($idCampo == 2) {
                                echo "Coleccion: $valorCampo<br>";
                                $coleccion = $valorCampo;
                            } elseif ($idCampo == 5) {
                                echo "Tematica: $valorCampo<br>";
                                $tematica = $valorCampo;
                            }
                        }
                        break;

                    case "Identificacion general":
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];

                            // Verificar el idCampo
                            if (in_array($idCampo, array(152, 194, 746, 747, 748, 749, 750, 751, 752, 753))) {
                                echo "Titulo: $valorCampo<br>";
                                $titulo = $valorCampo;
                            } elseif (in_array($idCampo, array(89, 357, 389, 416, 471))) {
                                echo "Descripcion de la pieza: $valorCampo<br>";
                                $descPieza = $valorCampo;
                            }
                        }
                        break;

                    case "Identificación general":
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];

                            // Verificar el idCampo
                            if (in_array($idCampo, array(152, 194, 746, 747, 748, 749, 750, 751, 752, 753))) {
                                echo "Titulo: $valorCampo<br>";
                                $titulo = $valorCampo;
                            } elseif (in_array($idCampo, array(89, 357, 389, 416, 471))) {
                                echo "Descripcion de la pieza: $valorCampo<br>";
                                $descPieza = $valorCampo;
                            }
                        }
                        break;

                    case "Datos de indentificacion general":
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];

                            // Verificar el idCampo
                            if (in_array($idCampo, array(152, 194, 746, 747, 748, 749, 750, 751, 752, 753))) {
                                echo "Titulo: $valorCampo<br>";
                                $titulo = $valorCampo;
                            } elseif (in_array($idCampo, array(89, 357, 389, 416, 471))) {
                                echo "Descripcion de la pieza: $valorCampo<br>";
                                $descPieza = $valorCampo;
                            }
                        }
                        break;

                    case "Datos de indentificación general":
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];

                            // Verificar el idCampo
                            if (in_array($idCampo, array(152, 194, 746, 747, 748, 749, 750, 751, 752, 753))) {
                                echo "Titulo: $valorCampo<br>";
                                $titulo = $valorCampo;
                            } elseif (in_array($idCampo, array(89, 357, 389, 416, 471))) {
                                echo "Descripcion de la pieza: $valorCampo<br>";
                                $descPieza = $valorCampo;
                            }
                        }
                        break;

                    case "Tipo de objeto":
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];

                            // Verificar el idCampo
                            if (in_array($idCampo, array(11, 85, 251, 287, 321, 351, 383, 411, 437))) {
                                echo "Tipo de objeto: : $valorCampo<br>";
                                $tipoObjeto = $valorCampo;
                            } elseif (in_array($idCampo, array(352, 384))) {
                                echo "Especie: $valorCampo<br>";
                                $especie = $valorCampo;
                            } elseif (in_array($idCampo, array(353, 385))) {
                                echo "Familia: $valorCampo<br>";
                                $familia = $valorCampo;
                            }
                        }
                        break;

                    case "Objetos digitales":
                        // Obtener los archivos de la sección
                        $archivos = $item['archivos'];

                        // Verificar si hay archivos
                        if (!empty($archivos)) {
                            $jpegEncontrado = false;
                            foreach ($archivos as $archivo) {
                                // Obtener la extensión del archivo
                                $extension = pathinfo($archivo, PATHINFO_EXTENSION);

                                // Verificar si la extensión es .jpeg
                                if ($extension === 'jpeg') {
                                    echo $archivo . "<br>";
                                    $rutaImg = $archivo;
                                    $jpegEncontrado = true;
                                    break;
                                }
                            }

                            // Si no se encontró ningún archivo jpeg, mostrar "Imagen no disponible"
                            if (!$jpegEncontrado) {
                                echo "Imagen no disponible<br>";
                            }
                        } else {
                            echo "Imagen no disponible<br>";
                        }
                        break;

                    case "Dimensiones":
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];

                            // Verificar el idCampo
                            switch ($idCampo) {
                                case 49:
                                case 91:
                                case 160:
                                case 211:
                                case 218:
                                case 264:
                                case 330:
                                case 362:
                                case 393:
                                case 418:
                                case 452:
                                case 464:
                                case 476:
                                    echo "Alto: $valorCampo<br>";
                                    $alto = $valorCampo;
                                    break;
                                case 50:
                                case 92:
                                case 161:
                                case 212:
                                case 219:
                                case 262:
                                case 302:
                                case 394:
                                case 419:
                                case 453:
                                case 465:
                                    echo "Largo: $valorCampo<br>";
                                    $largo = $valorCampo;
                                    break;
                                case 51:
                                case 162:
                                case 213:
                                case 220:
                                case 263:
                                case 303:
                                case 455:
                                case 466:
                                    echo "Ancho: $valorCampo<br>";
                                    $ancho = $valorCampo;
                                    break;
                                case 52:
                                case 93:
                                case 163:
                                case 215:
                                case 265:
                                case 304:
                                case 332:
                                case 364:
                                case 395:
                                case 420:
                                case 454:
                                    echo "Espesor: $valorCampo<br>";
                                    $espesor = $valorCampo;
                                    break;
                                case 45:
                                case 164:
                                case 456:
                                case 477:
                                case 497:
                                    echo "Fondo: $valorCampo<br>";
                                    $fondo = $valorCampo;
                                    break;

                                case 94:
                                case 266:
                                case 305:
                                case 333:
                                case 365:
                                case 396:
                                case 421:
                                case 468:
                                    echo "Peso: $valorCampo<br>";
                                    $peso = $valorCampo;
                                    break;
                                case 53:
                                case 214:
                                case 267:
                                case 306:
                                case 457:
                                case 467:
                                    echo "Diametro: $valorCampo<br>";
                                    $diametro = $valorCampo;
                                    break;
                            }
                        }
                        break;

                    default:
                        // Recorrer los campos de la sección
                        foreach ($item['campos'] as $campo) {
                            $idCampo = $campo['idCampo'];
                            $valorCampo = $campo['valor'];
                            echo "ID del campo: $idCampo, Valor del campo: $valorCampo" . "<br>";
                        }
                        break;
                }
            }
        }
        echo "<br> INSERT A SQL <br>";
        if (empty($id)) {
            $id = 0;
            echo $id;
        } else {
            echo "id: " . $id;
        }
        echo "<br>";

        if (empty($coleccion)) {
            $coleccion = 0;
            echo $coleccion;
        } else {
            echo "Coleccion: " . $coleccion;
        }
        echo "<br>";

        if (empty($tematica)) {
            $tematica = 0;
            echo $tematica;
        } else {
            echo "Temática: " . $tematica;
        }
        echo "<br>";

        if (empty($titulo)) {
            $titulo = 0;
            echo $titulo;
        } else {
            echo "Título: " . $titulo;
        }
        echo "<br>";

        if (empty($descPieza)) {
            $descPieza = 0;
            echo $descPieza;
        } else {
            echo "Descripcion de la pieza: " . $descPieza;
        }
        echo "<br>";

        if (empty($tipoObjeto)) {
            $tipoObjeto = 0;
            echo $tipoObjeto;
        } else {
            echo "Tipo de objeto: " . $tipoObjeto;
        }
        echo "<br>";

        if (empty($especie)) {
            $especie = 0;
            echo $especie;
        } else {
            echo "Especie: " . $especie;
        }
        echo "<br>";

        if (empty($familia)) {
            $familia = 0;
            echo $familia;
        } else {
            echo "Familia: " . $familia;
        }
        echo "<br>";



        if (empty($rutaImg)) {
            $rutaImg = 0;
            echo $rutaImg;
        } else {
            echo "Imagen: " . $rutaImg;
        }
        echo "<br>";

        if (empty($alto)) {
            $alto = 0;
            echo $alto;
        } else {
            echo "Alto: " . $alto;
        }
        echo "<br>";

        if (empty($largo)) {
            $largo = 0;
            echo $largo;
        } else {
            echo "Largo" . $largo;
        }
        echo "<br>";

        if (empty($ancho)) {
            $ancho = 0;
            echo $ancho;
        } else {
            echo "Ancho: " . $ancho;
        }
        echo "<br>";

        if (empty($espesor)) {
            $espesor = 0;
            echo $espesor;
        } else {
            echo "Espesor: " . $espesor;
        }
        echo "<br>";

        if (empty($fondo)) {
            $fondo = 0;
            echo $fondo;
        } else {
            echo "Fondo: " . $fondo;
        }
        echo "<br>";

        if (empty($peso)) {
            $peso = 0;
            echo $peso;
        } else {
            echo "Peso: " . $peso;
        }
        echo "<br>";

        if (empty($diametro)) {
            $diametro = 0;
            echo $diametro;
        } else {
            echo "Diametro: " . $diametro;
        }
        echo "<br>";

        echo "<br>";

        echo "<br>";
        echo "*******************************************************************************";
        echo "<br>";
        $sql2 = "INSERT INTO datos_publicos
        (ID, COLECCION, TEMATICA, TITULO, DESC_PIEZA, TECNICA_MANUFACTURA, TIPOS_OBJETO, 
        RUTA_IMG, AUTOR, TIPO_OBRA, FECHA, ESTILO_TENDENCIA, MATERIAL, EPOCA, ESPECIE, 
        FAMILIA, CATEGORIA, SUBCOLECCION, TIPO_FOSIL, ERA_GEO, DETALLES_ACCESORIO, 
        MATERIA_PRIMA, ALTO, LARGO, ANCHO, ESPESOR, FONDO, PESO, DIAMETRO)
        VALUES 
        ('$id', '$coleccion', '$tematica', '$titulo', '$descPieza', '0', '$tipoObjeto', 
        '$rutaImg', '0', '0', '0', '0', '0', '0', '$especie', 
        '$familia', '0', '0', '0', '0', '0', 
        '0', '$alto', '$largo', '$ancho', '$espesor', '$fondo', '$peso', '$diametro')
        ";
        $result2 = $conn->query($sql2);
        $id = 0;
        $coleccion = 0;
        $tematica = 0;
        $titulo = 0;
        $descPieza = 0;
        $tipoObjeto = 0;
        $especie = 0;
        $familia = 0;
        $rutaImg = 0;
        $alto = 0;
        $largo = 0;
        $ancho = 0;
        $espesor = 0;
        $fondo = 0;
        $peso = 0;
        $diametro = 0;
    }
} else {
    echo "No se encontraron archivos en la base de datos.";
}

// Cerrar conexión a la base de datos
$conn->close();
