<?php
/*  Array Options:
   
   name (string)
   desc (string)
   id (string)
   type (string) - text, color, image, select, multiple, textarea, page, pages, category, categories
   value (string) - default value - replaced when custom value is entered - (text, color, select, textarea, page, category)
   options (array)
   attr (array) - any form field attributes
   url (string) - for image type only - defines the default image
    
*/

$options = array (

    array(  "name" => "Submission Form Permission Levels",
            "desc" => "Set the level of user that is allowed to submit content.",
            "id" => "submission_permissions",
            "type" => "select",
            "default_text" => "Anonymous",
            "options" => array("Members" => 1,
							   "Contributors" => 3,
							   "Authors" => 5,
							   "Editors" => 7,
							   "Administrators" => 10)
         ),

    array(  "name" => "User-Generated Content Post Status",
            "desc" => "What status do you want posts to assume once posted by users?",
            "id" => "post_status",
            "type" => "select",
            "default_text" => "Draft",
            "options" => array("Publish" => "publish")
         ),

    array(  "name" => "Email Admin For New Submissions",
            "desc" => "Do you want to send an email to the admin user when someone creates a new submission?",
            "id" => "send_email",
            "type" => "select",
            "default_text" => "No",
            "options" => array("Yes" => 1)
         ),

    array(  "name" => "Allow Descriptions?",
            "desc" => "Do you want to allow descriptions?",
            "id" => "allow_descriptions",
            "type" => "select",
            "default_text" => "No",
            "options" => array("Yes" => 1)
         ),

    array(  "name" => "Allow Image Uploads?",
            "desc" => "Do you want to allow images to be submitted with the post?",
            "id" => "allow_image_submissions",
            "type" => "select",
            "default_text" => "No",
            "options" => array("Yes" => 1)
         ),

    array(  "name" => "Allow Collections?",
            "desc" => "Do you want to allow users to add a collection?",
            "id" => "allow_collections",
            "type" => "select",
            "default_text" => "No",
            "options" => array("Yes" => 1)
         ),

    array(  "name" => "Select Collections to Allow",
            "desc" => "Select the collections you'd like to allow user gallery submissions for.",
            "id" => "include_collections",
            "type" => "taxonomy",
			"taxonomy" => "collection",
            "default_text" => "None",
            "options" => array("Yes" => 1)
         ),

    array(  "name" => "Allow Tags?",
            "desc" => "Do you want to be allow users to add tags?",
            "id" => "allow_tags",
            "type" => "select",
            "default_text" => "No",
            "options" => array("Yes" => 1)
         ),

    array(  "name" => "'User Level Too Low' Title",
            "desc" => "If a user isn't allowed to post because of user level being too low, this title explains why.",
            "id" => "user_level_denied_title",
            "type" => "text",
			"value" => "Access Denied"
         ),
	
	array(  "name" => "'User Level Too Low' Message",
            "desc" => "If a user isn't allowed to post because of user level being too low, this message explains why.",
            "id" => "user_level_denied_message",
            "type" => "text",
			"value" => "We're sorry, your user level doesn't allow submissions at this time."
         ),

    array(  "name" => "'Submission Accepted' Title",
            "desc" => "Title appears after user's submission has been accepted.",
            "id" => "submission_accepted_title",
            "type" => "text",
			"value" => "Hooray!"
         ),
	
	array(  "name" => "'Submission Accepted' Message",
            "desc" => "Message appears after user's submission has been accepted.",
            "id" => "submission_accepted_message",
            "type" => "text",
			"value" => "Your submission was received and will be reviewed soon. Thank you!"
         )

);

/* ------------ Do not edit below this line ----------- */

//Check if theme options set
global $default_check;
global $default_options;

if(!$default_check):
    foreach($options as $option):
        if($option['type'] != 'image'):
            $default_options[$option['id']] = $option['value'];
        else:
            $default_options[$option['id']] = $option['url'];
        endif;
    endforeach;
    $update_option = get_option('up_themes_'.UPTHEMES_SHORT_NAME);
    if(is_array($update_option)):
        $update_option = array_merge($update_option, $default_options);
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $update_option);
    else:
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $default_options);
    endif;
endif;

render_options($options);

?>