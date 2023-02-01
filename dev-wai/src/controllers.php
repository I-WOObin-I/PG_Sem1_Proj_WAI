<?php
require_once 'business.php';
require_once 'controller_utils.php';


function products(&$model)
{
    $page = 1;
    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    }
    $checked = get_checked();

    $pagesize = 8;

    $user_id = '';
    if(isset($_SESSION['user_id'])) { $user_id = (string)$_SESSION['user_id']; }
    $products = get_products($page, $pagesize, $user_id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach($products as $product)
        {
            $id = (string)$product['_id'];
            $checked[$id] = '';
        }

        if(isset($_POST['mem'])) {
            $mem = $_POST['mem'];
            foreach($mem as $mem_id => $mem_v)
            {
                $checked[$mem_id] = $mem_v;
            }
        }
        $_SESSION['checked'] = $checked;
    }



    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
        $id = $_SESSION['user_id'];
        $user = get_user($id);
        $user['password'] = '';
        $user['_id'] = '';
        $model['user'] = $user;
    }

    $model['checked'] = $_SESSION['checked'];
    $model['products'] = $products;
    $model['page'] = $page;

    return 'products_view';
}

function products_marked(&$model)
{
    $marked_ids = $_SESSION['checked'];
    $products = get_products_marked($marked_ids);
    $mem = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $checked = $_SESSION['checked'];
        foreach($products as $product)
        {
            $id = (string)$product['_id'];
            $checked[$id] = '';
        }

        if(isset($_POST['mem'])) {
            $mem = $_POST['mem'];
            foreach($mem as $mem_id => $mem_v)
            {
                $checked[$mem_id] = $mem_v;
            }
        }
        $_SESSION['checked'] = $checked;
        $marked_ids = $_SESSION['checked'];
        $products = get_products_marked($marked_ids);
        $mem = null;
    }

    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
        $id = $_SESSION['user_id'];
        $user = get_user($id);
        $user['password'] = '';
        $user['_id'] = '';
        $model['user'] = $user;
    }

    $model['checked'] = $_SESSION['checked'];
    $model['products'] = $products;

    return 'products_marked_view';
}

function product(&$model)
{
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
        $id = $_SESSION['user_id'];
        $user = get_user($id);
        $user['password'] = '';
        $user['_id'] = '';
        $model['user'] = $user;
    }

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];

        if ($product = get_product($id)) {
            $model['product'] = $product;

            return 'product_view';
        }
    }

    http_response_code(404);
    exit;
}

function edit(&$model)
{
    $product = [
        'name' => null,
        'price' => null,
        'description' => '',
        'watermark' => null,
        '_id' => null,
        'directory' => null,
        'img_type' => null,
        'permission' => '',
        'author' => ''
    ];

    $upload_dir = 'uploaded_img/';
    $feedback = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
        $id = $_SESSION['user_id'];
        $user = get_user($id);
        $user['password'] = '';
        $user['_id'] = '';
        $model['user'] = $user;
    }

        if (!empty($_POST['name']) &&
            !empty($_POST['price']) &&
            !empty($_POST['watermark']) &&
            !empty($_FILES['file_img']) &&
            !empty($_POST['author'])
        ) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $file = $_FILES['file_img'];
            
            if( $file['size'] > 1024*1024) {
                $feedback = 'plik mia³ niedozwolony format lub za du¿y rozmiar';
                $model['product'] = $product;
                $model['feedback'] = $feedback;
                return 'edit_view';
            }

            $product = [
                'name'          => $_POST['name'],
                'price'         => (int)$_POST['price'],
                'description'   => $_POST['description'],
                'watermark'     => $_POST['watermark'],
                'author'        => $_POST['author']
            ];
            $product['directory'] = $product['name'];

            $product['img_type'] = '';
            $finfo = null;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_name = '';
            $file_name = $file['tmp_name'];
            if( $finfo != false && $file_name != '') {
                $mime_type = finfo_file($finfo, $file_name);
                if( $mime_type === 'image/jpeg')  { $product['img_type'] = '.jpg';  }
                if( $mime_type === 'image/png')  { $product['img_type'] = '.png';  }
            }
            

            if( $product['img_type'] == '' ) { 
                $feedback = 'plik mia³ niedozwolony format lub za du¿y rozmiar';
                $model['product'] = $product;
                $model['feedback'] = $feedback;                
                return 'edit_view';
            }

            while ( file_exists( $upload_dir . $product['directory'] . $product['img_type'] ) ) {
                $product['directory'] = $product['directory'] . 1;
            }

            $target = $upload_dir . $product['directory'] . $product['img_type'];

            $product['permission'] = '';
            if($_POST['permission'] == 'true') { $product['permission'] = (string)$_SESSION['user_id']; }

            $tmp_path = $file['tmp_name'];
            if (save_product($id, $product) && move_uploaded_file($tmp_path, $target) && img_work($product) ) {
                return 'redirect:products';
            }
        }
    } elseif (!empty($_GET['id'])) {
        $product = get_product($_GET['id']);
    }

    $user = [
        'login' => '',
        'id' => ''
    ];
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
        $id = $_SESSION['user_id'];
        $user = get_user($id);
        $user['password'] = '';
        $user['_id'] = '';
        $model['user'] = $user;
    }
    
    $model['user'] = $user;
    $model['product'] = $product;
    $model['feedback'] = $feedback;

    return 'edit_view';
}

function delete(&$model)
{
    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            delete_product($id);
            return 'redirect:products';

        } else {
            if ($product = get_product($id)) {
                $model['product'] = $product;
                if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
                    $id = $_SESSION['user_id'];
                    $user = get_user($id);
                    $user['password'] = '';
                    $user['_id'] = '';
                    $model['user'] = $user;
                }
                return 'delete_view';
            }
        }
    }

    http_response_code(404);
    exit;
}

function cart(&$model)
{
    $model['cart'] = get_cart();
    return 'partial/cart_view';
}

function add_to_cart()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $product = get_product($id);

        $cart = &get_cart();
        $amount = isset($cart[$id]) ? $cart[$id]['amount'] + 1 : 1;

        $cart[$id] = ['name' => $product['name'], 'amount' => $amount];

        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
}

function clear_cart()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['cart'] = [];
        return 'redirect:' . $_SERVER['HTTP_REFERER'];
    }
}

function edit_login(&$model)
{
    $user = [
        'email' => '',
        'login' => '',
        'password' => '',
    ];
    $feedback = '';
    $id = null;
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
        $id = $_SESSION['user_id'];
        $user = get_user($id);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['email']) &&
            !empty($_POST['login']) &&
            !empty($_POST['password']) &&
            !empty($_POST['rep_password'])
        ) {

            $rep_password = $_POST['rep_password'];
            $password     = $_POST['password'];
            $login        = $_POST['login'];
            $email        = $_POST['email'];

            

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $feedback = 'nieprawid³owy adres email';
                $model['feedback'] = $feedback;
                $user['password'] = '';
                $user['_id'] = '';
                $model['user'] = $user;
                return 'edit_login_view';
            }

            if( check_login($login) && $login != $user['login'])
            {
                $feedback = 'login ju¿ zajêty';
                $model['feedback'] = $feedback;
                $user['password'] = '';
                $user['_id'] = '';
                $model['user'] = $user;
                return 'edit_login_view';
            }

            if( $password !== $rep_password )
            {
                $feedback = 'has³a nie by³y takie same';
                $model['feedback'] = $feedback;
                $user['password'] = '';
                $user['_id'] ='';
                $model['user'] = $user;
                return 'edit_login_view';
            }

            $user = [
                'email' => $_POST['email'],
                'login' => $_POST['login']
            ];

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $user['password'] = $hash;

            if (save_user($id, $user)) {
                $_SESSION['user_id'] = '';
                $model['user'] = null;
                return 'redirect:login';
            }
        }
    }

    $user['password'] = '';
    $user['_id'] = '';
    $model['user'] = $user;
    $model['feedback'] = $feedback;
    return 'edit_login_view';
}

function login(&$model)
{
    $user = [
        'login' => null,
        'password' => null
    ];
    $feedback = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['login']) &&
            !empty($_POST['password'])
        ) {

            $user = [
                'login'      => $_POST['login'],
                'password'   => $_POST['password']
            ];

            if( check_user($user) ){
                $user = get_user_by_login($user['login']);
                $_SESSION['user_id'] = $user['_id'];
                $user['password'] = '';
                $user['_id'] = '';
                $model['user'] = $user;
                return 'user_view';
            }
            else { $feedback = 'login lub has³o niepoprawne'; }
        }
    }

    $model['feedback'] = $feedback;
    $user['password'] = '';
    $model['user'] = $user;
    return 'login_view';
}

function user(&$model)
{
    $id = $_SESSION['user_id'];
    $user = get_user($id);
    $user['password'] = '';
    $user['_id'] = '';
    $model['user'] = $user;
    return 'user_view';
}

function delete_login(&$model)
{
    $id = $_SESSION['user_id'];
    if(isset($_POST['sure'])) {
        if(delete_user($id)) {
            $user = null;
            $_SESSION['user_id'] = '';
            $model['user'] = $user;
            return 'redirect:products';
        }
    }
    return 'delete_login_view';
}

function logout(&$model)
{
    $user = null;
    $_SESSION['user_id'] = '';
    $model['user'] = $user;
    return 'redirect:products';
}