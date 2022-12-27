<!DOCTYPE html>
<html lang="pl">
<head>	
	<?php include "includes/head.inc.php"; ?>
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
				<li class="currentPage"><a href="contact">Kontakt</a></li>
				<li><?php
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
                ?></li>
				<?php include "includes/options.inc.php"; ?>
			</ul>
		</nav>

	<div id="content">
            <form method="post" action="1.php">
                <label for="fname">Imię:</label><br>
                <input type="text" id="fname" name="fname"><br>
                <label for="lname">Nazwisko:</label><br>
                <input type="text" id="lname" name="lname"><br>

                <label for="majtek">Twój email:</label><br>
                <input type="email" id="email" name="email"><br><br>

                <input type="radio" id="majtek" name="stopien" value="0">
                <label for="majtek">Brak uprawnień</label><br>
                <input type="radio" id="zeglarz" name="stopien" value="1">
                <label for="zeglarz">Żeglarz jachtowy</label><br>
                <input type="radio" id="sternik" name="stopien" value="2">
                <label for="sternik">Jachtowy sternik morski</label><br>
                <input type="radio" id="kapitan" name="stopien" value="3">
                <label for="kapitan">Kapitan jachtowy</label><br><br>

                <strong>Zwiedzone akweny</strong><br>
                <input type="checkbox" id="baltyk" name="akwen1" value="baltyk">
                <label for="baltyk">Morze bałtyckie</label><br>
                <input type="checkbox" id="mazury" name="akwen2" value="mazury">
                <label for="mazury">Mazury</label><br>
                <input type="checkbox" id="adriatyk" name="akwen3" value="adriatyk">
                <label for="adriatyk">Morze Adriatyckie</label><br>
                <input type="checkbox" id="inneakweny" name="akwen4" value="inne">
                <label for="inneakweny">Inne morza i oceany</label><br><br>

                <label for="comment"><strong>Tutaj umieść swój komentarz:</strong></label><br>
                <textarea id="comment" name="comment" maxlength="300" rows="10" cols="30"></textarea><br><br>
                <input type="submit" value="Wyślij" class="button secondarycolor" id="submitbutton">
                <input type="reset" value="Wyczyść" class="button secondarycolor"><br>
            </form>
        </div>

<?php include "includes/footer.inc.php"; ?>