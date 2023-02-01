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
                            cena: <?= $product['price'] ?> <br /><br />
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
            <input type="submit" value="zpamiêtaj zaznaczone"/>
            </form>  
        </div>  
        <div class="paging">
            <div class="deska">
                <a href="edit">
                    <h2 style="color:white">Dodaj</h2>
                </a>
            </div>
            <div class="deska">
                <a href="products">
                    <h2 style="color:white">wrzystkie</h2>
                </a>
            </div> 
        </div>
    </div>
    
    <footer>
        autor: Micha³ £ubiñski, s184603 <br />
        projekt na wytwarzani aplikacji intenetowych (WAI)
    </footer>

</body>
</html>
