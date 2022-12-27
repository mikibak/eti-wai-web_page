<!DOCTYPE html>
<html lang="pl">
<head>	
	<?php include "includes/head.inc.php";?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/story-show-gallery@2/dist/ssg.min.css">
    <script src="https://cdn.jsdelivr.net/npm/story-show-gallery@2/dist/ssg.min.js"></script>

    <link rel="stylesheet" href="static/jquery-ui/jquery-ui.min.css">
    <script src="static/jquery-ui/external/jquery/jquery.js"></script>
    <script src="static/jquery-ui/jquery-ui.min.js"></script>
    <script src="static/script.js"></script>
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
                <?php
                if(isset($link)) {
                    if($link == 'login') {
                        echo "<li><a href='login'>Zaloguj się</a>";
                    } else {
                        echo '<li class="currentPage"><a href="liked_gallery">Ulubione</a></li>';
                        echo "<li><a href='logout'>Wyloguj się</a>";
                    }
                } else {
                        echo "<li><a href='login'>Zaloguj się</a>";
                }
                ?>
                </li>
				<?php include "includes/options.inc.php"; ?>
			</ul>
		</nav>

	<div id="content">
	

        <?php
            if(isset($_POST['likes_sent'])) {
                foreach ($_POST as $key => $value) {
                $_SESSION[$key] = $value;
                }
            }
            $likes = [];
            if(isset($_SESSION['likes'])) {
                $likes = $_SESSION['likes'];
            }
            $page_plus = $page + 1;
            $page_minus = $page - 1;
        ?>
        <form method="post" action="liked_gallery">
        <section class="gallery">
            <?php foreach ($likes as $id => $fileDbObject): ?>
                <?php if ($id != 'likes_sent'): ?>
                    <div class="gallery_entry">
                        <p>
                            Autor: <?= $fileDbObject['author'] ?> <br/>
                            Tytuł: <?= $fileDbObject['name'] ?>
                        </p>
                        <a href='<?= $fileDbObject['location_of_watermark_in_files'] ?>'>
                            <img src="<?= $fileDbObject['location_of_thumbnail_in_files'] ?>" alt="image">
                        </a>
                        <input type="checkbox" name="<?= $fileDbObject['_id'] ?>" id="<?= $fileDbObject['_id'] ?>" value="<?= $fileDbObject['_id'] ?>">
                        <label for="<?= $fileDbObject['_id'] ?>">Zaznacz</label><br/>
                    </div>
                 <?php endif ?>
            <?php endforeach ?>
        </section>

        <input type="checkbox" name="likes_sent" checked="checked" style="opacity:0; position:absolute; left:9999px;">
        <div style="clear: both;"></div>
        <br/>

        <?php if ($page != 1): ?>
            <a href="gallery?page=<?= $page_minus ?>" class="button primarycolor">Poprzednia strona</a>
        <?php endif ?>
        <a href="gallery?page=<?= $page_plus ?>" class="button primarycolor">Następna strona</a>

         <input type="submit" value="Usuń wybrane z ulubionych" name="submit" class="button secondarycolor">
        </form>

    </div>


<?php include "includes/footer.inc.php"; ?>
