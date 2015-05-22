<?php
class Genres_admin
{

	public function getActionGenres()
	{
		/* ADD */
		if($_GET['action'] == 'add'){
			if(isset($_POST['nameAdd']))
			{
				$objGenre = new Action();
				$result = $objGenre->genreAdd();
				if($result == true)
				{
					echo "Genre successfully add!";
				}
			}
				$formAdd = "<form method='POST' action='index.php?page=genres_admin&action=add'>
									<input type='text' name='nameAdd'>
									<input type='submit' value='Add'>
								</form>";
				$action = $formAdd;
			require_once 'templates/index.php';

		}
		/* EDIT */
		elseif($_GET['action'] == 'edit'){
			if(isset($_GET['genre_id']))
			{
				$genre_id = trim($_GET['genre_id']);
				$genre_id = strip_tags($genre_id);
				if(empty($genre_id) || !is_numeric($genre_id))
				{
					die('not valid id');
				}
				$objDb = new Db();
				$genre = $objDb->infoOneGenre($genre_id);
				$forma = "<form method='POST' action='index.php?page=genres_admin&action=edit&form_key=valid_value'>
							<input type='text' name='nameEdit' value='".$genre[0]["name"]."'>
							<input type='hidden' name='genre_id' value='".$genre[0]["id"]."'>
							<input type='submit' name='edit' value='edit'>";
				$action = $forma;
				require_once 'templates/index.php';
			}
			else
			{
				$objGenres = new Action();
				$genres = $objGenres->listGenres();
				$action = $genres;
				require_once 'templates/index.php';
			}
			if(isset($_POST['edit']))
			{
				$objGenresModel = new Action();
				//validate new data. If fail error will be shown
				$idAndName = $objGenresModel->validationGenre();

				$objDb = new Db();
				$result = $objDb->editGenre($idAndName['name'],
					$idAndName['id']);
				if($result == true)
				{
					echo "Genre successfully edit!";
				}
			}
		}
		/* DELETE */
		elseif($_GET['action'] == 'delete'){

			$genre_id = trim($_GET['genre_id']);
			$genre_id = strip_tags($genre_id);
			if(empty($genre_id) || !is_numeric($genre_id))
			{
				die('not valid id');
			}

			$objDb = new Db;
			$result = $objDb->deleteGenre($genre_id);

			$objGenres = new Action();
			$genres = $objGenres->listGenres();
			$action = $genres;
			require_once 'templates/index.php';
		}
	}
}