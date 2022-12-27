<!DOCTYPE html>
<html lang="pl">
<head>	
	<?php include "includes/head.inc.php";?>
</head>
	
<body onload="pickTheme()">
	<div id="container">

		<?php include "includes/logo.inc.php"; ?>

		<nav class="sansitafont secondarycolor">
			<ul>
				<li id="main">
					<a>Strona główna</a>
					<ul>
						<li><a href="index">Strona główna</a></li>
						<li><a href="index#linksParagraph">Przydatne linki</a></li>
					</ul>
				</li>
				<li class="mobileOnlyMenu"><a href="index">Moje hobby</a></li>
				<li class="mobileOnlyMenu"><a href="index#linksParagraph">Przydatne linki</a></li>
				<li><a href="yachts">Jachty</a></li>
				<li><a href="gallery">Galeria</a></li>
				<li><a href="contact">Kontakt</a></li>
				<li class="currentPage">
                <?php
                if(isset($link)) {
                    if($link == 'login') {
                        echo "<a href='login'>Zaloguj się</a>";
                    } else {
                        echo "<a href='liked_gallery'>Ulubione</a></li>";
                        echo "<li><a href='logout'>Wyloguj się</a>";
                    }
                } else {
                        echo "<a href='login'>Zaloguj się</a>";
                }
                ?>
                </li>
				<?php include "includes/options.inc.php"; ?>
			</ul>
		</nav>

	<div id="content">
            <?php 
      if(isset($_GET['dbclear'])) {
            echo "<h1 style=color:red;>Application DB empty!</h1>";
        }

    if(isset($logout)) {
        if($logout == 'passed') {
          echo "<h2 style=color:green;>Logout properly!</h2>";
        } else {
            echo "<h2 style=color:red;>Logout error!</h2>";
        }
    }
    if(isset($logError)) {
        if($logError == true) {
            echo "<h2 style=color:red;>Login error!</h2>";
        } else {
            echo "<h2 style=color:green;>Login correct!</h2>";
        }
    }
    ?>
    <div>
    Zaloguj się:

    <form action="login" method="post" enctype="multipart/form-data">
    Login:
    <input type="text" name="login" id="loginId"> <br>
    Hasło:
    <input type="password" name="password" id="passwordId"> <br>

    <input type="submit" value="Login" name="submit" class="button secondarycolor">
    <?php 
    ?>
</form>
</div>
<div>
    Zarejestruj się:

    <form action="login" method="post" enctype="multipart/form-data">
    E-mail:
    <input type="email" name="email" id="emailId"> <br>
    Login:
    <input type="text" name="login" id="loginId"> <br>
    Hasło:
    <input type="password" name="password" id="passwordId"> <br>
    Powtórz hasło:
    <input type="password" name="repeat_password" id="repeat_passwordId"> <br>
    <input type="checkbox" name="register" checked="checked" style="opacity:0; position:absolute; left:9999px;">
    <input type="submit" value="Register" name="submit" class="button secondarycolor">
     <?php 
    if(isset($regResult)) {
        switch ($regResult) {
            case 0:
                echo " <p style=color:green;>Registered properly!</p>";
            break;
            case 1:
                 echo " <p style=color:red;>Name field empty!</p>";
            break;
            case 2:
                 echo " <p style=color:red;>Surname field empty!</p>";
            break;
            case 3:
                 echo " <p style=color:red;>Password field empty!</p>";
            break;
            case 4:
                 echo " <p style=color:red;>User already exist!</p>";
            break;
            case 5:
                 echo " <p style=color:red;>Repeated password incorrectly!</p>";
            break;
            case 6:
                 echo " <p style=color:red;>Email already used!</p>";
            break;
    }
}
    ?>
</div>
<br/><a href="clear" class="button primarycolor">CLEAR DB</a>
</div>

<?php include "includes/footer.inc.php"; ?>