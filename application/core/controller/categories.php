<?php

class Categories_Controller extends Controller
{
	public function __construct($app)
	{
		parent::__construct($app);
		
		$this->app->get_page()->set_path(array(
			'index.php' => 'Category Page',
			'index.php?route=admin' => 'Admin Panel',
			'index.php?route='.MODULE_NAME => 'Category',
			));	
		
		$columns = array(
			array('db_name' => 'id',         'column_name' => 'Id',          'sorting' => 1),
			array('db_name' => 'parent_id',  'column_name' => 'Parent',      'sorting' => 1),
			array('db_name' => 'section',    'column_name' => 'Section',      'sorting' => 1),
			array('db_name' => 'permission', 'column_name' => 'Permission',      'sorting' => 1),
			array('db_name' => 'item_order', 'column_name' => 'Order',   'sorting' => 1),
			array('db_name' => 'caption',    'column_name' => 'Name',       'sorting' => 1),
			array('db_name' => 'link',       'column_name' => 'Link',       'sorting' => 1),
			array('db_name' => 'page_id',    'column_name' => 'Page',      'sorting' => 1),
			array('db_name' => 'visible',    'column_name' => 'Active',     'sorting' => 1),
			array('db_name' => 'target',     'column_name' => 'Target',      'sorting' => 1),
			array('db_name' => 'user_login', 'column_name' => 'Author',       'sorting' => 1),
			array('db_name' => 'modified',   'column_name' => 'Modified', 'sorting' => 1),
		);

		$this->required = array('caption', 'link');

		parent::init($columns);

		$layout = $this->app->get_settings()->get_config_key('page_template_admin');

		$this->app->get_page()->set_layout($layout);
	}

	public function Index_Action()
	{
		if ($this->app->get_acl()->allowed(OPERATOR)) // są uprawnienia
		{
			parent::Index_Action();

			if (isset($_GET['mode'])) $_SESSION['categories_list_mode'] = $_GET['mode'];

			$options = array(
				array(
					'link' => 'index.php?route='.MODULE_NAME.'&action=add',
					'caption' => 'New Category',
					'icon' => 'img/files.png',
					),
				array(
					'link' => 'index.php?route='.MODULE_NAME.'&mode=1',
					'caption' => 'Main Navigation',
					'icon' => 'img/top_menu.png',
					),
				array(
					'link' => 'index.php?route='.MODULE_NAME.'&mode=2',
					'caption' => 'Sidebar Navigation',
					'icon' => 'img/left_menu.png',
					),
				array(
					'link' => 'index.php?route=admin',
					'caption' => 'Cancel',
					'icon' => 'img/stop.png',
					),
				);

			$data = $this->app->get_model_object()->GetAll();

			parent::Update_Paginator();

			$this->app->get_page()->set_options($options);

			$this->app->get_page()->set_content($this->app->get_view_object()->ShowList($this->columns, $data));
		}
		else // brak uprawnień
		{
			parent::AccessDenied();
		}
	}

	public function Add_Action()
	{
		if ($this->app->get_acl()->allowed(OPERATOR)) // No record
		{
			parent::Add_Action();

			if (!empty($_POST))
			{
				$record = array(
					'parent_id' => $_POST['parent_id'],
					'section' => $_POST['section'],
					'page_id' => 0,
					'item_order' => 0,
					'caption' => $_POST['caption'],
					'link' => $_POST['link'],
					'permission' => $_POST['permission'],
					'visible' => $_POST['active'],
					'target' => isset($_POST['target']) ? 1 : 0,
					'author_id' => $this->app->get_user()->get_value('user_id'),
					'modified' => date("Y-m-d H:i:s"),
					);

				if (isset($_POST['save_button']))
				{
					$id = $this->app->get_model_object()->Add($record);

					if ($id) $this->app->get_page()->set_message(MSG_INFORMATION, 'Category has been created.');
					else $this->app->get_page()->set_message(MSG_ERROR, 'Category not created.');

					header('Location: index.php?route='.MODULE_NAME.'&action=edit&id='.$id.'&check=true');
					exit;
				}
				else if (isset($_POST['update_button']))
				{
					$id = $this->app->get_model_object()->Add($record);

					if ($id) $this->app->get_page()->set_message(MSG_INFORMATION, 'Kategoria została pomyślnie utworzona.');
					else $this->app->get_page()->set_message(MSG_ERROR, 'Kategoria nie została utworzona.');

					header('Location: index.php?route='.MODULE_NAME);
					exit;
				}
				else // button Cancel
				{
					header('Location: index.php?route='.MODULE_NAME);
					exit;
				}
			}
			else // pusty formularz
			{
				$options = array(
					array(
						'link' => 'index.php?route='.MODULE_NAME,
						'caption' => 'Cancel',
						'icon' => 'img/stop.png',
						),
					);

				$data = NULL;

				$import = $this->app->get_model_object()->GetCategories();

				$this->app->get_page()->set_options($options);

				$this->app->get_page()->set_content($this->app->get_view_object()->ShowForm($data, $import));
			}			
		}
		else // No record
		{
			parent::AccessDenied();
		}
	}

	public function Edit_Action()
	{
		if ($this->app->get_acl()->allowed(OPERATOR)) // No Record
		{
			parent::Edit_Action();

			$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

			if (!empty($_POST))
			{
				$record = array(
					'parent_id' => $_POST['parent_id'],
					'section' => $_POST['section'],
					'page_id' => 0,
					'item_order' => 0,
					'caption' => $_POST['caption'],
					'link' => $_POST['link'],
					'permission' => $_POST['permission'],
					'visible' => $_POST['active'],
					'target' => isset($_POST['target']) ? 1 : 0,
					'author_id' => $this->app->get_user()->get_value('user_id'),
					'modified' => date("Y-m-d H:i:s"),
					);

				if (isset($_POST['save_button']))
				{
					$result = $this->app->get_model_object()->Save($id, $record);

					if ($result) $this->app->get_page()->set_message(MSG_INFORMATION, 'Modifications has been updated.');
					else $this->app->get_page()->set_message(MSG_ERROR, 'Changes not updated.');

					header('Location: index.php?route='.MODULE_NAME.'&action=edit&id='.$id.'&check=true');
					exit;
				}
				else if (isset($_POST['update_button']))
				{
					$result = $this->app->get_model_object()->Save($id, $record);

					if ($result) $this->app->get_page()->set_message(MSG_INFORMATION, 'Modifications has been updated.');
					else $this->app->get_page()->set_message(MSG_ERROR, 'Modifications not updated.');

					header('Location: index.php?route='.MODULE_NAME);
					exit;
				}
				else // button Anuluj
				{
					header('Location: index.php?route='.MODULE_NAME);
					exit;
				}
			}
			else // wczytany formularz
			{
				$page_id = $this->app->get_model_object()->GetPageId($id);

				$options = array(
					array(
						'link' => 'index.php?route=pages&action=edit&id='.$page_id,
						'caption' => 'Edit Page',
						'icon' => 'img/category.png',
						),
					array(
						'link' => 'index.php?route='.MODULE_NAME.'&action=view&id='.$id,
						'caption' => 'View Category',
						'icon' => 'img/info.png',
						),
					array(
						'link' => 'index.php?route='.MODULE_NAME.'&action=delete&id='.$id,
						'caption' => 'Delete Category',
						'icon' => 'img/trash.png',
						),
					array(
						'link' => 'index.php?route='.MODULE_NAME,
						'caption' => 'Cancel',
						'icon' => 'img/stop.png',
						),
					);

				if (!$page_id) unset($options[0]);

				$data = $this->app->get_model_object()->GetOne($id);

				$import = $this->app->get_model_object()->GetCategories();

				$this->app->get_page()->set_options($options);

				$this->app->get_page()->set_content($this->app->get_view_object()->ShowForm($data, $import));
			}
		}
		else // brak uprawnień
		{
			parent::AccessDenied();
		}
	}

	public function Delete_Action()
	{
		if ($this->app->get_acl()->allowed(OPERATOR)) // są uprawnienia
		{
			parent::Delete_Action();

			$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

			if (isset($_GET['confirm']))
			{
				$result = $this->app->get_model_object()->Delete($id);

				if ($result) $this->app->get_page()->set_message(MSG_INFORMATION, 'Category has been deleted.');
				else $this->app->get_page()->set_message(MSG_ERROR, 'Category not deleted.');

				header('Location: index.php?route='.MODULE_NAME);
				exit;
			}
			else
			{
				parent::ConfirmDelete($id);
			}
		}
		else // brak uprawnień
		{
			parent::AccessDenied();
		}
	}

	public function View_Action()
	{
		if ($this->app->get_acl()->allowed(OPERATOR)) // są uprawnienia
		{
			parent::View_Action();

			$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			
			if (isset($_POST['cancel_button']))
			{
				header('Location: index.php?route='.MODULE_NAME);
				exit;
			}
			else // wczytany formularz
			{
				$options = array(
					array(
						'link' => 'index.php?route='.MODULE_NAME.'&action=edit&id='.$id,
						'caption' => 'Edit Category',
						'icon' => 'img/edit.png',
						),
					array(
						'link' => 'index.php?route='.MODULE_NAME.'&action=delete&id='.$id,
						'caption' => 'Delete Category',
						'icon' => 'img/trash.png',
						),
					array(
						'link' => 'index.php?route='.MODULE_NAME,
						'caption' => 'Cancel',
						'icon' => 'img/stop.png',
						),
					);

				$data = $this->app->get_model_object()->GetOne($id);

				$this->app->get_page()->set_options($options);

				$this->app->get_page()->set_content($this->app->get_view_object()->ShowDetails($data));
			}
		}
		else // brak uprawnień
		{
			parent::AccessDenied();
		}
	}

	public function Up_Action()
	{
		if ($this->app->get_acl()->allowed(OPERATOR)) // są uprawnienia
		{
			parent::Up_Action();

			$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

			$record = array(
				'author_id' => $this->app->get_user()->get_value('user_id'),
				'modified' => date("Y-m-d H:i:s"),
				);

			$result = $this->app->get_model_object()->MoveUp($id, $record);

			if ($result) $this->app->get_page()->set_message(MSG_INFORMATION, 'Object has been moved.');
			else $this->app->get_page()->set_message(MSG_ERROR, 'Object not moved.');

			header('Location: index.php?route='.MODULE_NAME);
			exit;
		}
		else // brak uprawnień
		{
			parent::AccessDenied();
		}
	}

	public function Down_Action()
	{
		if ($this->app->get_acl()->allowed(OPERATOR)) // są uprawnienia
		{
			parent::Down_Action();

			$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

			$record = array(
				'author_id' => $this->app->get_user()->get_value('user_id'),
				'modified' => date("Y-m-d H:i:s"),
				);

			$result = $this->app->get_model_object()->MoveDown($id, $record);

			if ($result) $this->app->get_page()->set_message(MSG_INFORMATION, 'Object has been moved.');
			else $this->app->get_page()->set_message(MSG_ERROR, 'Object not moved.');

			header('Location: index.php?route='.MODULE_NAME);
			exit;
		}
		else // No Permission
		{
			parent::AccessDenied();
		}
	}
}

?>
