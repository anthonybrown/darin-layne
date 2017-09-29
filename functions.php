<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

register_post_type("lessons",
	array(
		"labels" => array(
			'name' => __("Lessons"),
			'singular_name' => __("Lesson")
		),
		"capability_type" => "post",
		"public" => true,
		"has_archive" => true,
		"rewrite" => true,
		"supports" => array(
			"slug" => "lesson_post",
			"custom-fields",
			"title",
			"thumbnail",
			"editor",
			"page-attributes",
			"comments",
		)
	)
);
register_taxonomy("lessons_tax", "lessons",
	array(
		"label" => __("Lessons Categories"),
		"rewrite" => true,
		"show_ui" => true,
		"show_admin_column" => true,
		"hierarchical" => true,
	)
);

add_action( 'add_meta_boxes', 'lessonsCustomFieldsBox');
add_action( 'save_post', 'lessonsSaveCustomFieldsBox' );
function lessonsCustomFieldsBox() {
	add_meta_box('lessonsMeta', __( 'Lessons Extra Details', 'lessonsMeta' ), 'lessonsMetaFieldsBox' , 'lessons' );
}
function lessonsMetaFieldsBox($post){
	$fields = array(
		array('label' => 'Read Pdf' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'readpdf', true) , 'name' => 'readpdf'),
		array('label' => 'Mp3 Download' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'mpdownload', true) , 'name' => 'mpdownload'),
		array('label' => 'Read Tiff' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'readtiff', true) , 'name' => 'readtiff'),
		array('label' => 'Read Jpg' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'readjpg', true) , 'name' => 'readjpg'),
	);
?>
<table width="100%">
    <?php
      foreach($fields as $f){
		if($f['type'] == 'text'){
	?>
			<tr>
				<td width="25%"><?=$f['label'];?></td>
                <td width="70%"><input style="width:100%"; type="text" name="<?php echo $f['name'];?>" value="<?php echo $f['value'];?>" /></td>
            </tr>
        <?php
        }
		elseif($f['type'] == 'textarea'){
	?>
			<tr>
				<td width="25%"><?=$f['label'];?></td>
                <td width="70%"><textarea style="width:100%"; rows="5" name="<?php echo $f['name'];?>"><?php echo $f['value'];?></textarea></td>
            </tr>
	<?php
		}
	  }
	?>
</table>
<?php
}function lessonsSaveCustomFieldsBox( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
//  if ( !wp_verify_nonce( $_POST['rp_noncename'], plugin_basename( __FILE__ ) ) )
 //     return;
  if ( 'lessons' == $_POST['post_type'] ){
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
		$fields = array(
			array('label' => 'Read Pdf' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'readpdf', true) , 'name' => 'readpdf'),
			array('label' => 'Mp3 Download' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'mpdownload', true) , 'name' => 'mpdownload'),
			array('label' => 'Read Tiff' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'readtiff', true) , 'name' => 'readtiff'),
			array('label' => 'Read Jpg' , 'type' => 'text' , 'value' => get_post_meta($post->ID , 'readjpg', true) , 'name' => 'readjpg'),
		);
		foreach($fields as $f){
			update_post_meta($post_id, $f['name'] , $_POST[$f['name']]);
		}
  }
}
add_image_size('lessonsthumb',960,760,true);

function get_the_twitter_excerpt(){
$excerpt = get_the_content();
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$the_str = substr($excerpt, 0, 80);
return $the_str;
}


if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}
