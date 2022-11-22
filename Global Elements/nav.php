<?php
echo '<div id="nav">
    <div style="text-align: left; flex-grow: 3;">
        <h2>
            LOS ANGELES, CALIFORNIA
        </h2>
    </div>
    <div style="text-align: center; flex-grow: 4;">
        <h2>
            <a href="index.php">IOVINE AND YOUNG ACADEMY YEARBOOK</a>
        </h2>
    </div>
    <div style="text-align: right; flex-grow: 1;">
        <h2>
            <a href="search.php">SEARCH</a>
        </h2>
    </div>
    <div style="text-align: right; flex-grow: 2;">
        <h2>'

            if($_SESSION["loggedin"] == "yes") {
                echo "<a href='logout.php'>LOGOUT</a>";
            } else {
                echo "<a href='login.php'>LOGIN</a>";
            }


        </h2>
    </div>
</div>';
?>
