<?php
class Books
{
	public function getBook()
	{
		$objSpisok = new Spisok();
		$authors = $objSpisok->listAuthors();
		if(isset($_GET['bk_id']))
		{
			$bk_id = trim($_GET['bk_id']);
			$bk_id = strip_tags($bk_id);	
		}
		$books = $objSpisok->detailsBook($bk_id);
		$books .= file_get_contents("templates/html/forma.html");
		$genres = $objSpisok->listGenres();
		require_once 'templates/index.php';
	}

	public function sendmail($book_id)
	{
		$quantity = (int)$_POST['quantity'];
		$firstname = htmlspecialchars(trim($_POST['firstname']));
		$lastname = htmlspecialchars(trim($_POST['lastname']));
		$text = htmlspecialchars(trim($_POST['text']));
		$rez = mail("admin@test.ru","$book_id","Want to buy $quantity pcs
		.\n.\nMy name is $firstname $lastname.\nMy address $text.\nPlease
		contact me.");
	}
}