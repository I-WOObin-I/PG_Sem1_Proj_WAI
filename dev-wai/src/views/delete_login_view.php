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
            <span class="user_text"> Czy na pewno chcesz usunac konto?</span>
            <form method="post">
                <input type="hidden" value="true" name="sure"/>
                <input type="submit" value="tak"/>
            </form>
            <a href="user">
                <span class="login_text" style="margin:20px"> nie </span>
            </a>
        </div>
    </div>

    <footer>
        autor: Micha³ £ubiñski, s184603 <br />
        projekt na wytwarzani aplikacji intenetowych (WAI)
    </footer>

</body>
</html>