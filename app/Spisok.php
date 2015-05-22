<?php

class Spisok {

	public function listAuthors()
	{
		$objMysql = new Db();
		$listofAuthors = $objMysql->listAuthors();
		if (!empty($listofAuthors))
		{
			foreach ($listofAuthors as $author )
			{
				$authors .= "<p><a href = index.php?page=authors&author_id=".$author["id"].">".$author["name"]."</a></p>";
			}
		}
		return $authors;
	}

	public function listBooks()
	{
		$objMysql = new Db();
		$listofBooks = $objMysql->listBooks();
		if (!empty($listofBooks))
		{
			foreach ($listofBooks as $book)
			{
				$books .= "<p><a href = index.php?page=books&bk_id=" . $book["id"] . ">" . $book["name"] . "
					<p><img src='templates/images/" . $book["img"] . "'></p></a></p>
					<p>Price:" . $book["price"] . "</p>";
			}
		}
		return $books;
	}

	public function listGenres()
	{
		$objMysql = new Db();
		$listofGenres = $objMysql->listGenres();
		if (!empty($listofGenres))
		{
			foreach ($listofGenres as $genre )
			{
				$genres .= "<p><a href = index.php?page=genres&gr_id=".$genre["id"].">".$genre["name"]."</a></p>";
			}
		}
		return $genres;
	}

	public function authorBooks($author_id)
	{
		$objMysql = new Db();
		$listofAuthorBooks = $objMysql->listAuthorBooks($author_id);
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

	public function genresBooks($gr_id)
	{
		$objMysql = new Db();
		$listofGenresBooks = $objMysql->listGenresBooks($gr_id);
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

	public function detailsBook($bk_id){
		$objMysql = new Db();
		$oneSingleBook = $objMysql->oneBook($bk_id);
		$book = '<p class="center">'.$oneSingleBook[0]["name"].'</p>'
			.'<p class="center"><img src=templates/images/'.$oneSingleBook[0]["img"].'></p>
				<p>'.$oneSingleBook[0]["description"].'</p>'
			.'<p class="info">genre(s): '.$oneSingleBook[0]["genre"].'</p>'
			.'<p class="info">author(s): '.$oneSingleBook[0]["author"].'</p>'
			.'<p class="info">price: '.$oneSingleBook[0]["price"].'.uah </p>';
		return $book;
	}
} 