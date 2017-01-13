<?php

class Categories_View extends View
{
	public function __construct($page)
	{
		parent::__construct($page);
	}

	public function ShowList($columns, $data)
	{
		$title = 'Categories';
		$image = 'img/32x32/menu.png';

		$attribs = array(
			array('width' => '5%',  'align' => 'center', 'visible' => '1'),
			array('width' => '8%',  'align' => 'center', 'visible' => '1'),
			array('width' => '5%',  'align' => 'center', 'visible' => '1'),
			array('width' => '5%',  'align' => 'center', 'visible' => '1'),
			array('width' => '5%',  'align' => 'center', 'visible' => '1'),
			array('width' => '15%', 'align' => 'left',   'visible' => '1'),
			array('width' => '15%', 'align' => 'left',   'visible' => '1'),
			array('width' => '10%', 'align' => 'left',   'visible' => '0'),
			array('width' => '10%', 'align' => 'left',   'visible' => '0'),
			array('width' => '5%',  'align' => 'center', 'visible' => '0'),
			array('width' => '10%', 'align' => 'center', 'visible' => '1'),
			array('width' => '10%', 'align' => 'center', 'visible' => '1'),
			array('width' => '15%', 'align' => 'center', 'visible' => '1'),
		);
		
		$actions = array(
			array('action' => 'up',     'icon' => 'move_up.png',   'title' => 'Move Up'),
			array('action' => 'down',   'icon' => 'move_down.png', 'title' => 'Move down'),
			array('action' => 'view',   'icon' => 'info.png',      'title' => 'View'),
			array('action' => 'edit',   'icon' => 'edit.png',      'title' => 'Edit'),
			array('action' => 'delete', 'icon' => 'trash.png',     'title' => 'Delete'),
		);
	
		include GENER_DIR . 'list.php';

		$list_object = new ListBuilder();

		$list_object->init($title, $image, $columns, $data, $this->get_list_params(), $attribs, $actions);

		$result = $list_object->build_list();

		return $result;
	}

	public function ShowForm($data, $import)
	{
		if ($data) // edycja
		{
			foreach ($data as $key => $value) 
			{
				if ($key == 'id') $main_id = $value;
				if ($key == 'parent_id') $main_parent_id = $value;
				if ($key == 'section') $main_section = $value;
				if ($key == 'permission') $main_permission = $value;
				if ($key == 'caption') $main_caption = $value;
				if ($key == 'link') $main_link = $value;
				if ($key == 'visible') $main_visible = $value;
				if ($key == 'target') $main_target = $value;
				if ($key == 'login_name') $main_login = $value;
				if ($key == 'modified') $main_modified = $value;
			}
		}
		else // nowa pozycja
		{
			$main_id = NULL;
			$main_parent_id = NULL;
			$main_section = 1;
			$main_permission = 4;
			$main_caption = NULL;
			$main_link = DEFAULT_LINK;
			$main_visible = 1;
			$main_target = NULL;
			$main_login = NULL;
			$main_modified = NULL;
		}

		$sec = array(1 => NULL, 2 => NULL);
		$sec[$main_section] = 'checked';

		$sel = array();
		$categories = array();

		$categories[] = array(
			'value' => 0, 'caption' => '(root)',
			);

		foreach ($import as $k => $v) 
		{
			foreach ($v as $key => $value)
			{
				if ($key == 'id') $parent_id = $value;
				if ($key == 'caption') $caption = $value;
			}
			$sel[$parent_id] = $parent_id == $main_parent_id ? 'selected' : NULL;
			$categories[] = array(
				'value' => $parent_id, 'caption' => $caption, $sel[$parent_id] => $sel[$parent_id],
				);
		}

		$sel = range(0, 5);
		$sel[$main_permission] = 'selected';

		$chk = array(NULL, NULL);
		$chk[$main_visible] = 'checked';

		$target = $main_target ? 'checked' : NULL;

		include GENER_DIR . 'form.php';

		$form_object = new FormBuilder();

		$form_title = $data ? 'Edit Category' : 'New Category';
		$form_image = 'img/32x32/list_edit.png';
		$form_width = '100%';
		
		$form_object->init($form_title, $form_image, $form_width);

		$action = $data ? 'edit&id=' . $main_id : 'add';

		$form_action = 'index.php?route=' . MODULE_NAME . '&action=' . $action;

		$form_object->set_action($form_action);

		$form_inputs = array(
			array(
				'caption' => 'Section (Menus)', 
				'data' => array(
					'type' => 'radio', 'name' => 'section', 
					'items' => array(
						array(
							'id' => 'section_navbar', 'label' => 'Main Navigation (góra)', $sec[1] => $sec[1], 'value' => 1,
							),
						array(
							'id' => 'section_category', 'label' => 'Categories List (bok)', $sec[2] => $sec[2], 'value' => 2,
							),
						),
					),
				),
			array(
				'caption' => 'Placement', 
				'data' => array(
					'type' => 'select', 'id' => 'parent_id', 'name' => 'parent_id', 
					'option' => $categories, 
					),
				),
			array(
				'caption' => 'Text (menu)', 
				'data' => array(
					'type' => 'text', 'id' => 'caption', 'name' => 'caption', 'value' => $main_caption, 'required' => 'required',
					),
				),
			array(
				'caption' => 'Link (link)', 
				'data' => array(
					'type' => 'text', 'id' => 'link', 'name' => 'link', 'value' => $main_link, 'required' => 'required',
					),
				),
			array(
				'caption' => 'Access by user profile', 
				'data' => array(
					'type' => 'select', 'id' => 'permission', 'name' => 'permission', 
					'option' => array(
						array(
							'value' => '1', 'caption' => '1 (administrator)', $sel[1] => $sel[1],
							),
						array(
							'value' => '2', 'caption' => '2 (operator)', $sel[2] => $sel[2],
							),
						array(
							'value' => '3', 'caption' => '3 (visitor)', $sel[3] => $sel[3],
							),
						array(
							'value' => '4', 'caption' => '4 (all, guests)', $sel[4] => $sel[4],
							),
						), 
					),
				),
			array(
				'caption' => NULL, 
				'data' => array(
					'type' => 'checkbox', 'id' => 'target', 'name' => 'target', 'label' => 'Open in another window', $target => $target, 'value' => NULL,
					),
				),
			array(
				'caption' => NULL, 
				'data' => array(
					'type' => 'radio', 'name' => 'active', 
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
		
		$form_hiddens = array();
			
		$form_object->set_hiddens($form_hiddens);

		$form_buttons = array(
			array(
				'type' => 'save', 'id' => 'save_button', 'name' => 'save_button', 'value' => 'Save',
				),
			array(
				'type' => 'close', 'id' => 'update_button', 'name' => 'update_button', 'value' => 'Close',
				),
			array(
				'type' => 'cancel', 'id' => 'cancel_button', 'name' => 'cancel_button', 'value' => 'Cancel',
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

		$view_title = 'Category';
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
				$view_inputs[] = array('caption' => $key, 'value' => $value);
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
}

?>
