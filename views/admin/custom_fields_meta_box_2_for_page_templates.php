<?php
// this page is just a middle-ish sort of thing, and also kinda acts like a controller, for fetching the content
// we want to see in the Custom Fields form. it looks at whether a template is assigned to this page,
// and then it checks whether there's an admin template for that page; and so on. read below, it's only 50 lines.
global $post, $post_ID;

//echo var_export($post->page_template, true);

// grab the page's template name, it's the filename of whatever template this page is using (if any)
$page_template_name = basename($post->page_template, '.php');
$post_type = $post->post_type;

// these are frontend template pages that have specific and unique admin templates already made
$custom_admin_templates = array(
    // TODO: create this page
    'frontend-template-page-1',
);

// these are frontend template pages that do NOT have a unique admin template, but they ARE
// allowed to see the "generic view" template (you must have one of those, of course)
$valid_templates = array(
    // TODO: add something here, in combination with below...
);

$custom_admin_post_types = array(
    // 'my_post_type', // this would be the wordpress id for your post type
    // TODO: add an example page for a custom post type
);

// this just activates some functionality give us a "view", so we can pass in some variables
$admin_tpl = new TB_Template();
$data = array(); // this gets passed to our view and then extract()'ed as $$key = $value

// dish out some content for this meta box. first let's see if we have
// a custom admin template for this template page:
if(in_array($page_template_name, $custom_admin_templates)):
    // notice: naming conventions are important, be aware. see this: the admin template name oughta be the same
    // as the frontend template name
    $admin_template_to_load = 'admin/' . $page_template_name;
    //var_dump(array($page_template_name, $data));
    //echo $admin_template_to_load;
    //return;
    return $admin_tpl->get_view($admin_template_to_load, $data);


// next we can show a generic, "nice" version, showing ALL
// the custom fields from ALL of our templates, just a big dump of 'em all
elseif(in_array($page_template_name, $valid_templates)):
    // let 'em see the generic page, here's that filename:
    // TODO: create this file
    $admin_template_to_load = 'admin/generic-custom-fields';
    return $admin_tpl->get_view($admin_template_to_load, $data);


// handle custom post types with admin templates:
elseif(in_array($post_type, $custom_admin_post_types)):
    // let 'em see the generic page, here's that filename:
    // TODO: add an example file
    $admin_template_to_load = 'admin/custom-post-type-' . $post_type;
    return $admin_tpl->get_view($admin_template_to_load, $data);


// alright, let's handle the rest: pages or whatever that we do NOT want to have access to
// our custom fields form:
else:
    ob_start(); ?>
       <p>Sorry, this content is only available for certain templates.</p>
   	<?php $html = ob_get_clean();
    echo $html;
    //echo "<pre>";
    //var_dump($post);
    //echo "</pre>";
endif;
