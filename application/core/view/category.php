<?php

class Category_View extends View
{
	public function __construct($page)
	{
		parent::__construct($page);
	}

	public function ShowPage($data)
	{
		$result = NULL;

		include GENER_DIR . 'builder.php';

		$intro_content = new Builder();

		if (is_array($data))
		{
			foreach ($data as $k => $v)
			{
				foreach ($v as $key => $value)
				{
					if ($key == 'id') $id = $value;
					if ($key == 'title') $title = $value;
                                        if ($key == 'description') $main_description = $value;
                                        if ($key == 'category_id') $cat = $value;
					if ($key == 'contents') $contents = $value;
                                        if ($key == 'user_id') $user_id = $value;
					if ($key == 'user_login') $user_login = $value;
					if ($key == 'modified') $modified = $value;
					if ($key == 'previews') $previews = $value;
					if ($key == 'skip_bar') $skip_bar = $value;
					if ($key == 'social_buttons') $soc_buttons = $value;
				}

				if (count($data) > 1) // more than 1 articles
				{
					$social_buttons = str_replace(array('{{_url_}}', '{{_title_}}'), array($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/index.php?route=page&id='.$id, $title), $soc_buttons);

					$result .= '<div class="article">';
					$result .= '<div class="article-title">';
					$result .= '<h3>' . '<a href="index.php?route=page&id='.$id.'">' . $title . '</a>' . '</h3>';
					$result .= '</div>';
					$result .= '<div class="article-timestamp">';
					$result .= '<img src="img/16x16/user.png" />' . '<a href="index.php?route=users&action=view&id='.$user_id.'">' . $user_login. '</a>';
					$result .= '<img src="img/16x16/date.png" />' . $modified;
					$result .= '<img src="img/16x16/web.png" />' . $previews;
                                        $result .= $cat;
					$result .= $social_buttons;
					$result .= '</div>';
                                        $result .= '<div class="article-white">';
                                        $result .= $main_description;
                                        $result .= '</br>';
                                        if (is_array($contents))
					{
						$result .= '<ul>';
						foreach ($contents as $element)
						{
							foreach ($element as $key => $value)
							{
								if ($key == 'caption') $caption = $value;
								if ($key == 'link') $link = $value;
							}
							$result .= '<li>'.'<a href="'.$link.'">'.$caption.'</a>'.'</li>';
						}
						$result .= '</ul>';
					}
					else
					{
						$result .= '<p>' . $intro_content->get_split_text(strip_tags($contents), 70) . '</p>';
					}
			                $result .= '</div>';
					$result .= '<div class="article-continue">';
					$result .= '<a href="index.php?route=page&id='.$id.'">Detail...</a>';
					$result .= '</div>';
					$result .= '</div>';
				}
				else // one article
				{
					$social_buttons = str_replace(array('{{_url_}}', '{{_title_}}'), array($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], $title), $soc_buttons);

					$result .= '<div class="article">';
					$result .= '<div class="article-title">';
					$result .= '<h3>' . $title . '</h3>';
					$result .= '</div>';
					$result .= '<div class="article-timestamp">';
					$result .= '<img src="img/16x16/user.png" />' . $user_login;
					$result .= '<img src="img/16x16/date.png" />' . $modified;
					$result .= '<img src="img/16x16/web.png" />' . $previews;
					$result .= $social_buttons;
					$result .= '</div>';
					$result .= '<div class="article-content">';
                                        $result .= $main_description;
                                        $result .= '</br>';
					if (is_array($contents))
					{
						$result .= '<ul>';
						foreach ($contents as $element)
						{
							foreach ($element as $key => $value)
							{
								if ($key == 'caption') $caption = $value;
								if ($key == 'link') $link = $value;
							}
							$result .= '<li>'.'<a href="'.$link.'">'.$caption.'</a>'.'</li>';
						}
						$result .= '</ul>';
					}
					else
					{
						$result .= $contents;
					}					
					$result .= '</div>';
					$result .= '</div>';
				}
			}
		}

		return $result;
	}
}

?>
