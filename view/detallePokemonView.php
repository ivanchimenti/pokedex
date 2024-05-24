<?php include_once "view/header.php";
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
?>