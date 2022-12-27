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
				<li class="currentPage"><a href="yachts">Jachty</a></li>
				<li><a href="gallery">Galeria</a></li>
				<li><a href="contact">Kontakt</a></li>
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
                ?>
                </li>
				<?php include "includes/options.inc.php"; ?>
			</ul>
		</nav>

	<div id="content">

            <div id="tablediv">
                <table id="table">
                    <tr>
                        <th>Nazwa</th>
                        <th>Liczba masztów</th>
                        <th>Żagle</th>
                    </tr>

                    <tr>
                        <td>ket</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>slup</td>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>kuter</td>
                        <td>2</td>
                        <td>2-3 przednie żagle</td>
                    </tr>
                    <tr>
                        <td>szkuner</td>
                        <td>2-7</td>
                        <td>min. 2</td>
                    </tr>
                    <tr>
                        <td>bryg</td>
                        <td>2</td>
                        <td>rejowe</td>
                    </tr>
                    <tr>
                        <td>fregata</td>
                        <td>min. 3</td>
                        <td>nawet 7 "pięter" żagli rejowych</td>
                    </tr>
                </table><br />
            </div>

            <br /><button type="button" id="wikibutton" onclick="addWiki()" class="button secondarycolor">Dowiedz się więcej</button>

            <div>
                <h2>Znane Przykłady</h2>

                <h3>Zawisza Czarny</h3>
                <p>
                    <strong>typ:</strong> szkuner <br />
                    <strong>rok zwodowania:</strong> 1952 <br />
                    <strong>port macierzysty:</strong> Gdańsk <br />
                    <a href="https://pl.wikipedia.org/wiki/Fregata_(typ_o%C5%BCaglowania)"><strong>wikipedia:</strong> https://pl.wikipedia.org/wiki/Fregata_(typ_o%C5%BCaglowania)</a>
                    <strong>odwiedzone porty:</strong> Leningrad, Helsinki, Hawana, Toronto<br /><br />
                </p>

                <h3>Fryderyk Chopin</h3>
                <p>
                    <strong>typ:</strong> bryg <br />
                    <strong>rok zwodowania:</strong> 1992 <br />
                    <strong>port macierzysty:</strong> Szczecin <br />
                    <a href="https://pl.wikipedia.org/wiki/STS_Fryderyk_Chopin"><strong>wikipedia:</strong> https://pl.wikipedia.org/wiki/STS_Fryderyk_Chopin</a>
                    <strong>odwiedzone porty:</strong> Kapsztad, Falmouth, Hawana, Szczecin<br /><br />
                </p>

                <h3>Dar Pomorza</h3>
                <p>
                    <strong>typ:</strong> fregata <br />
                    <strong>rok zwodowania:</strong> 1909 <br />
                    <strong>port macierzysty:</strong> Gdynia <br />
                    <a href="https://pl.wikipedia.org/wiki/Fregata_(typ_o%C5%BCaglowania)"><strong>wikipedia:</strong> https://pl.wikipedia.org/wiki/Fregata_(typ_o%C5%BCaglowania)</a>
                    <strong>odwiedzone porty:</strong>Mumbaj, Casablanca, Tokio, Halifax<br /><br />
                </p>
            </div>
        </div>

<?php include "includes/footer.inc.php"; ?>