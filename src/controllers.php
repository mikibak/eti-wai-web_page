<?php
require_once 'business.php';
require_once 'controller_utils.php';

function clear() {
     clearDbState();
     return 'redirect:login?dbclear=true';
}

function account(&$model) {
    $model['account'] = getAccount($_SESSION['account_id'],$_SESSION['login']);
    if(isset($_GET['transfer'])) {
        $model['transfer'] = $_GET['transfer'];
    }
    return 'account';
}

function transfer() {
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
       if(transferMoney($_POST['account'], $_POST['money'])) {
        return 'redirect:account?transfer=passed';
       } else {
        return 'redirect:account?transfer=failed';
       }
    } else {
         return 'login';
    }
}

function logout(&$model) {
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
        session_destroy();
        return 'redirect:login?logout=passed';
    } 
    return 'redirect:login?logout=failed';
}

function login(&$model) {
    
    if(isset($_GET['logout'])) {
        $model['logout'] = $_GET['logout'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
            $model['account'] = getAccount($_SESSION['account_id'],$_SESSION['login']);
            $model['link'] = login_or_logout_link();
            $model['logError'] = false;
            return 'login';
        } else {
            return 'login';
        }
    } else {
        if(isset($_POST['register'])) {
            $regResult = verifyRegistrationForm($_POST);
            $model['regResult'] = $regResult;
            return 'login';
        } else {
            if(verifyLoginForm($_POST)) {
                $model['account'] = getAccount($_SESSION['account_id'],$_SESSION['login']);
                $model['link'] = login_or_logout_link();
                $model['logError'] = false;
                return 'login';
            } else {
                $model['logError'] = true;
                return 'login';
            }
        }
    }

}



function index(&$model) {
    $model['link'] = login_or_logout_link();
	return 'index';
}

function gallery(&$model) {
    //whether the user is logged in or not
    if(isset($_GET['resultcode'])) {
        $model['resultcode'] = $_GET['resultcode'];
    }
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
		$model['account'] = getAccount($_SESSION['account_id'],$_SESSION['login']);
	}
	$model['link'] = login_or_logout_link();

    //images upload
    if(isset($_POST['fileFriendlyName'])) {
       $resultcode = upload_fn($_POST);
       if($resultcode === 0) {
        return 'redirect:gallery?resultcode=0';
       }
       else if($resultcode === 1) {
        return 'redirect:gallery?resultcode=1';
       }
       else if($resultcode === 2) {
        return 'redirect:gallery?resultcode=2';
       }
       else if($resultcode === 3) {
        return 'redirect:gallery?resultcode=3';
       }
       else if($resultcode === 4) {
        return 'redirect:gallery?resultcode=4';
       }
       else if($resultcode === 5) {
        return 'redirect:gallery?resultcode=5';
       }
       else if($resultcode === 6) {
        return 'redirect:gallery?resultcode=6';
       }
       else if($resultcode === 7) {
        return 'redirect:gallery?resultcode=7';
       }
    }

    //showing like checkboxes to logged users
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
        $model['allow_likes_checkbox'] = 1;
    } 

    //pagination
    if(isset($_GET['page'])) {
        $modpage = $_GET['page'];
    } else {
        $modpage = 1;
    }
    $model['files'] = set_files_for_gallery($modpage);
    $model['page'] = $modpage;

    //submitting the likes form
    if(isset($_POST['likes_sent'])) {
        $db = get_db();
        foreach ($_POST as $key => $id) {
            if($key != 'likes_sent' && $key != 'submit') {
                $query = [
                    '_id' => $id,
                ];
                $object = $db->files->findOne($query);
                $_SESSION['likes'][$id] = $object;
            }
        }
    }

    return 'gallery';
}

function yachts(&$model) {
	$model['link'] = login_or_logout_link();
	return 'yachts';
}

function contact(&$model) {
    $model['link'] = login_or_logout_link();
	return 'contact';
}

function liked_gallery(&$model) {
    //whether to allow login or logout
    if(isset($_GET['resultcode'])) {
        $model['resultcode'] = $_GET['resultcode'];
    }
	$model['link'] = login_or_logout_link();

    //pagination
    if(isset($_GET['page'])) {
        $modpage = $_GET['page'];
    } else {
        $modpage = 1;
    }
    $model['files'] = set_files_for_gallery($modpage);
    $model['page'] = $modpage;

    //submitting the likes form
    if(isset($_POST['likes_sent'])) {
        foreach ($_POST as $key => $id) {
            if($key != 'likes_sent' && $key != 'submit') {
                unset($_SESSION['likes'][$id]);
            }
        }
    }

    return 'liked_gallery';
}
?>