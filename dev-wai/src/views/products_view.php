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
            <form method="post">
                <?php if (count($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="deska">
                            <a href="view?id=<?= $product['_id'] ?>">
                                <img src="uploaded_img/thumbnails/<?= $product['directory'] . 'TH.png' ?>" class="deski_img" alt="deska"/> <br />
                            </a>
                            <div class="deska_text">
                                Nazwa: <?= $product['name'] ?> <br /><br />
                                Autor: <?= $product['author'] ?> <br /><br />
                                cena: <?= $product['price'] ?> <br /><br />
                                <?php if($product['permission'] != ''): ?>
                                    <div class="permission_div">
                                         &#128274;
                                    </div>
                                <?php endif ?>
                                <input
                                    type="checkbox"
                                    name="mem[<?= (string)$product['_id'] ?>]"
                                    value='true'
                                    class="checkbox_product"
                                    <?php
                                    $id = (string)$product['_id'];
                                    if (isset($checked[$id]) && $checked[$id] == 'true'): ?>
                                    checked
                                    <?php endif ?>
                                />
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <h2> brak produktow </h2>
                <?php endif ?>
                <div class="deska">
                    <div class="zapamietaj_but">
                        <input type="submit" value="zapisz zaznaczone" />
                    </div>
                </div>
            </form>
        </div>  

        <div class="paging">
            <div>
                <?php if ($page >= 2): ?>
                    <a href="products?page=<?= $page-1 ?>" class="pagelink"><?= $page-1 ?></a>
                <?php endif ?>
                <a href="products?page=<?= $page   ?>" class="pagelink" style="color:cyan"><?= $page   ?></a>
                <a href="products?page=<?= $page+1 ?>" class="pagelink"><?= $page+1 ?></a>
            </div>
            <div class="deska">
                <a href="edit">
                    <h2 style="color:white">Dodaj</h2>
                </a>
            </div>
            <div class="deska">
                <a href="products_marked">
                    <h2 style="color:white">zapamiętane</h2>
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
