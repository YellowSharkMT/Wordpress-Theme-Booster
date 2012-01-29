Wordpress Theme Booster
-----------------------

WP Theme Booster helps Wordpress theme developers to make admin panels in the Wordpress post/page/etc editor, in order to turn Wordpress's custom fields into a user-friendly form. You could say it helps Wordpress to be just a bit more CMS-ish. It includes functionality to enhance custom fields in the following ways:

- WYSIWYG Editor: using Wordpress's editor/media uploader
- Image Uploads: using Wordpress's Media Gallery, returns input to the field
- Link Fields: 2 input fields, one for text, one for destination URL
- Roll-your-own: you can also write your own forms, inputs, textarea, etc., and embed them into a panel.

Theme Booster relies on a very simple view library which is included, called `TB_Template`. This is ripe for renaming, as it's not much of a templating library, it's really more aptly described as being a way to force some variables into an HTML snippet, for the purposes of creating an easy way to include HTML chunks (managed in a sub-folder of your theme, called `views`)

For sake of demonstration, this is a fully-usable Wordpress theme, based off of the default TwentyEleven theme, but with virtually no frills to the frontend, aside from the necessary demo code. This means that you can download this folder, drop it into your [wordpress]/wp-content/themes directory, and it'll show up your Admin->Appearance->Themes page. To install it into an existing theme, you can simply copy over all of the files, EXCEPT:

 - functions.php (loads Them Booster, but you must edit your own, to include ThemeBooster. See ours for reference, it's easy.)
 - style.css (not needed / only for demo purposes)
 - images/ directory (not needed / only for demo purposes)
 - content.php (not needed / only for demo purposes)

ALL of the other files should have no naming conflicts with your theme. Here's the list of "important" files:

    css/
        tb_admin.css
        tb_frontend.css (empty currently, enqueued by Wordpress though))
    includes/
        class.TB_Template.php
        class.ThemeBooster.php
    js/
        tb_admin.js
        tb_frontend.js (empty currently, enqueued by Wordpress though)
    views/
        admin/
            snippets/
                field-editor.php
                field-image.php
                field-link.php
            custom_fields_meta_box_1.php (required for demo only)
            custom_fields_meta_box_2_for_page_template.php (required for demo only)
            readme.txt (not required, will contain documentation of examples in the future)
        error/
            readme.txt (not required, will contain documentation of examples in the future)
        snippets/
            readme.txt (not required, will contain documentation of examples in the future)
        post-custom-fields.php (not required, shows an example for frontend of displaying the custom fields)