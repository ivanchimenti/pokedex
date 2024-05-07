<head>
    <link rel="stylesheet" href="/pokedex/assets/css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<div class="header">
    <div class="userInfo">
        <div class="logo">
            <a href="/Pokedex/index.php"><img src="/Pokedex/assets/images/pokebola.png" alt="pokedex logo"></a>
        </div>
        <a href="/Pokedex/index.php"><img src="/Pokedex/assets/images/pokedex.png" alt="pokedex logo"></a>
        <div class="login">
            <?php
            if(isset($_SESSION['admin_id'])) {
                echo '<div class="btn-group">';
                echo '<form action="/Pokedex/admin/addPokemon.php" method="post"><button type="submit" class="btn btn-success" name="add">Add</button></form>';
                echo '<form action="/Pokedex/logout.php" method="post"><button type="submit" class="btn btn-danger" name="logout">Logout</button></form>';
                echo '</div>';
            } else {
                echo "<form action='login.php' method='POST'>";
                echo "<input type='text' name='username' placeholder='Usuario'>";
                echo "<input type='text' name='password' placeholder='Password'>";
                echo '<button type="submit" class="btn btn-primary">Login</button>';
                echo "</form>";
            }
            ?>
        </div>
    </div>
    <div class="search">
        <form class="search" action="/Pokedex/search.php" method="get">
            <input class="searchTerm" type="text" name="search" placeholder="Buscar Pokémon por nombre">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
</div>