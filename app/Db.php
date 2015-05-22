<?php

class Db
{
	public function __construct()
	{
		mysql_connect(HOST, USER, PASS) or die('no connection to server');
		mysql_select_db(DB) or die ('no connection to DataBase');
	}

	public function listAuthors()
	{
		$listOfAuthors = array();
		$result = mysql_query("SELECT * from authors");
		if (empty ($result))
		{
			echo "<p>The data from the table not received.</p>";
			exit(mysql_error());
		}
		while ($row = mysql_fetch_assoc($result))
		{
			$listOfAuthors[] = $row;
		}

		return $listOfAuthors;
	}

	public function listGenres()
	{
		$listOfGenres = array();
		$result = mysql_query("SELECT * from genres");
		if (empty($result))
		{
			echo "<p>The data from the table not received.</p>";
			exit(mysql_error());
		}
		while ($row = mysql_fetch_assoc($result))
		{
			$listOfGenres[] = $row;
		}

		return $listOfGenres;
	}

	public function listBooks()
	{
		$listOfBooks = array();
		$result = mysql_query("SELECT * from books");
		if (empty($result))
		{
			echo "<p>The data from the table not received.</p>";
			exit(mysql_error());
		}
		while ($row = mysql_fetch_assoc($result))
		{
			$listOfBooks[] = $row;
		}

		return $listOfBooks;
	}

	public function listAuthorBooks($author_id)
	{
		$listOfBooksAuthor = array();
		$authorBookRequest = "select books.id, books.name, books.price, books.img
			from books, authors,
			book_author
			where
			book_author.book = books.id
			and authors.id = book_author.author
			and authors.id = " . $author_id . "
			GROUP BY books.name";
		$result = mysql_query($authorBookRequest);
		if (empty($result))
		{
			echo "<p>The data from the table not received.</p>";
			exit(mysql_error());
		}
		while ($row = mysql_fetch_assoc($result))
		{
			$listOfBooksAuthor[] = $row;
		}

		return $listOfBooksAuthor;
	}

	public function listGenresBooks($gr_id)
	{
		$listOfGenreBooks = array();
		$genreBookRequest = "select books.id, books.name, books.price, books.img
			from books, genres,
			book_genre
			where
			book_genre.book = books.id
			and genres.id = book_genre.genre
			and genres.id = " . $gr_id . "
			GROUP BY books.name";
		$result = mysql_query($genreBookRequest);
		if (empty($result))
		{
			echo "<p>The data from the table not received.</p>";
			exit(mysql_error());
		}
		while ($row = mysql_fetch_assoc($result))
		{
			$listOfGenreBooks[] = $row;
		}
		return $listOfGenreBooks;
	}

	public function oneBook($bk_id)
	{
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
			and b.id = " . $bk_id . "
			GROUP BY b.name";
		$result = mysql_query($bookRequest);
		if (empty($result))
		{
			echo "<p>The data from the table not received.</p>";
			exit(mysql_error());
		}
		while ($row = mysql_fetch_assoc($result))
		{
			$listOfBooks[] = $row;
		}

		return $listOfBooks;
	}
}