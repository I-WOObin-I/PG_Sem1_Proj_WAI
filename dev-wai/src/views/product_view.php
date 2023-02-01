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
            <div class="product_plane">
                <div class="product_img">
                    <a href="uploaded_img/watermarked/<?= $product['directory'] . 'WM.png' ?>" target="_blank">
                        <img src="uploaded_img/watermarked/<?= $product['directory'] . 'WM.png' ?>" class="img_deska" alt="deska"/> <br />
                    </a>
                </div>
                <div class="deska2_text">
                    Autor: <?= $product['author']       ?> <br/><br/>
                    Nazwa: <?= $product['name']         ?> <br/><br/>
                    cena:  <?= $product['price']        ?> <br/><br/>
                           <?= $product['description']  ?> <br/><br/>
                    <?php if($product['permission'] != ''): ?>
                        <div class="permission_div_product">
                            &#128274; To zdjęcie jest prywatne <br /><br />
                        </div>
                    <?php endif ?>
                    <a href="delete?id=<?= $product['_id'] ?>" class="user_links">Usuń  </a>
                    <a href="edit?id=<?=   $product['_id'] ?>" class="user_links">Edytuj</a>                    
                </div>
            </div>
        </div>
        <div class="paging">
            <div class="deska">
                <a href="products">
                    <h2 style="color:white">Produkty</h2>
                </a>
            </div>
        </div>
    </div>

    <footer>
        autor: Michał Łubiński, s184603 <br />
        projekt na wytwarzani aplikacji intenetowych (WAI)
    </footer>

</body>
</html>
