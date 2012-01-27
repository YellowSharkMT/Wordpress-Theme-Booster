<?php

class TB_Template{
    var $views_path;
   	var $o; // options

   	function __construct($o = array()){
   		$this->views_path = STYLESHEETPATH . '/views';
   		$this->o = $o;
   	}

   	function get_view($view, $data=array()){
   		extract($data, EXTR_OVERWRITE);

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

   	function get_view_fn($view){
   		$target_fn = $this->views_path . '/' . $view . '.php';
   		return $target_fn;
   	}

}
