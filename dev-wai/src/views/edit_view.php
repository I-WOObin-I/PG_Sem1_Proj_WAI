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
            <form method="post" enctype="multipart/form-data" class="edit_form">
                <label>
                    <span>Obraz ( .jpg / .png ) ( max 1MB ):</span>
                    <input type="file" name="file_img" required/>
                </label></br>
                <span style="color:red"><?= $feedback ?></span>
                <label>
                    <span>Autor:</span>
                    <input
                        type="text"
                        name="author"
                        required
                        <?php if(isset($user['login'])): ?>
                        value=" <?= $user['login'] ?>"
                        <?php endif ?>
                    />
                </label>
                <label>
                    <span>Nazwa:</span>
                    <input type="text"   name="name"        value="<?= $product['name']     ?>" required/>
                </label>
                <label>
                    <span>Cena:</span>
                    <input type="number" name="price"       value="<?= $product['price']    ?>" required/>
                </label>
                <label>
                    <span>Znak wodny:</span>
                    <input type="text"   name="watermark"   value="<?= $product['watermark']?>" required/>
                </label>
                <?php if(isset($user['login']) && $user['login'] != ''): ?>
                    <span>Dostêp:</span>
                    <label>
                        <span>Prywatny</span>
                        <input type="radio" name="permission" value="true"/>
                        <span>Publiczny</span>
                        <input type="radio" name="permission" value="false" checked/>
                    </label>
                <?php else: ?>
                    <input type="hidden" name="permission" value="false"/>
                <?php endif ?>

                <textarea name="description" placeholder="Opis..."><?= $product['description'] ?></textarea>

                <input type="hidden" name="id" value="<?= $product['_id'] ?>">

                <div>
                    <a href="products" class="cancel">Anuluj</a>
                    <input type="submit" value="Zapisz"/>
                </div>
            </form>
        </div>
    </div>

    <footer>
        autor: Micha³ £ubiñski, s184603 <br />
        projekt na wytwarzani aplikacji intenetowych (WAI)
    </footer>

</body>
</html>