<?php
class Authors
{
	public function getAuthors()
	{
		$objSpisok = new Spisok();
		$authors = $objSpisok->listAuthors();
		$genres = $objSpisok->listGenres();
		if(isset($_GET['author_id']))
		{
			$author_id = trim($_GET['author_id']);
			$author_id = strip_tags($author_id);
		}
		$books = $objSpisok->authorBooks($author_id);
		require_once 'templates/index.php';
	}
}
