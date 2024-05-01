<div class="header">
<!--    <a href="/pokedex/admin/dashboard.php">-->
<!--    </a>-->
    <div class="userInfo">
        <div class="logo">
            <p>img</p>
            <p>Logo</p>
        </div>
        <img src="assets/images/pokedex.png" alt="pokedex logo">
        <div class="login">
            <?php
            if(isset($_SESSION['admin_id'])) {
                echo '<form action="/pokedex/logout.php" method="post"><button type="submit" class="btn btn-danger" name="logout">Logout</button></form>';
            } else {
               echo "<input type='text' placeholder='Usuario'>";
               echo "<input type='text' placeholder='Password'>";
               echo '<a href="login.php"><button type="submit" class="btn btn-primary">Login</button></a>';
            }
            ?>
        </div>
    </div>
    <div class="search">
        <form class="search" action="search.php" method="get">
            <input class="searchTerm" type="text" name="search" placeholder="Buscar Pokémon por nombre">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    </div>