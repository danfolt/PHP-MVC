<?php

class Page_View extends View
{
	public function __construct($page)
	{
		parent::__construct($page);
	}

	public function ShowPage($data)
	{
		$result = NULL;

		if (is_array($data))
		{
			foreach ($data as $key => $value)
			{
				if ($key == 'title') $title = $value;
				if ($key == 'contents') $contents = $value;
				if ($key == 'user_login') $user_login = $value;
				if ($key == 'modified') $modified = $value;
				if ($key == 'previews') $previews = $value;
				if ($key == 'social_buttons') $social_buttons = $value;
			}

			$social_buttons = str_replace(array('{{_url_}}', '{{_title_}}'), array($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], $title), $social_buttons);

			$result .= '<div class="article">';
			$result .= '<div class="article-title">';
			$result .= '<h1>' . $title . '</h1>';
			$result .= '</div>';
			$result .= '<div class="article-timestamp">';
			$result .= '<img src="img/16x16/user.png" />' . $user_login;
			$result .= '<img src="img/16x16/date.png" />' . $modified;
			$result .= '<img src="img/16x16/web.png" />' . $previews;
			$result .= $social_buttons;
			$result .= '</div>';
			$result .= '<div class="article-content">';
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

		return $result;
	}
}

?>
