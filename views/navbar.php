<div>
    <form action="index.php" method="post">
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true):
        ?>
        <?php
            echo 'Witaj - ' . $_SESSION['user']['Login'];
        ?>
        <input type="submit" value="Wyloguj" name="gotopage" />
        <?php
        endif;
        ?>
    </form>
</div>