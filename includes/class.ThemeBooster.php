<?php

$app = new ThemeBooster();

add_action('init',              array($app,'enqueue_scripts'));
add_action('wp_print_styles',   array($app,'enqueue_stylesheets'));
add_action('widgets_init',      array($app,'register_sidebars'));
add_action('admin_init',        array($app,'add_meta_boxes'));
add_action('save_post',         array($app,'save_postdata'));

class ThemeBooster{
    var $custom_field_names = array(
        'tb_content_box_1',
        'tb_content_box_2',
        'tb_content_box_3',
        'tb_img_1',
        'tb_img_2',
        'tb_img_3',
        'tb_link_1_text',
        'tb_link_1_url',
        'tb_link_2_text',
        'tb_link_2_url',
        'tb_link_3_text',
        'tb_link_3_url',
        'tb_link_4_text',
        'tb_link_4_url',
        'tb_link_5_text',
        'tb_link_5_url',
        'tb_link_6_text',
        'tb_link_6_url',
    );

    public function get_custom_field_values($post_id=0){
        if($post_id==0) global $post_id;
        $result = array();
        foreach($this->custom_field_names as $key):
            $result[$key] = get_post_meta($post_id, $key, true);
        endforeach;
        return (object)$result;
    }

	public function enqueue_scripts(){

		$frontend_script = get_stylesheet_directory_uri() . '/js/tb_frontend.js';
		wp_register_script('tb_frontend_js' , $frontend_script);

		$admin_script = get_stylesheet_directory_uri() . '/js/tb_admin.js';
		wp_register_script('tb_admin_js' , $admin_script);

        if(!is_admin()):
            wp_enqueue_script('jquery');
            wp_enqueue_script('tb_frontend_js');
        else:
            wp_enqueue_script('tb_admin_js');
        endif;

	}

	public function enqueue_stylesheets(){
		$frontend_css = get_stylesheet_directory_uri() . '/css/tb_frontend.css';
		wp_register_style('tb_frontend_css', $frontend_css);

		$admin_css = get_stylesheet_directory_uri() . '/admin/tb_admin.css';
		wp_register_style('tb_admin_css', $admin_css);

		if(!is_admin()):
			wp_enqueue_style('tb_frontend_css');
		elseif(is_admin()):
			wp_enqueue_style('tb_admin_css');
		endif;
	}

	public function register_sidebars(){
		/*
		register_sidebar(
			array(
			'name' => 'Some Sidebar',
			'id' => 'sidebar-blog',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			)
		);
		*/
        register_sidebar(
      			array(
      			'name' => 'WP Theme Booster #1',
      			'id' => 'wp-theme-booster-1',
                'before_widget' => '<li id="%1$s" class="widget %2$s">',
                'after_widget' => '</li>',
      			'before_title' => '<h3>',
      			'after_title' => '</h3>',
      			)
        );

	}

	public function add_meta_boxes(){
        add_meta_box(
            'tb_custom_fields_meta_box_1', // panel ID
            __( 'WP Theme Booster - Custom Fields / Posts', 'tb_textdomain' ), // panel Title
            array($this,'custom_fields_meta_box_1'), // callback function, loads the actual panel
            'post' // meta box (the panel) is available to this post type
        );

        add_meta_box(
            'tb_custom_fields_meta_box_2', // panel ID
            __( 'WP Theme Booster - Custom Fields / Pages & Templates', 'tb_textdomain' ), // panel Title
            array($this,'custom_fields_meta_box_2_for_page_templates'), // callback function, loads the actual panel
            'page' // meta box (the panel) is available to this post type
        );

        /*
        add_meta_box( 'tb_custom_fields_meta_box', __( 'Custom Post Type A - Custom Fields', 'tb_textdomain' ),
            array($this,'custom_fields_meta_box'), 'custom_post_type_a' );
        add_meta_box( 'tb_custom_fields_meta_box', __( 'Custom Post Type B - Custom Fields', 'tb_textdomain' ),
            array($this,'custom_fields_meta_box'), 'custom_post_type_b' );
        */
	}

	public function custom_fields_meta_box_1(){
		$tpl = new TB_Template();
		$data = array(); // this gets sent to our view
		return $tpl->get_view('admin/custom_fields_meta_box_1', $data);
	}

    public function custom_fields_meta_box_2_for_page_templates(){
        $tpl = new TB_Template();
        $data = array();
        return $tpl->get_view('admin/custom_fields_meta_box_2_for_page_templates', $data);
    }

	public function save_postdata($post_id){
		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		$nonce_value = isset($_POST['TB_NONCE']) ? $_POST['TB_NONCE'] : '';
		if ( !wp_verify_nonce($nonce_value, 'tb_app' )):
			return $post_id;
		endif;

		// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
		// to do anything
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ):
			return $post_id;
		endif;

		// Check permissions
		if ( 'page' == $_POST['post_type'] ):
			if ( !current_user_can( 'edit_page', $post_id ) ):
			  return $post_id;
			endif;
		else:
			if ( !current_user_can( 'edit_post', $post_id ) ):
			  return $post_id;
			endif;
		endif;

        // iterate over the custom fields defined above, save 'em:
		foreach($this->custom_field_names as $known_field):
            if(isset($_POST[$known_field])):
                update_post_meta($post_id, $known_field, $_POST[$known_field]);
            endif;
		endforeach;

        return $post_id;
	}

}
