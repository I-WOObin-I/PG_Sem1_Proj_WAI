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
            <span class="user_text">login: <?= $user['login'] ?></span>
            </br>
            <span class="user_text">email: <?=           $user['email'] ?></span>
            </br>
            </br>
            <a href="edit_login"    class="user_links">Zmien dane uzytkownika   </a>
            </br>
            <a href="logout"        class="user_links">Wyloguj                  </a>
            </br>
            <a href="delete_login"  class="user_links">Usun konto               </a>
            </br>
            <a href="products"      class="user_links">Produkty                 </a>
        </div>
    </div>

    <footer>
        autor: Micha³ £ubiñski, s184603 <br />
        projekt na wytwarzani aplikacji intenetowych (WAI)
    </footer>

</body>
</html>