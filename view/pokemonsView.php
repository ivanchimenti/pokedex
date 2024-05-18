<?php include("view/header.php");?>
<div class="container">
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-10" style="display: contents;">
            <?php
            foreach($pokemons as $pokemon)
            {
                echo "<div class='card m-3 p-3 justify-content-center' style='width: 18rem;'>";
                echo "<img class='imagenPokemon'
                                src='". $pokemon['Imagen'] ."'
                                class='card-img-top' style='height: 100%'
                                alt='".$pokemon['Nombre']."'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>". $pokemon['Nombre'] ."</h5>";
                echo "<a href='index.php?controller=Pokemon&action=Detalle&id=".$pokemon['Id'] ."' class='btn btn-primary'>Detalle</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<?php include("view/footer.php");?>
