<?php
class Genres
{
	public function getGenre()
	{
		$objSpisok = new Spisok();
		$authors = $objSpisok->listAuthors();
		if(isset($_GET['gr_id']))
		{
			$gr_id = trim($_GET['gr_id']);
			$gr_id = strip_tags($gr_id);	
		}
		$books = $objSpisok->genresBooks($gr_id);
		$genres = $objSpisok->listGenres();
		require_once 'templates/index.php';
	}
}
