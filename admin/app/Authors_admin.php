<?php
class Authors_admin
{
	public function getActionAuthors()
	{
		/* ADD */
		if($_GET['action'] == 'add'){
			if(isset($_POST['nameAdd']))
			{
				$objAction = new Action();
				$result = $objAction->setAuthor();
				if($result == true)
				{
					echo "Author successfully add!";
				}
			}
				$formAdd = "<form method='POST' action='index.php?page=authors_admin&action=add'>
									<input type='text' name='nameAdd'>
									<input type='submit' value='Add'>
								</form>";
			$action = $formAdd;
			require_once 'templates/index.php';
		}
		/* EDIT */
		elseif($_GET['action'] == 'edit'){
			if(isset($_GET['author_id']))
			{
				$author_id = trim($_GET['author_id']);
				$author_id = strip_tags($author_id);
				if(empty($author_id) || !is_numeric($author_id))
				{
					die('not valid id');
				}
				$objDb = new Db();
				$author = $objDb->infoOneAuthor($author_id);
				$forma = "<form method='POST' action='index.php?page=authors_admin&action=edit&form_key=valid_value'>
							<input type='text' name='nameEdit' value='".$author[0]["name"]."'>
							<input type='hidden' name='author_id' value='".$author[0]["id"]."'>
							<input type='submit' name='edit' value='edit'>";
				$action = $forma;
				require_once 'templates/index.php';
			}
			else
			{
				$objAction = new Action();
				$authors = $objAction->listAuthors();
				$action = $authors;
				require_once 'templates/index.php';
			}
			if(isset($_POST['edit']))
			{
				$objAction = new Action();
				//validate new data. If fail error will be shown
				$idAndName = $objAction->validation();
 				
				$objDb = new Db();
				$result = $objDb->editAuthor($idAndName['name'], $idAndName['id']);
				if($result == true)
				{
					echo "Author successfully edit!";
				}
			}
		}
		/* DELETE */
		elseif($_GET['action'] == 'delete'){
		
			$author_id = trim($_GET['author_id']);
			$author_id = strip_tags($author_id);
			if(empty($author_id) || !is_numeric($author_id))
			{
				die('not valid id');
			}

			$objDb = new Db();
			$result = $objDb->deleteAuthor($author_id);
			
			$objAction = new Action();
			$authors = $objAction->listAuthors();
			$action = $authors;
			require_once 'templates/index.php';
		}
	}
}