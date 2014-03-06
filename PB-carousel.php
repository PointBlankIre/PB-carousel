<?php
/*
Plugin Name: Point Blank Carousel
Plugin URI: http://www.pointblank.ie/
Description: Declares a plugin that will create a custom post type for Carousels, copy sidebar-carousel.php into theme then use <strong> get_sidebar( 'carousel' ); </strong>  to display in your theme. Use a custom thumbnail in functions to change image size.
Version: 1.0
Author: Turlough Rynne 
Author URI: http://www.pointblank.ie/
License: GPLv2
*/

add_action( 'init', 'create_pb_carousel' );


function create_pb_carousel() {
register_post_type( 'pb_carousel',
array(
'labels' => array(
'name' => 'Carousel',
'singular_name' => 'Carousel Item',
'add_new' => 'Add New',
'add_new_item' => 'Add New Carousel Item',
'edit' => 'Edit',
'edit_item' => 'Edit Carousel Item',
'new_item' => 'New Carousel Item',
'view' => 'View',
'view_item' => 'View Carousel Item',
'search_items' => 'Search Carousel Item',
'not_found' => 'No Carousel Items found',
'not_found_in_trash' =>
'No Carousel Item found in Trash',
'parent' => 'Parent Carousel Item'
),
'public' => true,
'menu_position' => 15,
'supports' =>
array( 'title', 'thumbnail',  ),
'taxonomies' => array( '' ),
// 'menu_icon' =>
// plugins_url( 'images/image.png', __FILE__ ),
'has_archive' => true
)
);
}

add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

add_action('do_meta_boxes', 'pb_carousel_image_box');
function pb_carousel_image_box() {
	remove_meta_box( 'postimagediv', 'pb_carousel', 'side' );
	add_meta_box('postimagediv', __('Carousel Image'), 'post_thumbnail_meta_box', 'pb_carousel', 'normal', 'high');
}


add_action( 'admin_init', 'my_admin' );




function my_admin() {
add_meta_box( 'carousel_meta_box',
'Carousel Item Details',
'display_carousel_meta_box',
'pb_carousel', 'normal', 'high' ); 
}


function display_carousel_meta_box( $pb_carousel ) {
// Retrieve current URL
$url_carousel =
esc_html( get_post_meta( $pb_carousel->ID,
'url_carousel', true ) );
$desc_carousel =
esc_html( get_post_meta( $pb_carousel->ID,
'desc_carousel', true ) );

$bgcolour_carousel =
esc_html( get_post_meta( $pb_carousel->ID,
'bgcolour_carousel', true ) );

?>

<table>
<tr>
<td>Description</td>
<td><input type="textarea" size="80"
name="desc_carousel_name"
value="<?php echo $desc_carousel; ?>" placeholder="Description here..." /></td>
</tr>

<tr>
<td>Link for Carousel Item</td>
<td><input type="text" size="80"
name="url_carousel_name"
value="<?php echo $url_carousel; ?>" placeholder="http://" /></td>
</tr>

<tr>
<td>Background colour for Carousel Item</td>
<td><input type="text" size="80"
name="bgcolour_carousel_name"
value="<?php echo $bgcolour_carousel; ?>"  class="my-color-field"/></td>
</tr>

</table>

<?php }


add_action( 'save_post',
'pb_carousel_fields', 10, 2 );


function pb_carousel_fields( $pb_carousel_id,
$pb_carousel ) {
// Check post type for movie reviews
if ( $pb_carousel->post_type == 'pb_carousel' ) {
// Store data in post meta table if present in post data
if ( isset( $_POST['url_carousel_name'] ) &&
$_POST['url_carousel_name'] != '' ) {
update_post_meta( $pb_carousel_id, 'url_carousel',
$_POST['url_carousel_name'] );
}

if ( isset( $_POST['desc_carousel_name'] ) &&
$_POST['desc_carousel_name'] != '' ) {
update_post_meta( $pb_carousel_id, 'desc_carousel',
$_POST['desc_carousel_name'] );
}

if ( isset( $_POST['bgcolour_carousel_name'] ) &&
$_POST['bgcolour_carousel_name'] != '' ) {
update_post_meta( $pb_carousel_id, 'bgcolour_carousel',
$_POST['bgcolour_carousel_name'] );
}

}
}


?>
