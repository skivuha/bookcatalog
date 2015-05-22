<?php
include 'config.php';

function __autoload($class)
{
	include 'app/'.$class.'.php';
}

$view = empty($_GET['page']) ? 'Home_admin' : $_GET['page'];
switch($view)
{
	case('Home_admin'):
		$objDefaultPage = new Home_admin();
		$objDefaultPage->getMenu();
		break;

	case('authors_admin'):
		$objAuthors = new Authors_admin();
		$objAuthors->getActionAuthors();
		break;

	case('genres_admin'):
		$objGenre = new Genres_admin();
		$objGenre->getActionGenres();
		break;

	case('books_admin'):
		$objBook = new Books_admin();
		$objBook->getActionBook();
		break;

	default:
		$view = 'Home_admin';
}