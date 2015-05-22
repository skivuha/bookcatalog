<?php

class Db{
	public function __construct(){
		mysql_connect(HOST, USER, PASS) or die('no connection to server');
		mysql_select_db (DB) or die ('no connection to DataBase');
	}
	
	
		/*** BLOCK_AUTHORS_START***/
public function listAuthors(){
	$listOfAuthors = array();
	$result = mysql_query("SELECT * from authors");
	if(empty ($result))
	{
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfAuthors[] = $row;
	}
	return $listOfAuthors;
}

public function infoOneAuthor($author_id){
	$listOfAuthors = array();
	$result = mysql_query("SELECT * from authors WHERE id = $author_id");
	if(empty ($result))
	{
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfAuthors[] = $row;
	}
	return $listOfAuthors;
}

public function saveAuthor($nameAdd){ /* if ADD chosen */

	$result = mysql_query("INSERT INTO authors (name) VALUES ('$nameAdd')");
	
	if(!$result)
	{
		echo"<p>Data not recorded.</p>";
		exit(mysql_error());
	}
	return true;
}

public function editAuthor($nameEdit, $id){ /* if EDIT chosen */

	$result = mysql_query("UPDATE authors SET name='$nameEdit' WHERE id = '$id'");
	
	if(!$result)
	{
		echo"<p>Data not edited</p>";
		exit(mysql_error());
	}
	return true;
}

 public function deleteAuthor($id){ /*if DELETE chosen*/

	$result = mysql_query("DELETE FROM authors WHERE id = '$id'");
	$result2 =  mysql_query("DELETE FROM book_author WHERE author = '$id'");
	
	if(!$result)
	{
		echo"<p>Data not deleted</p>";
		exit(mysql_error());
	}
	return true;
 }

 /*** BLOCK_AUTHORS_END***/
 
		/*** BLOCK_GENRES_START***/
 
public function saveGenre($nameAdd){

	$result = mysql_query("INSERT INTO genres (name) VALUES ('$nameAdd')");
	
	if(!$result)
	{
		echo"<p>Data not recorded</p>";
		exit(mysql_error());
	}
	return true;
}

public function infoOneGenre($genre_id){
	$listOfGenres = array();
	$result = mysql_query("SELECT * from genres WHERE id = $genre_id");
	if(empty ($result))
	{
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfGenres[] = $row;
	}
	return $listOfGenres;
}

public function editGenre($nameEdit, $id){

	$result = mysql_query("UPDATE genres SET name='$nameEdit' WHERE id = '$id'");
	
	if(!$result)
	{
		echo"<p>Data not recorded</p>";
		exit(mysql_error());
	}
	return true;
}

public function deleteGenre($id){

	$result = mysql_query("DELETE FROM genres WHERE id = '$id'");
	$result2 =  mysql_query("DELETE FROM book_genre WHERE genre = '$id'");
	
	if(!$result)
	{
		echo"<p>Data not edited</p>";
		exit(mysql_error());
	}
	return true;
}

public function listGenres(){
	$listOfGenres = array();
	$result = mysql_query("SELECT * from genres");
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfGenres[] = $row;
	}
	return $listOfGenres;
}

/*** BLOCK_GENRES_END***/

		/*** BLOCK_BOOKS_START***/

public function listBooks(){
	$listOfBooks = array();
	$result = mysql_query("SELECT * from books");
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfBooks[] = $row;
	}
	return $listOfBooks;
}

public function listAuthorBooks($author_id){
	$listOfBooksAuthor = array();
	$authorBookRequest = "select b.id, b.name, b.price, b.img
			from books b, authors a,
			book_author ba
			where
			ba.book = b.id
			and a.id = ba.author
			and a.id = ".$author_id."
			GROUP BY b.name";
	$result = mysql_query($authorBookRequest);
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfBooksAuthor[] = $row;
	}
	return $listOfBooksAuthor;
}

public function listGenresBooks($gr_id){
	$listOfGenreBooks = array();
	$genreBookRequest = "select b.id, b.name, b.price, b.img
			from books b, genres g,
			book_genre bg
			where
			bg.book = b.id
			and g.id = bg.genre
			and g.id = ".$gr_id."
			GROUP BY b.name";
	$result = mysql_query($genreBookRequest);
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfGenreBooks[] = $row;
	}
	return $listOfGenreBooks;
}

public function oneBook($bk_id){
	$listOfBooks = array();
	$bookRequest = "select b.id, b.name, b.description, b.price, b.img,
						GROUP_CONCAT(DISTINCT g.name) as genre,
						GROUP_CONCAT(DISTINCT a.name) as author
			from books b, genres g, authors a,
			book_genre bg, book_author ba
			where
			bg.book = b.id
			and ba.book = b.id
			and g.id = bg.genre
			and a.id = ba.author
			and b.id = ".$bk_id."
			GROUP BY b.name";
	$result = mysql_query($bookRequest);
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfBooks[] = $row;
	}
	return $listOfBooks;
}

public function editOneBook($bk_id){
	$listOfBooks = array();
	$bookRequest = "select * from books
			where
			id = ".$bk_id;
	
	$result = mysql_query($bookRequest);
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfBooks[] = $row;
	}
	return $listOfBooks;
}

public function editOneBookGenres($bk_id){
	$listOfBooks = array();

	$bookRequest = "SELECT * FROM genres LEFT JOIN 
	(SELECT * FROM book_genre WHERE book='$bk_id')
	book_genre ON genres.id=book_genre.genre";
	
	$result = mysql_query($bookRequest);
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfBooks[] = $row;
	}
	return $listOfBooks;
}

public function editOneBookAuthors($bk_id){
	$listOfBooks = array();
	$bookRequest = "SELECT * FROM authors LEFT JOIN 
	(SELECT * FROM book_author WHERE book='$bk_id')
	book_author ON authors.id=book_author.author";
	
	$result = mysql_query($bookRequest);
	if(empty($result)){
		echo"<p>The data from the table not received.</p>";
		exit(mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$listOfBooks[] = $row;
	}
	return $listOfBooks;
}

public function insertAlltoBook($result)
{
	$dobavKnigu = mysql_query ("INSERT INTO books
	(name, description, price, img)
	VALUES ('".$result['name']."', '".$result['description']."','".$result['price']."','".$result['image']."' )");
	if(!$dobavKnigu)
	{
		echo"<p>Data not recorded</p>";
		exit(mysql_error());
	}
	return $dobavKnigu;
}

public function updateAlltoBook($result)
{
	$updateBook = mysql_query ("UPDATE books SET
		name = '".$result['name']."',
		description = '".$result['description']."',
		price = '".$result['price']."',
		img = '".$result['image']."'
		WHERE id = '".$result['id']."'");
	mysql_query ("DELETE FROM book_author where book = '".$result['id']."'");
	mysql_query ("DELETE FROM book_genre where book = '".$result['id']."'");
	
	if(!$updateBook)
	{
		echo"<p>Data not recorded</p>";
		exit(mysql_error());
	}
	return $updateBook;
}

public function bookDelete($bk_id)
{
	$result1 = mysql_query ("DELETE FROM book_author where book = '".$bk_id."'");
	$result2 = mysql_query ("DELETE FROM book_genre where book = '".$bk_id."'");
	$result3 = mysql_query ("DELETE FROM books where id = '".$bk_id."'");
	if($result1 && $result2 && $result3)
	{
		return true;
	}
	else
	{
		die('data not deleted');
	}

}

public function inserToBookAuthor($nash_id, $result)
{
	$dobavKnigu = mysql_query ("INSERT INTO book_author
	(book, author)
	VALUES ('".$nash_id."', '".$result."')");
	if(!$dobavKnigu)
	{
		echo"<p>Data not recorded</p>";
		exit(mysql_error());
	}
	return $dobavKnigu;
}	

public function inserToBookGenre($nash_id, $result)
{
	$dobavKnigu = mysql_query ("INSERT INTO book_genre
	(book, genre)
	VALUES ('".$nash_id."', '".$result."')");
	if(!$dobavKnigu)
	{
		echo"<p>Data not recorded</p>";
		exit(mysql_error());
	}
	return $dobavKnigu;
}

/*** BLOCK_BOOKS_END***/

}