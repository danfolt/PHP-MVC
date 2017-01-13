<?php

class Sites_View extends View
{
	public function __construct($page)
	{
		parent::__construct($page);
	}

	public function ShowList($columns, $data)
	{
		$title = 'Pages';
		$image = 'img/32x32/home_page.png';

		$attribs = array(
			array('width' => '5%',  'align' => 'center', 'visible' => '1'),
			array('width' => '5%',  'align' => 'center', 'visible' => '0'),
			array('width' => '5%',  'align' => 'center', 'visible' => '0'),
			array('width' => '10%', 'align' => 'left',   'visible' => '0'),
			array('width' => '15%', 'align' => 'left',   'visible' => '1', 'image' => '1'),
			array('width' => '25%', 'align' => 'left',   'visible' => '1'),
			array('width' => '15%', 'align' => 'left',   'visible' => '1'),
			array('width' => '5%',  'align' => 'center', 'visible' => '1'),
			array('width' => '10%', 'align' => 'center', 'visible' => '1'),
			array('width' => '10%', 'align' => 'center', 'visible' => '0'),
			array('width' => '10%', 'align' => 'center', 'visible' => '1'),
			array('width' => '15%', 'align' => 'center', 'visible' => '1'),
		);
		
		$actions = array(
			array('action' => 'view',    'icon' => 'info.png',     'title' => 'View'),
			array('action' => 'edit',    'icon' => 'edit.png',     'title' => 'Edit'),
			array('action' => 'archive', 'icon' => 'archiver.png', 'title' => 'Archive'),
			array('action' => 'restore', 'icon' => 'archives.png', 'title' => 'Restore'),
			array('action' => 'delete',  'icon' => 'trash.png',    'title' => 'Delete'),
		);

		foreach ($data as $k => $v)
		{
			foreach ($v as $key => $value)
			{
				if ($key == 'main_page') $main_page = $value;
				if ($key == 'system_page') $system_page = $value;
			}
			if ($main_page)
			{
				$data[$k]['title'] .= ' &nbsp; <img src="img/home.png" alt="Home Page" title="Home Page">';
			}
			if ($system_page)
			{
				$data[$k]['title'] .= ' &nbsp; <img src="img/email.png" alt="Contact Page" title="Contact Page">';
			}
		}
	
		include GENER_DIR . 'list.php';

		$list_object = new ListBuilder();

		$list_object->init($title, $image, $columns, $data, $this->get_list_params(), $attribs, $actions);

		$result = $list_object->build_list();

		return $result;
	}

	public function ShowForm($data, $import, $image)
	{
		if ($data) // edycja
		{
			foreach ($data as $key => $value) 
			{
				if ($key == 'id') $main_id = $value;
				if ($key == 'main_page') $main_main_page = $value;
				if ($key == 'system_page') $main_system_page = $value;
				if ($key == 'category_id') $main_category_id = $value;
				if ($key == 'title') $main_title = $value;
				if ($key == 'contents') $main_contents = $value;
				if ($key == 'description') $main_description = $value;
				if ($key == 'visible') $main_visible = $value;
				if ($key == 'modified') $main_modified = $value;
			}
		}
		else // nowa pozycja
		{
			$main_id = NULL;
			$main_main_page = NULL;
			$main_system_page = NULL;
			$main_category_id = NULL;
			$main_title = NULL;
			$main_contents = NULL;
			$main_description = NULL;
			$main_visible = 1;
			$main_modified = NULL;
		}

		$chk = array(NULL, NULL);
		$chk[$main_visible] = 'checked';

		$main_page = $main_main_page ? 'checked' : NULL;
		$system_page = $main_system_page ? 'checked' : NULL;

		$main_contents = $image ? $main_contents . '<img src="gallery/images/'.$image.'" class="Image" />' : $main_contents;

		include GENER_DIR . 'form.php';

		$form_object = new FormBuilder();

		$form_title = $data ? 'Edit Page' : 'New Page';
		$form_image = 'img/32x32/list_edit.png';
		$form_width = '100%';
		
		$form_object->init($form_title, $form_image, $form_width);

		$action = $data ? 'edit&id=' . $main_id : 'add';

		$form_action = 'index.php?route=' . MODULE_NAME . '&action=' . $action;

		$form_object->set_action($form_action);

		$form_inputs = array(
			array(
				'caption' => 'Title', 
				'data' => array(
					'type' => 'text', 'id' => 'title', 'name' => 'title', 'value' => $main_title, 'required' => 'required',
					),
				),
			array(
				'caption' => 'Subtitle', 
				'data' => array(
					'type' => 'textarea', 'id' => 'description', 'name' => 'description', 'rows' => 2, 'value' => $main_description, 'required' => 'required',
					),
				),
			array(
				'caption' => 'Content', 
				'data' => array(
					'type' => 'textarea', 'id' => 'contents', 'name' => 'contents', 'rows' => 20, 'value' => $main_contents, 'required' => 'required',
					),
				),
			array(
				'caption' => NULL, 
				'data' => array(
					'type' => 'checkbox', 'id' => 'main_page', 'name' => 'main_page', 'label' => 'Home Page', $main_page => $main_page, 'value' => $main_main_page,
					),
				),
			array(
				'caption' => NULL, 
				'data' => array(
					'type' => 'checkbox', 'id' => 'system_page', 'name' => 'system_page', 'label' => 'Contact Page', $system_page => $system_page, 'value' => $main_system_page,
					),
				),
			array(
				'caption' => NULL, 
				'data' => array(
					'type' => 'radio', 'name' => 'visible', 
					'items' => array(
						array(
							'id' => 'active_yes', 'label' => 'Active', $chk[1] => $chk[1], 'value' => 1,
							),
						array(
							'id' => 'active_no', 'label' => 'Unactive', $chk[0] => $chk[0], 'value' => 0,
							),
						),
					),
				),
			);

		$form_object->set_inputs($form_inputs);
		
		$form_hiddens = array(
			array(
				'type' => 'hidden', 'id' => 'category_id', 'name' => 'category_id', 'value' => $main_category_id,
				),
			);
			
		$form_object->set_hiddens($form_hiddens);

		$form_buttons = array(
			array(
				'type' => 'save', 'id' => 'save_button', 'name' => 'save_button', 'value' => 'Save',
				),
			array(
				'type' => 'close', 'id' => 'update_button', 'name' => 'update_button', 'value' => 'Update',
				),
			array(
				'type' => 'cancel', 'id' => 'cancel_button', 'name' => 'cancel_button', 'value' => 'Back',
				),
			);
		
		$form_object->set_buttons($form_buttons);

		$result = $form_object->build_form();

		return $result;
	}

	public function ShowDetails($data)
	{
		include GENER_DIR . 'view.php';

		$view_object = new ViewBuilder();

		$view_title = 'Pages';
		$view_image = 'img/32x32/list_information.png';
		$view_width = '100%';
		
		$view_object->init($view_title, $view_image, $view_width);

		$view_action = 'index.php?route=' . MODULE_NAME;

		$view_object->set_action($view_action);

		$view_inputs = array();

		if (is_array($data))
		{
			foreach ($data as $key => $value) 
			{
				$view_inputs[] = array('caption' => $key, 'value' => strip_tags($value));
			}
		}

		$view_object->set_inputs($view_inputs);
		
		$view_buttons = array(
			array(
				'type' => 'cancel', 'id' => 'cancel_button', 'name' => 'cancel_button', 'value' => 'Cancel',
				),
			);
		
		$view_object->set_buttons($view_buttons);

		$result = $view_object->build_view();

		return $result;
	}

	public function ShowArchives($id, $title, $data)
	{
		include GENER_DIR . 'form.php';

		$form_object = new FormBuilder();

		$form_title = 'Restore Page';
		$form_image = 'img/32x32/archives.png';
		$form_width = '300px';
		
		$form_object->init($form_title, $form_image, $form_width);

		$form_action = 'index.php?route=' . MODULE_NAME . '&action=restore&id='.$id;

		$form_object->set_action($form_action);

		$form_items = array();

		if (is_array($data))
		{
			foreach ($data as $k => $v) 
			{
				foreach ($v as $key => $value) 
				{
					if ($key == 'id') $id = $value;
					if ($key == 'modified') $modified = $value;
				}
				$form_items[] = array('id' => $id, 'label' => $modified, 'value' => $id, 'button' => '<a href="index.php?route=sites&action=preview&id='.$id.'" class="btn btn-success btn-xs">View</a>');
			}
		}

		$form_inputs = array(
			array(
				'caption' => 'Page', 
				'data' => array(
					'type' => 'label', 'value' => $title,
					),
				),
			array(
				'caption' => 'Version', 
				'data' => array(
					'type' => 'label', 'value' => NULL,
					),
				),
			array(
				'caption' => NULL, 
				'data' => array(
					'type' => 'radio', 'name' => 'archives', 
					'items' => $form_items,
					),
				),
			);

		$form_object->set_inputs($form_inputs);
		
		$form_hiddens = array(
			array(
				'type' => 'hidden', 'id' => 'master_page_id', 'name' => 'master_page_id', 'value' => NULL,
				),
			);
			
		$form_object->set_hiddens($form_hiddens);

		$form_buttons = array(
			array(
				'type' => 'submit', 'id' => 'restore_button', 'name' => 'restore_button', 'value' => 'Restore',
				),
			array(
				'type' => 'cancel', 'id' => 'cancel_button', 'name' => 'cancel_button', 'value' => 'Cancel',
				),
			);
		
		$form_object->set_buttons($form_buttons);

		$result = $form_object->build_form();

		return $result;
	}
	
	public function ShowPage($data)
	{
		$result = NULL;

		if (is_array($data))
		{
			foreach ($data as $key => $value)
			{
				if ($key == 'contents')
				{
					$result .= $value;
				}
			}
		}

		return $result;
	}
}

?>