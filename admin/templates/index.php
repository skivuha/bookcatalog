<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../admin/templates/css/style.css" />
	<title>HomePage</title>
</head>
<body>
<div class="main">
	<div class="header">
		<a href="/"><img class="logo" src="../templates/images/logo.jpg" alt="Bookshop" /></a>
		<h1><p>BookShop</p></h1>
	</div>
	<div id="contentwrapper">
		<div id="content">
			<div class="catalog-index">
				<div class="product-index">
					<?=$action?>
				</div>
			</div>
		</div>
	</div>
	<div id="left-bar">
		<div>
			<p align="center" class="title">Books</p>
			<div id="coolmenu">
				<p><a href="index.php?page=books_admin&action=add">Add</a></p>
				<p><a href="index.php?page=books_admin&action=edit">Edit / Delete</a></p>
			</div>
			<p align="center" class="title">Genres</p>
			<div id="coolmenu">
				<p><a href = "index.php?page=genres_admin&action=add">Add</a></p>
				<p><a href="index.php?page=genres_admin&action=edit">Edit / Delete</a></p>
			</div>
			<p align="center" class="title">Authors</p>
			<div id="coolmenu">
				<p><a href="index.php?page=authors_admin&action=add">Add</a></p>
				<p><a href="index.php?page=authors_admin&action=edit">Edit / Delete</a></p>
			</div>
		</div>
	</div>
</div>
<div class="clr"></div>
</div>
</body>
</html>
