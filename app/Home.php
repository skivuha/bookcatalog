<?php

class Home
{
	public function getBook()
	{
		$objList = new Spisok();
		$authors = $objList->listAuthors();
		$books = $objList->listBooks();
		$genres = $objList->listGenres();
		require_once 'templates/index.php';
	}
}