<!DOCTYPE html>
<html>
<head>
    <?php include 'partial/head.php';   ?>
</head>
<body>

    <?php include 'partial/header.php'; ?>

    <?php include 'partial/nav.php';    ?>

    <div class="plane">
        <div class="paper">
            <div class="login_plane">
                <form method="post">
                    <label>
                        <span>Login:</span>
                        <input type="text" name="login" value="<?= $user['login']?>"/>
                    </label>
                    <label>
                        <span>Haslo:</span>
                        <input type="password" name="password"/>
                    </label>
                    <label>
                        <input type="submit" value="Zaloguj" />
                    </label>
                    <label>
                        <a href="edit_login" class="user_links">Nie mam jeszcze konta</a>
                    </label>
                </form>
                <span style="color:red"><?= $feedback ?></span>
            </div>
        </div>
    </div>

    <footer>
        autor: Micha³ £ubiñski, s184603 <br />
        projekt na wytwarzani aplikacji intenetowych (WAI)
    </footer>

</body>
</html>