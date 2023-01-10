<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>teacher Page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
        include_once("navbar.php");
        ?>
        <section class="teacher-section">
        <div class="user-dashboard-piece dashboard-left">
            <h3>Informacje o użytkowniku</h3>
            <div class="user-information-table">
                <?php
                if (isset($Info))
                    echo $Info;
                ?>
            </div>
        </div>
        <div class="user-dashboard-piece dashboard-right">
            <h3>Przedmioty</h3>
        </div>
    </section>
    </body>
</html>