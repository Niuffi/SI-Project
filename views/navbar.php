<div class="header">
    <h1> LOGO </h1>
    <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true):
        ?>
        <?php
            echo '<h2>Witaj - ' . $_SESSION['user']['Login'].'</h2>';
        ?>
    <form action="index.php" method="post" class="header-form">
        
        <input type="submit" value="Wyloguj" name="gotopage" class="header-logout" />
        <?php
        endif;
        ?>
    </form>
</div>