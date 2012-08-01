<?php

class TB_Template{
    var $views_path;
   	var $o; // options

   	function __construct($o = array()){
   		$this->views_path = STYLESHEETPATH . '/views';
   		$this->o = $o;
   	}

	/**
	 * @param $view			this is the relative filename name of the view, without the .php extension, and
	 * 						it should be located in the $this->views_path assigned above in the construct().
	 * 						this name must comply with a certain naming scheme, examples:
	 *						- "welcome"
	 *						- "about/main_slider"
	 *						- "books/form/add"
	 * @param array $data
	 * @return string
	 */
	function get_view($view, $data=array()){
   		extract($data, EXTR_OVERWRITE);
		$view = $this->validate_view_name($view);
   		$target_fn = $this->get_view_fn($view);

   		global $post, $post_id;

   		ob_start();
   		if(file_exists($target_fn)):
   			include($target_fn);
   		else:
   			include ($this->get_view_fn('error/view_does_not_exist'));
   		endif;
   		$view = ob_get_clean();

   		if(isset($this->o['echo']) && $this->o['echo'] === false):
   			return $view;
   		else:
   			echo $view;
   		endif;
   	}

	/**
	 * get_view_fn - this function simply creates a full path name for the desired view.
	 * @param $view
	 * @return string
	 */
	function get_view_fn($view){
   		$target_fn = $this->views_path . '/' . $view . '.php';
   		return $target_fn;
   	}

	/**
	 * validate_view_name - does what its name suggests, see the comments on get_view() for the simple description.
	 * must start with a letter, followed by word characters & hyphens, and then optionally followed by a slash &
	 * more word characters, and multiples of that slash-word combo are allowed.
	 * @param $view
	 * @return string
	 */
	function validate_view_name($view){
		$allowed_filename_pattern_segment = '[a-zA-Z][\w-]+';
		$whitelist_pattern = '/^'.$allowed_filename_pattern_segment.'(\/'.$allowed_filename_pattern_segment.')*$/';
		$valid = preg_match($whitelist_pattern, $view);

		if(!$valid):
			//return 'View: ' . $view . ', pattern: ' . $valid_pattern;
			return 'error/view_does_not_exist';
		else:
			return $view;
		endif;
	}

}