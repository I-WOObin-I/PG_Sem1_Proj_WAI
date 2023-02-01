<?php


use MongoDB\BSON\ObjectID;


function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function get_products($page, $pagesize, $user_id)
{
    $opts = [
        'skip' => ($page - 1) * $pagesize,
        'limit' => $pagesize
    ];
    $query = [
        '$or' => [
            ['permission' => '' ],
            ['permission' => (string)$user_id ]
        ]
    ];

    $db = get_db();
    return $db->products->find($query,$opts)->toArray();
}

function get_products_marked($marked_ids)
{
    $db = get_db();


    $products = $db->products->find([])->toArray();
    $product = null;
    $products_marked = null;
    foreach($marked_ids as $id => $v)
    {
        if($v == 'true')
        {
            foreach($products as $product)
            {
                if((string)$product['_id'] == $id) { $products_marked[] = $product;}
            }
        }
    }
    return $products_marked;
}

function get_products_by_category($cat)
{
    $db = get_db();
    $products = $db->products->find(['cat' => $cat]);
    return $products;
}

function get_product($id)
{
    $db = get_db();
    $product = $db->products->findOne(['_id' => new ObjectID($id)]);
    $id = (string)$product['_id'];
    $product['_id'] = $id;
    return $product;
}

function get_user($id)
{
    $db = get_db();
    return $db->users->findOne(['_id' => new ObjectID($id)]);
}

function get_user_by_login($login)
{
    $db = get_db();
    return $db->users->findOne(['login' => $login]);
}

function save_product($id, $product)
{
    $db = get_db();

    if ($id == null) {
        $db->products->insertOne($product);
    } else {
        $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
    }


    return true;
}

function img_work($product)
{
    $image = null;
    $thumb_height = 200;
    $thumb_width = 125;
    $file_dir = 'uploaded_img/' . $product['directory'] . $product['img_type'];
    $target = 'uploaded_img/thumbnails/' . $product['directory'] . 'TH.png';

    if($product['img_type'] == '.jpg') { $image = ImageCreateFromJpeg($file_dir); }
    if($product['img_type'] == '.png') { $image = ImageCreateFromPng($file_dir);  }
    $width = imagesx($image);
    $height = imagesy($image);
    $thumbnail = imagecreatetruecolor($thumb_width, $thumb_height);
    imagecopyresampled($thumbnail, $image, 0,0,0,0, $thumb_width, $thumb_height, $width, $height);
    ImagePng($thumbnail, $target);

    $fontcolor = ImageColorAllocate($image, 204,102,255);
    ImageString($image, 5, $width/2, $height/2, $product['watermark'], $fontcolor);
    $target = 'uploaded_img/watermarked/' . $product['directory'] . 'WM.png';
    ImagePng($image, $target);
    ImageDestroy($image);

    return true;
}

function save_user($id, $user)
{
    $db = get_db();

    if ($id == null) {
        $db->users->insertOne($user);
    } else {
        $db->users->replaceOne(['_id' => new ObjectID($id)], $user);
    }

    return true;
}

function check_user($user_attempt)
{
    $db = get_db();
    $hash = null;
    $user = null;
    $user = $db->users->findOne(['login' => $user_attempt['login']]);
    if($user) { $hash = $user['password']; }
    if($hash == null) { return false; }
    if(password_verify($user_attempt['password'], $hash)) { return true; }
    return false;
}

function check_login($login)
{
    $db = get_db();
    if( $db->users->findOne(['login' => $login]) ) { return true; }
    return false;
}

function delete_product($id)
{
    $db = get_db();
    $db->products->deleteOne(['_id' => new ObjectID($id)]);
}

function delete_user($id)
{
    $db = get_db();
    $db->users->deleteOne(['_id' => new ObjectID($id)]);
    return true;
}
