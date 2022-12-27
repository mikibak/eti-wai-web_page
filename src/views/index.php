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
				<li id="main" class="currentPage">
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
			<img width="15" alt="jacht" title="Antila 24" src="static/pics/jacht1.jpg" />

			<h2>Moje hobby</h2>
			<p>
				Żeglarstwo to świetny sposób na spędzanie czasu. Szum fal i wiatru pozwala się zrelaksować,
				zaś wprowadzenie jachtu w ruch za pomocą żagli jest wymagające i satysfakcjonujące. Swoją
				przygodę z żeglarstwem zacząłem od obozów młodzieżowych na Mazurach, gdzie poznałem wielu
				ludzi z prawdziwą pasją. Na szlaku wielkich jezior w bezpieczny sposób mogą żeglować mniej
				doświadczeni żeglarze, w przeciwieństwie do morza, które potrafi być nieprzewidywalne i nie
				wybacza błędów.
			</p>
			<p>
				Na jachcie ważna jest współpraca i koordynacja, lecz żeglarstwo to przede wszystkim wypoczynek
				i sposób na oderwanie się od codziennych problemów. Każdy członek załogi może przydać się w
				obsłudze jachtu i poznać przydatne umiejętności.
			</p>
			<h2 id="linksParagraph">Przydatne linki</h2>
			<p>
				<a href="https://pya.org.pl/polski-zwiazek-zeglarski">https://pya.org.pl/polski-zwiazek-zeglarski</a> Polski Związek Żeglarski <br/>
				<a href="https://www.punt.pl/wezly-zeglarskie/">https://www.punt.pl/wezly-zeglarskie/</a> przydatny kurs węzłów, które przydadzą się na każdym
				rejsie
			</p>

			<img width="15" alt="jacht" title="asia.nikkei.com" src="static/pics/jacht2.jpg" />
		</div>

<?php include "includes/footer.inc.php"; ?>