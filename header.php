<div class="header">
    <a href="/pokedex/admin/dashboard.php">
    </a>
    <form class="search" action="search.php" method="get">
        <input class="searchTerm" type="text" name="search" placeholder="Buscar Pokémon por nombre">
        <button type="submit">Buscar</button>
    </form>

    <?php
    if(isset($_SESSION['admin_id'])) {
        echo '
        <form action="/pokedex/logout.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>';
    } else {
        echo '<a href="login.php">
            <button>
                Login
            </button>
            </a>';
    }
    ?>
</div>