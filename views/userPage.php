<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    include_once("navbar.php");
    ?>
    <section class="user-section">
        <div class="user-dashboard-piece dashboard-left">
            <h3>Informacje o użytkowniku</h3>
            <div class="user-information-table">
                <?php
                if (isset($Info))
                    echo $Info;
                ?>
            </div>
            <div class="user-information-table">
                <?php
                if (isset($ParentAssigmentData))
                    echo $ParentAssigmentData;
                ?>
            </div>
        </div>
        <div class="user-dashboard-piece dashboard-right">
            <h3>Przedmioty</h3>
            <?php
            if (isset($courseGrades)) {
                foreach ($courseGrades as $course) {
                    echo "<h2>" . "{$course[0][3]}" . "</h2>";
                    echo '<div class="course">';
                    foreach ($course as $grade) {
                        echo '<div class="grade" title="' . $grade[2] . '">' . '<span>'.$grade[0] . 
                        '</span><br><p>' . $grade[2] . '</p>
                         <p>' . $grade[1] . '</p>
                        </div>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
    </section>

</body>

</html>