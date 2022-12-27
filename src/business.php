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

function clearDbState() {
    $db = get_db();

    $db->files->deleteMany([]);
    $db->users->deleteMany([]);

}

function verifyRegistrationForm($postArr) {
    if($postArr['login'] === '' ) {
        return 1;
    }

    if($postArr['email'] === '') {
        return 2;
    }

    if($postArr['password'] === '') {
        return 3;
    }
    if($postArr['repeat_password'] === '') {
        return 5;
    }
    if ($postArr['password'] === $postArr['repeat_password']){
        $password = $postArr['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $account = [
            'login' => $postArr['login'],
            'email' => $postArr['email'],
            'password' => $hash
        ];
        
        $db = get_db();
        $same_mail = $db->users->findOne(['email' => $postArr['email']]);
        if(!($same_mail === NULL)) {
            return 6;
        }
        $current = $db->users->findOne(['login' => $postArr['login']]);
        
        if($current === NULL){ 
            $db->users->insertOne($account);
            return 0;
        } else{
           return 4;
        }
    }
}

function verifyLoginForm($postArr) {
    $login = $postArr['login'];
    $password = $postArr['password'];

    $query = [
        'password' => $password,
        'login' => $login,
    ];

    $db = get_db();

    $user = $db->users->findOne(['login' => $login]);
    
    if($user !== null && password_verify($password, $user['password'])){
    //password correct
        $_SESSION["logged_in"] = 1;
        $_SESSION["account_id"] = $password;
        $_SESSION["login"] = $login;
        return true;
    } else
    return false;
}

function getAccount($password, $login) {
     $db = get_db();
    return $db->users->findOne(['password' => $password, 'login' => $login]);
}

function login_or_logout_link() {
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
		return 'logout';
	}else {
		return 'login';
	}
}

function upload_fn($postArr) {
    $db = get_db();
    $allowedImgTypes= array("jpg","png");
    
    $base_name = random_string(10);
    $original_name = $base_name."_original";
    $thumbnail_name = $base_name."_thumbnail";
    $watermark_name = $base_name."_watermark";

    $target_dir = "files/";
    $fileType = strtolower(pathinfo($target_dir.basename($_FILES["fileToUploadName"]["name"]),PATHINFO_EXTENSION));

    $target_original_file = $target_dir.$original_name.".".$fileType;
    $target_thumbnail_file = $target_dir.$thumbnail_name.".".$fileType;
    $target_watermark_file = $target_dir.$watermark_name.".".$fileType;
    
    if($postArr['watermark'] === '' || $postArr['watermark'] === '') {
        return 6;
    }

    // Check file size
    if (filesize($_FILES['fileToUploadName']['tmp_name']) > 1048576 || $_FILES["fileToUploadName"]["error"] == 1) {
        if(isset($_POST["submit"])) {
            if(!in_array($fileType, $allowedImgTypes)) {
                return 7;
            } else {
                return 1;
            }
        }
    }
    
    if(isset($_POST["submit"])) {
        if(!in_array($fileType, $allowedImgTypes)) {
            return 2;
        }
        //tym mozna sprawdzic czy jest grafika
        $check = getimagesize($_FILES["fileToUploadName"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
        return 2;
        }
    }
    
    
    // Check if file already exists
    if (file_exists($target_original_file)) {
        return 3;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (!move_uploaded_file($_FILES["fileToUploadName"]["tmp_name"], $target_original_file)) {
            return 5;
        } else {
            create_thumbnail($target_original_file,$target_thumbnail_file,$fileType);
            create_watermark ($target_original_file, $postArr['watermark'], $target_watermark_file,$fileType);
            //end of storing part - begin DB part
            
            $default_name =basename($_FILES["fileToUploadName"]["name"]);
            $name = pick_file_name($default_name,$_POST['fileFriendlyName']);

            $fileDbObject = [
            '_id' => $original_name,
            'type' => 'public',
            'name' => $name,
            'author' => $_POST['authorName'],
            'location_of_original' => $target_original_file,
            'location_of_original_in_files' => "files/".$original_name.".".$fileType,
            
            'location_of_watermark' => $target_watermark_file,
            'location_of_watermark_in_files' => "files/".$watermark_name.".".$fileType,
            
            'location_of_thumbnail' => $target_thumbnail_file,
            'location_of_thumbnail_in_files' => "files/".$thumbnail_name.".".$fileType,
            ]; 

            if(isset($_POST['private'])) {
                $fileDbObject['type'] = 'private';
            } else {
                $fileDbObject['type'] = 'public';
            }
            $db->files->insertOne($fileDbObject);
        }
    }
    return 0;
}

function pick_file_name() {
    if(isset($_POST['fileFriendlyName'])) {
            if($_POST['fileFriendlyName'] != '') {
              $friendlyName=$_POST['fileFriendlyName'];
            } 
    } else $friendlyName=$default_name;
    return $friendlyName;
    //change it to randomly pick name
}

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function create_thumbnail($target_original_file,$target_thumbnail_file,$fileType) {
    $new_width = 200;
    $new_height = 125;
    list($old_width, $old_height) = getimagesize($target_original_file);
    if($fileType == 'png') {
        $base_for_thumbnail=imagecreatefrompng($target_original_file);
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $base_for_thumbnail, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
        imagepng($new_image,$target_thumbnail_file);
    } else {
        $base_for_thumbnail=imagecreatefromjpeg($target_original_file);
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $base_for_thumbnail, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
        imagejpeg($new_image,$target_thumbnail_file);
    }
}

function create_watermark ($SourceFile, $WaterMarkText, $DestinationFile,$fileType) {
    list($width, $height) = getimagesize($SourceFile);
    $image_p = imagecreatetruecolor($width, $height);
    if($fileType == 'png') {
       $image = imagecreatefrompng($SourceFile);
    } else {
       $image = imagecreatefromjpeg($SourceFile);
    }
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
    $red = imagecolorallocate($image_p, 255, 0, 0);
    $font = 'static/arial.ttf';
    $font_size = 100;
    imagettftext($image_p, $font_size, 0, 100, 150, $red, $font, $WaterMarkText);
    if($fileType == 'png') {
        imagepng ($image_p, $DestinationFile, 0);
    } else {
        imagejpeg ($image_p, $DestinationFile, 100);
    }
    imagedestroy($image);
    imagedestroy($image_p);
}

function set_files_for_gallery($modpage) {
    $db = get_db();
    $images_per_page = 3;
    $opts = [
    'skip' => ($modpage - 1) * $images_per_page,
    'limit' => $images_per_page
    ];
    $files = $db->files->find([], $opts);
    return $files;
}