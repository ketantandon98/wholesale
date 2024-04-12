<nav class="nav">
    <ul class="nav-links">
        <li>
            <a href="/wholesale">Home</a>
        </li>
        <li>
            <a href="?page=products">All products</a>
        </li>
        <li>
            <a href="?page=dashboard">Dashboard</a>
        </li>
        <li>
            <a href="?page=cart">Cart</a>
        </li>
        <li>
            <?php
            if (isset($_SESSION["user_id"])) {
                echo '<a href="?page=dashboard&logout=true">Logout</a>';
            } else {
                echo '<a href="?page=auth">Sign In</a>';
            }
            ?>
        </li>
    </ul>
</nav>