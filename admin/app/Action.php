<?php
 
 class Action
{
	
	public function listAuthors()
	{ /* receiving list of authors to add in index  file */
		$objDb = new Db();
		$listofAuthors = $objDb->listAuthors();
		if (!empty($listofAuthors)) 
		{
			foreach ($listofAuthors as $author ) 
			{			
					$authors .= "<p><a href = index.php?page=authors_admin&action=edit&author_id=".$author["id"].">".$author["name"]."</a>
			<a href = index.php?page=authors_admin&action=delete&author_id=".$author["id"].">DELETE</a></p>";
			}
		}
		else 
		{
			echo "<p>list of Authors not received</p>";
			exit();
		}
		return $authors;
	}

	public function setAuthor()
	{
		$nameAdd = trim($_POST['nameAdd']);
		$nameAdd = strip_tags($nameAdd);
		if (strlen($nameAdd) > 2 && strlen($nameAdd) < 60 )
		{
			$objDb = new Db();
			$objDb->saveAuthor($nameAdd);
		}
		else
		{
			echo "author is not valid";
			die();
		}
		return true;
	}
	
	public function validation()
	{
		$variablesArray = array(); 
		if (isset($_POST['author_id']))
		{
			$variablesArray['id'] = $_POST['author_id'];
			if (!is_numeric($variablesArray['id']))
			{
				die('you are a bad hacker!');
			}
		}
		$variablesArray['name'] = trim($_POST['nameEdit']);
		$variablesArray['name'] = strip_tags($variablesArray['name']);
		if (strlen($variablesArray['name']) < 2 || strlen($variablesArray['name']) > 60 )
		{
			die('name length must be more 2 and less then 60');
		}
		return $variablesArray;
	}

	 public function listGenres()
	 { /* receiving list of genres to add in index file */
		 $objDb = new Db;
		 $listofGenres = $objDb->listGenres();
		 if (!empty($listofGenres))
		 {
			 foreach ($listofGenres as $genre )
			 {
				 $genres .= "<p><a href = index.php?page=genres_admin&action=edit&genre_id=".$genre["id"].">".$genre["name"]."</a>
			<a href = index.php?page=genres_admin&action=delete&genre_id=".$genre["id"].">DELETE</a></p>";
			 }
		 }
		 else
		 {
			 echo "<p>list of Genres not received</p>";
			 exit();
		 }
		 return $genres;


	 }

	 public function genreAdd()
	 {
		 $nameAdd = trim($_POST['nameAdd']);
		 $nameAdd = strip_tags($nameAdd);
		 if (strlen($nameAdd) > 2 && strlen($nameAdd) < 60 )
		 {
			 $objDb = new Db();
			 $objDb->saveGenre($nameAdd);
		 }
		 else
		 {
			 echo "genre is not valid";
			 die();
		 }
		 return true;
	 }

	 public function validationGenre()
	 {
		 $variablesArray = array();
		 if (isset($_POST['genre_id']))
		 {
			 $variablesArray['id'] = $_POST['genre_id'];
			 if (!is_numeric($variablesArray['id']))
			 {
				 die('you are a bad hacker!');
			 }
		 }
		 $variablesArray['name'] = trim($_POST['nameEdit']);
		 $variablesArray['name'] = strip_tags($variablesArray['name']);
		 if (strlen($variablesArray['name']) < 2 || strlen($variablesArray['name']) > 60 )
		 {
			 die('name length must be more 2 and less then 60');
		 }
		 return $variablesArray;
	 }

	 public function listBooks()
	 {
		 $objDb = new Db();
		 $listofBooks = $objDb->listBooks();
		 if (!empty($listofBooks))
		 {
			 foreach ($listofBooks as $book )
			 {
				 $books .= "<p><a href = index.php?page=books_admin&action=edit&bk_id=".$book["id"].">".$book["name"]."</a>
					<a href = index.php?page=books_admin&action=delete&bk_id=".$book["id"].">DELETE</a></p>";
			 }
		 }
		 else
		 {
			 echo "<p>List of Books not received</p>";
			 exit();
		 }
		 return $books;
	 }

	 public function listInForma()
	 {
		 $objDb = new Db();
		 $authorsArray = $objDb->listAuthors();
		 $options = array();
		 foreach($authorsArray as $author)
		 {
			 $options['authors'] .= "<option value = '".$author['id']."'>".$author['name']."</option>";
		 }
		 $genresArray = $objDb->listGenres();
		 foreach($genresArray as $genre)
		 {
			 $options['genres'] .= "<option value = '".$genre['id']."'>".$genre['name']."</option>";
		 }
		 return $options;
	 }

	 public function genresAndAuthorsFromBook($bk_id)
	 {
		 $objDb = new Db();
		 $books_data = $objDb->editOneBook($bk_id);
		 $genres_data = $objDb->editOneBookGenres($bk_id);
		 $authors_data = $objDb->editOneBookAuthors($bk_id);
		 $options = array();
		 foreach($authors_data as $author)
		 {
			 if($author['book'] == $bk_id)
			 {
				 $options['authors'] .= "<option selected value = '".$author['id']."'>".$author['name']."</option>";
			 }
			 else
			 {
				 $options['authors'] .= "<option value = '".$author['id']."'>".$author['name']."</option>";
			 }
		 }

		 foreach($genres_data as $genre)
		 {
			 if($genre['book'] == $bk_id)
			 {
				 $options['genres'] .= "<option selected value = '".$genre['id']."'>".$genre['name']."</option>";
			 }
			 else
			 {
				 $options['genres'] .= "<option value = '".$genre['id']."'>".$genre['name']."</option>";
			 }

		 }
		 return $options;
	 }

	 public function blockAuthorBooks($author_id)
	 {
		 $objDb = new Db();
		 $listofAuthorBooks = $objDb->listAuthorBooks($author_id);
		 if (!empty($listofAuthorBooks))
		 {
			 foreach ($listofAuthorBooks as $author )
			 {
				 $authorbooks .= "<p><a href = index.php?page=books&bk_id=".$author["id"].">".$author["name"]."</a></p>";
			 }
		 }
		 else
		 {
			 echo "<p>List of Books not received</p>";
			 exit();
		 }
		 return $authorbooks;


	 }

	 public function blockGenresBooks($gr_id)
	 {
		 $objDb = new Db();
		 $listofGenresBooks = $objDb->listGenresBooks($gr_id);
		 if (!empty($listofGenresBooks))
		 {
			 foreach ($listofGenresBooks as $genre )
			 {
				 $genresbook .= "<p><a href = index.php?page=books&bk_id=".$genre["id"].">".$genre["name"]."</a></p>";
			 }
		 }
		 else
		 {
			 echo "<p>List of Genres not received</p>";
			 exit();
		 }
		 return $genresbook;
	 }

	 public function blockInfoBook($bk_id)
	 {
		 $objDb = new Db();
		 $oneSingleBook = $objDb->oneBook($bk_id);
		 $book = $oneSingleBook[0]["name"].$oneSingleBook[0]["price"].$oneSingleBook[0]["description"].$oneSingleBook[0]["genre"].$oneSingleBook[0]["author"];
		 return $book;
	 }

	 public function getInfoAboutBook($bk_id)
	 {
		 $objDb = new Db();
		 $books_data = $objDb->editOneBook($bk_id);
		 return $books_data;
	 }

	 public function validationBook()
	 {	$variablesArray = array();
		 if (isset($_POST['id']))
		 {
			 $variablesArray['id'] = $_POST['id'];
			 if (!is_numeric($variablesArray['id']))
			 {
				 die('you are a bad hacker!');
			 }
		 }
		 $variablesArray['name'] = trim($_POST['name']);
		 $variablesArray['name'] = strip_tags($variablesArray['name']);
		 if (strlen($variablesArray['name']) < 2 || strlen($variablesArray['name']) > 60 )
		 {
			 die('name length must be more 2 and less then 60');
		 }

		 $variablesArray['description'] = trim($_POST['description']);
		 $variablesArray['description'] = strip_tags($variablesArray['description']);
		 if (strlen($variablesArray['description']) < 12 || strlen($variablesArray['description']) > 2000 )
		 {
			 die('description length must be more 12 and less then 2000');
		 }
		 else
		 {
			 $variablesArray['description'] = htmlspecialchars($variablesArray['description'], ENT_QUOTES);
		 }

		 $variablesArray['price'] = trim($_POST['price']);
		 $variablesArray['price'] = strip_tags($variablesArray['price']);
		 if (!is_numeric($variablesArray['price']))
		 {
			 die('price must be numeric more then 0 and less then 10 000');
		 }

		 $variablesArray['image'] = trim($_POST['image']);
		 $variablesArray['image'] = strip_tags($variablesArray['image']);
		 if (strlen($variablesArray['image']) < 1 || strlen($variablesArray['image']) > 255 )
		 {
			 die('image length must be more 0 and less then 255');
		 }

		 if(!isset($_POST['author']) || !isset($_POST['genre']))
		 {
			 die('select at list one author and one genre from the list');
		 }
		 foreach($_POST['author'] as $author)
		 {
			 $author = strip_tags($author);
			 if (!is_numeric($author))
			 {
				 die('select author from the list');
			 }
			 else
			 {
				 $variablesArray['author'][] = $author;
			 }
		 }

		 foreach($_POST['genre'] as $genre)
		 {
			 $genre = strip_tags($genre);
			 if (!is_numeric($genre))
			 {
				 die('select genre from the list');
			 }
			 else
			 {
				 $variablesArray['genre'][] = $genre;
			 }
		 }
		 return $variablesArray;
	 }
}	
