<?php
class Books_admin
{
	
	public function getActionBook()
	{
		if($_GET['action'] == 'add'){
			if(isset($_GET['form_key']))
			{
				$objBooks = new Action();
				$result = $objBooks->validationBook();
					
				$objDb = new Db();
				//added to the main table of all the data and store ID, which is automatically created
				$objDb->insertAlltoBook($result);
				$nash_id = mysql_insert_id();	
				//add as many entries in the binding table book_to_author, as how many authors were selected
				for ($i = 0; $i <= count ($result['author']) - 1; $i++) 
				{
					$objDb->inserToBookAuthor($nash_id, $result['author'][$i]);
				}
				//add as many entries in the binding table book_to_genre, as how many genres were selected 
				for ($i = 0; $i <= count ($result['genre']) - 1; $i++) 
				{
					$objDb->inserToBookGenre($nash_id, $result['genre'][$i]);
				}	
			}
			$objBooks = new Action();
			$options = $objBooks->listInForma();
			$forma = '<form method="POST" action="index.php?page=books_admin&action=add&form_key=valid_value">
						<p><label>
			name<input type="text" name="name">
						</p></label>
						<p><label>
			description<textarea name="description">
							</textarea>
						</p></label>
						<p><label>
			price<input type="number" name="price">
						</p></label>
						<p><label>
			image<input type="text" name="image">
						</p></label>
						<p><select multiple name="author[]">';
			$forma.= $options['authors'];
			$forma.="</select></p>
						<p><select multiple name='genre[]'>";
			$forma.= $options['genres'];
			$forma.='</select></p><p><input type="submit"
			value="Add"></p></form>';
			$action = $forma;
			require_once 'templates/index.php';

		}
		if($_GET['action'] == 'edit'){
			if(isset($_GET['bk_id']))
			{
				$bk_id = trim($_GET['bk_id']);
				$bk_id = strip_tags($bk_id);
				if(empty($bk_id) || !is_numeric($bk_id))
				{
					die('not valid id');
				}
				$objBooks = new Action();
				$books_data = $objBooks->getInfoAboutBook($bk_id);
				$options = $objBooks->genresAndAuthorsFromBook($bk_id);
				$forma = '<form method="POST" action="index.php?page=books_admin&action=edit&form_key=valid_value">
						<input type="hidden" name="id" value="';
				$forma .= $books_data[0]['id'];
				$forma .= '"><p><label>name<input type="text" name="name"
				value="';
				$forma .= $books_data[0]['name'];
				$forma .= '"></p></label><p><label>description<textarea
				name="description">';
				$forma .= $books_data[0]['description'];
				$forma .= '</textarea></p></label><p><label>price<input type="number" name="price"
 value="';
				$forma .= $books_data[0]['price'];
				$forma .= '"></p></label>';
				$forma .= '<p><label>image<input type="text" name="image"
value="';
				$forma .= $books_data[0]['img'];
				$forma .= '"></p></label><p><select multiple name="author[]">';
				$forma .= $options['authors'];
				$forma .= '</select></p><p><select multiple name="genre[]">';
				$forma .= $options['genres'];
				$forma .= '</select></p><p><input type="submit" value="Edit"></p></form>';
				$action = $forma;
				require_once 'templates/index.php';
			}
			else
			{
				$objBook = new Action();
				$books = $objBook->listBooks();

				$action = $books;
				require_once 'templates/index.php';
			}
			//validate edited form and update info in base of edited book
			if(isset($_GET['form_key']))
			{
				$objBooks = new Action();
				//validate new data. If fail error will be shown
				$result = $objBooks->validationBook();
				$objDb = new Db();
				//added to the main table of all the data and store ID, which is automatically created
				$objDb->updateAlltoBook($result);
				//add as many entries in the binding table book_to_author, as how many authors were selected
				for ($i = 0; $i <= count ($result['author']) - 1; $i++) 
				{
					$objDb->inserToBookAuthor($result['id'],
						$result['author'][$i]);
				}
				//add as many entries in the binding table book_to_genre, as how many genres were selected 
				for ($i = 0; $i <= count ($result['genre']) - 1; $i++) 
				{
					$objDb->inserToBookGenre($result['id'],
						$result['genre'][$i]);
				}
			}
		}
		if($_GET['action'] == 'delete'){
			$bk_id = trim($_GET['bk_id']);
				$bk_id = strip_tags($bk_id);
				if(empty($bk_id) || !is_numeric($bk_id))
				{
					die('not valid id');
				}
			$objDb = new Db;
			$result = $objDb->bookDelete($bk_id);
			if($result)
			{
				$objBook = new Action();
				$books = $objBook->listBooks();
				$action = $books;
				require_once 'templates/index.php';
			}	
		}
	}
}
