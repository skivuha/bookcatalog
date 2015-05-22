<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../templates/css/style.css" />
<title>HomePage</title>
</head>
<body>
<div class="main">
	<div class="logoa">
	<h1><a href="/" class="header">Catalog</a></h1>
		</div>
    <div id="contentwrapper">
		<div id="content">
        	<div class="catalog-index">
				<h1>Books</h1>
				<div class="product-index">
						<?=$books;?>
				</div>
             </div>   
        </div>
    </div>      
    <div id="left-bar">
            <div class="info">
				<h3>Autors:</h3>
				<?=$authors; ?>
			</div> 
            <div class="info">
				<h3>Genres:</h3>
				<?=$genres;?>
			</div>
			<div class="info">
				<h3>ADMIN:</h3>
				<a href="admin/index.php">Administrator</a>
			</div>
        </div>
    </div>
    <div class="clr"></div>
</div>
</body>
</html>
