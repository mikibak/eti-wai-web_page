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
				<li class="currentPage"><a href="gallery">Galeria</a></li>
				<li><a href="contact">Kontakt</a></li>
				<li>
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

        <form action="gallery" method="post" enctype="multipart/form-data">
            Wybierz plik:
            <input type="file" name="fileToUploadName" id="fileToUploadId"> <br>
            <?php
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
                    $author_auto_fill = $_SESSION["login"];
                    echo " <input type='radio' name='private' id='radioId'>
                           <label for='radioId'>Prywatne</label>"; 
                }else {
                    $author_auto_fill = '';
                }
            ?>
            Tytuł:
            <input type="text" name="fileFriendlyName" id="fileFriendlyNameId"> <br>
            Autor:
            <input type="text" name="authorName" id="authorId" value="<?= $author_auto_fill ?>"
		<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1): ?>
                	disabled 
                <?php endif ?>
		><br>
            Znak wodny:
            <input type="text" name="watermark" id="watermarkId"> <br>
            <input type="submit" value="Wyślij plik" name="submit"><br><br>
        </form>

        <?php
            if(isset($resultcode)) {
                switch ($resultcode) {
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
                    case 6:
                         echo " <p style=color:red;>File not uploaded: Submit all data to form!</p>";
                    break;
                    case 7:
                         echo " <p style=color:red;>File not uploaded: Too big!</p>";
                         echo " <p style=color:red;>File not uploaded: Not allowed extensions!</p>";
                    break;
                    default:
                        echo " <p style=color:red;>No resultcode!</p>"; 
                    break;
                }
            }
            $page_plus = $page + 1;
            $page_minus = $page - 1;
        ?>
        <form method="post" action="gallery">
        <section class="gallery">
            <?php if (count($files)): ?>
                <?php foreach ($files as $fileDbObject): ?>
                    <?php if ($fileDbObject['type'] == 'public' || (isset($_SESSION["login"]) && $fileDbObject['author'] == $_SESSION["login"])): ?>
                         <div class="gallery_entry">
                             <p>
                                 Autor: <?= $fileDbObject['author'] ?> <br/>
                                 Tytuł: <?= $fileDbObject['name'] ?> <br/>
                                 Typ: <?= $fileDbObject['type'] ?>
                             </p>
                             <a href='<?= $fileDbObject['location_of_watermark_in_files'] ?>'>
                                 <img src="<?= $fileDbObject['location_of_thumbnail_in_files'] ?>" alt="image">
                             </a>
                             <input type="checkbox" name="<?= $fileDbObject['_id'] ?>" id="<?= $fileDbObject['_id'] ?>" value="<?= $fileDbObject['_id'] ?>"
                                <?php if (isset($_SESSION['likes'][$fileDbObject['_id']])): ?>
                                    <?php if ($_SESSION['likes'][$fileDbObject['_id']] == $fileDbObject): ?>
                                    checked="checked"
                                    <?php endif ?>
                                <?php endif ?>
                             >
                             <label for="<?= $fileDbObject['_id'] ?>">Zaznacz</label><br/>
                          </div>
                    <?php endif ?>
                <?php endforeach ?>
            <?php else: ?>
                <p style=color:green;>Brak produktów!</p>
            <?php endif ?>
        </section>

        <input type="checkbox" name="likes_sent" checked="checked" style="opacity:0; position:absolute; left:9999px;">
        <div style="clear: both;"></div>
        <br/>

        <?php if ($page != 1): ?>
            <a href="gallery?page=<?= $page_minus ?>" class="button primarycolor">Poprzednia strona</a>
        <?php endif ?>
        <?php if (isset($fileDbObject)): ?>
            <a href="gallery?page=<?= $page_plus ?>" class="button primarycolor">Następna strona</a>
        <?php endif ?>
        <br/>Strona <?= $page ?><br/>
        <?php if (isset($allow_likes_checkbox)): ?>
            <input type="submit" value="Dodaj wybrane do ulubionych" name="submit" class="button secondarycolor">
        <?php endif ?>

        </form>
    </div>


<?php include "includes/footer.inc.php"; ?>
