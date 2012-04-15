<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
		<title>Adriano Laranjeira - Engenheiro de software</title>
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> 
		<link rel="stylesheet" type="text/css" href="styles/main.css">
	</head>
	<body>
		<!--start container-->
		<div id="container">
		<!--start header-->
			<header>
				<!--start logo-->
				<a href="#" id="logo"><img src="/images/logo.png" alt="logo"></a>	 
				<!--end logo-->

				<!--start menu-->
				<nav>
					<ul>
						<li><a href="/">Início</a></li> <!-- class="current" -->
						<li><a href="http://about.me/arglbr">Sobre</a></li>
						<li><a href="http://arglbr.github.com">Projetos</a></li>
						<li><a href="#">Contato</a></li>
						<li><a class="current" href="#">&nbsp;</a></li>
					</ul>
				</nav>
				<!--end menu-->

			<!--end header-->
			</header>

			{% block main_content %}{% endblock %}

			<!--start intro-->
			<div id="intro">
				<img src="/images/banner1.png" alt="baner">
			</div>
			<!--end intro-->

			<header class="group_bannner_left">
				<hgroup>
					<h1>Olá, como vai você?</h1>
						<h2>Sou Adriano Laranjeira, um engenheiro de software morando em São Bernardo do Campo - SP. Padrasto, andarilho, desenvolvedor, contribuidor Fedora, fã do GNU/Linux & open source.</h2>
				</hgroup>
			</header>

		</div>
		<!--end container-->

		<!--start footer-->
		<!-- footer>
			<div class="container">  
				<div id="FooterTwo">© 2011 Fresh ideas</div>
				<div id="FooterTree">Design and code offered by <a href="http://www.marijazaric.com/">marija zaric.</a></div> 
			</div>
		</footer -->
		<!--end footer-->
		<!-- Free template distributed by http://freehtml5templates.com -->	
	</body>
</html>
