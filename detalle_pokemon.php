<?php include_once "view/header.php";

//    if (isset($_GET['id'])) {
//        // Obtener el valor de "id" y mostrarlo
//        $id = $_GET['id'];
//
//        $sqlQueryPokemon = "SELECT * FROM pokemon WHERE Id = $id";
//        $result = mysqli_query($conn, $sqlQueryPokemon);
//        if(mysqli_num_rows($result) > 0) {
//            $sqlQueryTipos = "SELECT * FROM pokemon_tipo WHERE IdPokemon = $id";
//            $resultTipos = mysqli_query($conn, $sqlQueryTipos);
//            if(mysqli_num_rows($resultTipos) > 0) {
//                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='container detalle'>";
                    echo "<img src='" . $pokemon["Imagen"] . "' alt='' style='width:200px;>";
                    echo "<div class='informacion'>";
                    echo "<div class='d-flex'>";
                    echo "<div class='d-flex flex-column'>";
                    foreach($tipos as $tipo) {
                        echo "<img src='assets/images/tipos/" . $tipo["IdTipo"] . ".png" . "' alt='' style='width:100px;'>";
                    }
                    echo "</div>";
                    echo "<h2>". $pokemon["Nombre"] ."</h2>";
                    echo "</div>";
                    echo "<p>Descripcion:". $pokemon["Descripcion"] ."</p><br>";
                    echo "<p>Nro. Pokedex:". $pokemon["NroPokedex"] ."</p><br>";
                    echo "</div>";
                    echo "</div>";
//                }
//            }
//        } else {
//            echo "no se encontraron resultados";
//        }
//        // Aquí puedes realizar la búsqueda en tu base de datos y mostrar los detalles
//    } else {
//        // Si no se recibió el parámetro, mostrar un mensaje de error
//        echo "<h1>Error: No se recibió ningún término de búsqueda</h1>";
//    }
//    ?>
<!--</body>-->
<!---->
<!--</html>-->