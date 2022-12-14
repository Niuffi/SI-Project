<div>
    <form action="index.php" method="post">
        <?php
        if ($_SESSION['loggedIn'] == false):
        ?>
        Zaloguj uczeń/rodzic <input type="submit" name="gotopage" value="userLogin" />
        Zaloguj nauczyciel <input type="submit" name="gotopage" value="teacherLogin" />
        Zaloguj admin <input type="submit" name="gotopage" value="adminLogin" />
        <?php
        endif;
        ?>
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true):
        ?>
        <input type="submit" value="Wyloguj" name="gotopage" />
        <?php
        endif;
        ?>
    </form>
</div>