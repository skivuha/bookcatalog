<?php
include 'config.php';

function __autoload($class)
{
	include 'app/'.$class.'.php';
}

$view = empty($_GET['page']) ? 'Home' : $_GET['page'];

switch($view)
{
	case('Home'):
		$objDefaultPage = new Home();
		$objDefaultPage->getBook();
		break;

	case('authors'):
		$objAuthors = new Authors();
		$objAuthors->getAuthors();
		break;

	case('genres'):
		$objGenre = new Genres();
		$objGenre->getGenre();
		break;

	case('books'):
		$objBook = new Books();
		$objBook->getBook();

		if(isset($_POST['sendmail'])){
			$objBook->sendmail($_GET['bk_id']);
		}
		break;

	default:
		$view = 'Home';
}