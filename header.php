<div class="header">
<!--    <a href="/pokedex/admin/dashboard.php">-->
<!--    </a>-->
    <div class="userInfo">
        <div class="logo">
            <p>img</p>
            <p>Logo</p>
        </div>
        <a href="/Pokedex/index.php"><img src="/Pokedex/assets/images/pokedex.png" alt="pokedex logo"></a>
        <div class="login">
            <?php
            session_start();
            if(isset($_SESSION['admin_id'])) {
                echo '<form action="/Pokedex/logout.php" method="post"><button type="submit" class="btn btn-danger" name="logout">Logout</button></form>';
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