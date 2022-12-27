<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>UZUP - 3 </h1>
<ul>
    <li>
        <a href="files.php">List files</a>   
    </li>
    <li>
        <a href="upload.php">Send file</a>
    </li>
    <li>
        <a href="index.php">Home</a>
    </li>
</ul>
<form action="upload_fn.php" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUploadName" id="fileToUploadId"> <br>
  Give a friendly name for this file:
  <input type="text" name="fileFriendlyName" id="fileFriendlyNameId"> <br>
  <input type="submit" value="Upload File" name="submit">
</form>

<?php
    if(isset($_GET['resultcode'])) {
        $resultCode = $_GET['resultcode'];
        switch ($resultCode) {
            case 0:
                echo " <p style=color:green;>File uploaded correctly!</p>";
            break;
            case 1:
                 echo " <p style=color:red;>File not uploaded: Too big!</p>";
            break;
            case 2:
                 echo " <p style=color:red;>File not uploaded: Not allowed extensions!</p>";
            break;
            case 3:
                 echo " <p style=color:red;>File not uploaded: File already exists!</p>";
            break;
            case 4:
                 echo " <p style=color:red;>File not uploaded: Problem with upload file from client!</p>";
            break;
             case 5:
                 echo " <p style=color:red;>File not uploaded: Problem with storing file on server side!</p>";
            break;
    }
}    
?>


</body>
</html>