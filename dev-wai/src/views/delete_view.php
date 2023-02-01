<!DOCTYPE html>
<html>
<head>
    <?php include 'partial/head.php';   ?>
</head>
<body>

    <?php include 'partial/header.php'; ?>

    <?php include 'partial/nav.php';    ?>

    <div class="plane">
        <div class="paper" style="color:white">
            <form method="post" style="margin:15px">
                Czy na pewno usunąć produkt: <?= $product['name'] ?>?

                <input type="hidden" name="id" value="<?= $product['_id'] ?>">

                <div>
                    <a href="products" class="cancel">Anuluj</a>
                    <input type="submit" value="Potwierdź"/>
                </div>
            </form>    
        </div>
    </div>

    

    <footer>
        autor: Michał Łubiński, s184603 <br />
        projekt na wytwarzani aplikacji intenetowych (WAI)
    </footer>

</body>
</html>
