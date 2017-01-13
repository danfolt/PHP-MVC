<?php

class Admin_Controller extends Controller
{
	public function __construct($app)
	{
		parent::__construct($app);
		
		$this->app->get_page()->set_path(array(
			'index.php' => 'Admin Page',
			'index.php?route=admin' => 'Admin Panel',
			));
	}
	
	public function Index_Action()
	{
		if ($this->app->get_acl()->allowed(FREE)) // są uprawnienia
		{
			$options = array(
				array(
					'link' => 'index.php?route=logout',
					'caption' => 'Logout',
					'icon' => 'img/logout.png',
					),
				array(
					'link' => 'index.php',
					'caption' => 'Cancel',
					'icon' => 'img/stop.png',
					),
				);

			$data = array(
				array('group' => 'System Management', 'elements' => array(
						array(
							'profile' => ADMIN,
							'caption' => 'Config ('.$this->app->get_model_object()->GetTableCount('Configuration').')', 
							'link' => 'index.php?route=config', 
							'icon' => '14.png',
							),
						array(
							'profile' => ADMIN,
							'caption' => 'Templates ('.$this->app->get_model_object()->GetFileLines('Template', $this->app->get_page()->get_layout()).')', 
							'link' => 'index.php?route=template', 
							'icon' => '49.png',
							),
						array(
							'profile' => ADMIN,
							'caption' => 'CSS styles ('.$this->app->get_model_object()->GetFileLines('Style CSS', $this->app->get_page()->get_layout()).')', 
							'link' => 'index.php?route=style', 
							'icon' => '44.png',
							),
                                                array(
							'profile' => ADMIN,
							'caption' => 'Javascripts ('.$this->app->get_model_object()->GetFileLines('Javascript', $this->app->get_page()->get_layout()).')', 
							'link' => 'index.php?route=script', 
							'icon' => '55.png',
							),
	                                        ),
					),
				array('group' => 'Users Management', 'elements' => array(                        
						array(
							'profile' => USER,
							'caption' => 'Users ('.$this->app->get_model_object()->GetTableCount('Users').')', 
							'link' => 'index.php?route=users', 
							'icon' => '07.png',
							),
                                               
						array(
							'profile' => ADMIN,
							'caption' => 'Roles ('.$this->app->get_model_object()->GetTableCount('Roles').')', 
							'link' => 'index.php?route=roles', 
							'icon' => '09.png',
							),
						),
					),
				array('group' => 'Content Management', 'elements' => array(
						array(
							'profile' => OPERATOR,
							'caption' => 'Categories ('.$this->app->get_model_object()->GetTableCount('Category').')', 
							'link' => 'index.php?route=categories', 
							'icon' => '29.png',
							),
						array(
							'profile' => OPERATOR,
							'caption' => 'Posts ('.$this->app->get_model_object()->GetTableCount('Posts').')', 
							'link' => 'index.php?route=pages', 
							'icon' => '02.png',
							),
						array(
							'profile' => OPERATOR,
							'caption' => 'Pages ('.$this->app->get_model_object()->GetTableCount('Pages').')', 
							'link' => 'index.php?route=sites', 
							'icon' => '04.png',
							),
						array(
							'profile' => OPERATOR,
							'caption' => 'Media ('.$this->app->get_model_object()->GetTableCount('Media').')', 
							'link' => 'index.php?route=images', 
							'icon' => '23.png',
							),
						),
					),
                     
				array('group' => 'Reports Management', 'elements' => array(
						array(
							'profile' => OPERATOR,
							'caption' => 'Emails ('.$this->app->get_model_object()->GetTableCount('Messages').')', 
							'link' => 'index.php?route=messages&mode=1', 
							'icon' => '10.png',
							),
						array(
							'profile' => OPERATOR,
							'caption' => 'Searches ('.$this->app->get_model_object()->GetTableCount('Searches').')', 
							'link' => 'index.php?route=searches', 
							'icon' => '27.png',
							),
						array(
							'profile' => OPERATOR,
							'caption' => 'Logins ('.$this->app->get_model_object()->GetTableCount('Login').')', 
							'link' => 'index.php?route=logins', 
							'icon' => '26.png',
							),
						array(
							'profile' => ADMIN,
							'caption' => 'Visitors ('.$this->app->get_model_object()->GetTableCount('Visitors').')', 
							'link' => 'index.php?route=visitors', 
							'icon' => '24.png',
							),
						),
					),
				);

			unset($_SESSION['last_url']);
			unset($_SESSION['form_fields']);
			unset($_SESSION['form_failed']);

			$this->app->get_page()->set_options($options);

			$user = $this->app->get_user();

			$this->app->get_page()->set_content($this->app->get_view_object()->ShowPage($data, $user));

			$layout = $this->app->get_settings()->get_config_key('page_template_admin');

			$this->app->get_page()->set_layout($layout);

			$this->app->get_page()->set_template('admin');
		}
		else // brak uprawnień
		{
			parent::AccessDenied();
		}
	}
}

?>
