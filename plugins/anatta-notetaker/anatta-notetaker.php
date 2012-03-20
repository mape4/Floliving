<?php
/*
Plugin Name: Anatta NoteTaker (Ajax-ified)
Plugin URI: http://geek.1bigidea.com/wordpress/plugins/ajax-notetaker
Description: Logged-in Users can make notes on post-single pages. The note taking area is inserted via template_tag. There is also support for a widget that recaps the user's notes with links back to the related post
Version: 1.0
Author: Tom Ransom
Author URI: http://1bigidea.com
Network Only: false

Copyright 2011 Tom Ransom (email: transom@1bigidea.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

class AnattaNoteTaker {
	var $debug_flag = false;
	
	var $plugin_slug = "AnattaNoteTaker";
	var $plugin_name = "Anatta NoteTaker";
	var $plugin_version = "1.0";
	
	public static $custom_post_type = 'anatta_notes';
	public static $option_name = 'anatta_notetaker';
	public static $p2p_connection = 'anatta_notes_links';
	public static $empty_list_id = 'anatta_note_lesson_empty';
	public $empty_list_title;

	var $connections = array();
	var $ajax_action = 'notetaker_save';
	var $erase_action = 'erase_note';
	
	public $plugin_options = array();
	public $settings_fields = 'anatta_notetaker_settings';
	public $settings_section = 'anatta_notetaker_cpts';
	public $settings_page_name = 'anatta_settings';
	private $settings_page_uri;
	
	public $current_post;
	public $current_user;

	function AnattaNoteTaker(){ $this->__construct(); }
	function __construct() {
		register_activation_hook(   __FILE__, array( __CLASS__, 'activate'   ) );
		register_deactivation_hook( __FILE__, array( __CLASS__, 'deactivate' ) );
		
		add_action('init', array($this, 'init'));
		add_action('init', array($this, 'register_connections'), 110);
		add_action('admin_init', array($this, 'admin_init'));
		add_action('admin_menu', array($this, 'admin_add_submenu_item'));
		
		$this->supported_post_types = array('anatta_lessons');
		
		$this->settings_page_uri = 'edit.php?post_type='.self::$custom_post_type;
		
		$this->empty_list_title = __('No Notes Found', 'floliving');
	}
	function __destruct(){
	}
	function activate() {
		// Add options, initiate cron jobs here
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );

		$options = get_option(self::$option_name, array());
		if( !is_array($options) )
			update_option(self::$option_name, array());
	}
	function deactivate() {
		// Remove cron jobs here
	}
	function uninstall() {
		// Delete options here
		delete_option(self::$option_name);
	}
	/*
	 *	Functions below actually do the work
	 */
	function init(){

		$this->plugin_options = get_option(self::$option_name); // this is an array with the options for this plugin

		add_action('wp_ajax_'.$this->ajax_action, array($this, 'handle_save_request'));
		add_action('wp_ajax_'.$this->erase_action, array($this, 'handle_erase_request'));
		$this->register_cpt_anatta_notes();
		$this->register_connections();
		
		if( is_admin() ) return;
		
		add_action('wp', array($this, 'traffic_cop'));

	}
	function traffic_cop(){
		global $wp_query, $current_user;
		
		if( !is_singular($this->plugin_options['cpts']) ) return;

		/**
		 *	This is a single page with a Custom Post Type that is supposed to have a notetaker
		 */
		
		// ok - so what post are we on?
		$this->current_post = $wp_query->post;
		$this->current_user = $current_user;

		// Is there are note(s) already on file for this post?
		
		$this->connected_posts = new WP_Query(array(
			'connected_type'	=> AnattaNoteTaker::$p2p_connection,
			'connected_items'	=> $this->current_post->ID,
			'author'			=> $this->current_user->ID,
		));
		
		wp_enqueue_style('notetaker-css', plugins_url('css/buttons.css', __FILE__));
		wp_enqueue_script('notetaker', plugins_url('js/anatta_notetaker.js', __FILE__), array('jquery', 'wp-ajax-response'));
		wp_localize_script('notetaker', 'floliving_notetaker', $this->set_js_variables() );

		// http://www.ericmmartin.com/projects/simplemodal/
		wp_enqueue_style('confirm-css', plugins_url('css/confirm.css', __FILE__));
		wp_enqueue_script('simplemodal', plugins_url('js/jquery.simplemodal.1.4.1.min.js', __FILE__, array('jquery')));
		
		//http://vadikom.com/tools/poshy-tip-jquery-plugin-for-stylish-tooltips/
		wp_enqueue_script('poshytip', plugins_url('js/jquery.poshytip/jquery.poshytip.min.js', __FILE__, array('jquery')));
		wp_enqueue_style('poshytip-css', plugins_url('js/jquery.poshytip/tip-yellow/tip-yellow.css', __FILE__));
		

	}
	function set_js_variables(){
		$note_id = 0;
		if( $this->is_note_attached() ) $note_id = $this->connected_posts->post->ID;
		
		return array(
			'post_id'	=> $this->current_post->ID,
			'note_id'	=> $note_id,
			'user'		=> $this->current_user->ID,
			'action'	=> $this->ajax_action,
			'erase_action'	=> $this->erase_action,
			'empty_list'	=> AnattaNoteTaker::$empty_list_id,
			'Ajax_url'	=> admin_url('admin-ajax.php'),
			'texts'		=> array(
				'confirm'	=> __('Are you sure you want to delete this note?', 'floliving'),
				'saving'	=> __('Saving', 'floliving').'&hellip;',
				'erasing'	=> __('Erasing', 'floliving').'&hellip;',
				'no_notes'	=> $this->empty_list_title
			)
		);
	}
	function register_cpt_anatta_notes() {
	
		$labels = array( 
			'name' => _x( 'Notes', 'floliving' ),
			'singular_name' => _x( 'note', 'floliving' ),
			'add_new' => _x( 'Add New', 'floliving' ),
			'add_new_item' => _x( 'Add New Note', 'floliving' ),
			'edit_item' => _x( 'Edit Note', 'floliving' ),
			'new_item' => _x( 'New Note', 'floliving' ),
			'view_item' => _x( 'View Note', 'floliving' ),
			'search_items' => _x( 'Search Notes', 'floliving' ),
			'not_found' => _x( 'No notes found', 'floliving' ),
			'not_found_in_trash' => _x( 'No notes found in Trash', 'floliving' ),
			'parent_item_colon' => _x( 'Parent note:', 'floliving' ),
			'menu_name' => _x( 'Notes', 'floliving' ),
		);
	
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('Registered customer can make notes relative to a lesson and review the notes', 'floliving'),
			'supports' => array( 'title', 'editor', 'excerpt', 'author' ),
			
			'public' => false,
			'show_ui' => $this->debug_flag,
			
			'show_in_nav_menus' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => false,
			'capability_type' => 'post'
		);
	
		register_post_type( self::$custom_post_type, $args );
		
	}
	function register_connections(){
		
		if( !function_exists('p2p_register_connection_type') ) return;

		p2p_register_connection_type( array(
			'name'	=> self::$p2p_connection,
			'to'	=> self::$custom_post_type,
			'from'	=> $this->plugin_options['cpts'],
			'fields'=>array(
				'author'	=> 'Author'
			),
			'admin_box'	=> $this->debug_flag
		) );			
	}
	function insert_notefield(){
		global $current_user;
		
		$message = '';
		$button_content = __('', 'floliving');
		$post_id = get_queried_object_id(); // the id of the current single post
		$user_id = $this->connected_posts->post->post_author;
		
		if( $this->is_note_attached() ){
		
			$message = $this->connected_posts->post->post_content;
			$button_content = __('', 'floliving');
		}
		$cur_user = $current_user->ID;
?>
		<div id='anatta_notetaker'>
        <form id="anatta_notetaker_form" method="POST">
				<?php echo wp_nonce_field('floliving_notetaker_update_'.$post_id, '_notetaker_nonce', true, false); ?>
				<label for="anatta_textfield_input">Keep Your Notes</label>
				<textarea style="display:block; width:90%;resize:none;padding:0;margin:0;" id="anatta_textfield_input" class="anatta_textarea" rows="8" cols="20" name="anatta_textfield_input" title="Save notes about this lesson"><?php //if($cur_user == $user_id) {  echo $message; } else { }
				echo $message; ?></textarea>
				<div style="text-align:right;padding-top:1em;">
					<span style="width: 80%;" id="anatta_textfield_status"></span>
					<a id="save_note" class="button blue" title="Save your note on this lesson"><?php echo $button_content; ?></a>
					<a id="erase_note" class="button red" title="Erase your note on this lesson"><?php _e('', 'floliving'); ?></a>
				</div>
				</form>
		</div>
		<!-- modal content -->
		<div id='confirm'>
			<div class='header'><span>Confirm</span></div>
			<div class='message'></div>
			<div class='buttons'>
				<div class='no simplemodal-close'>No</div><div class='yes'>Yes</div>
			</div>
		</div>
<?php
	}
	/**
	 *	This section handles the actions from the ajax save action
	 */
	function handle_erase_request(){
		global $current_user;
		
		//Get the form fields
		$post_id = intval($_POST['post_id']);
		$user_id = intval($_POST['user_id']);

		check_ajax_referer('floliving_notetaker_update_'.$post_id);

		//Get post data
		if ( !isset( $_POST['ajax_form_data'] ) ) die("-1");
		parse_str( $_POST['ajax_form_data'], $form_data );
		
		// one more security check
		if( $current_user->ID != $_POST['user_id'] ) die("-1");
		
		// Get the related Note for this post
		$related = p2p_type( AnattaNoteTaker::$p2p_connection )->get_connected( $post_id );
		$note_id = $related->post->ID; // this should be the ID of the note attached to this post
		
		/**
		 *	Share the good news with the browser
		 */
		$error_response = $success_response = new WP_Ajax_Response();
		$errors = new WP_Error();
		
		//If any further errors, send response
		if ( count ( $errors->get_error_codes() ) > 0 ) {
			$error_response->add(array(
					'what' => 'errors',
					'id' => $errors
			));
			$error_response->send();
			exit;
		}

		/**
		 *	Delete the note
		 */
		$post = get_post($post_id);
		 
		$note = array(
			'ID'		=> $note_id,
			'post_id' 	=> $post_id,
			'note_id'	=> $note_id,
			'title' 	=> $post->post_title, 
			'permalink' => $permalink, 
			'message' 	=> $message,
			'excerpt'	=> Anatta_Note_Manager::excerpt($message)
		);

		 Anatta_Note_Manager::delete_note($post_id, $note);

		//Send back a response
		$success_response->add(array(
					'what' => 'object',
					'data' => __('Note Erased', 'floliving'),
					'supplemental' => array(
//						'html' => Anatta_Note_Manager::read_note($note_id, 'html')
						'widget_id'	=> Anatta_Note_Manager::note_id($note)
					)
		));
		$success_response->send();		

		exit; // clean getaway;
	}

	function handle_save_request(){
		global $current_user;
		
		//Get the form fields
		$message = sanitize_text_field( $_REQUEST['message'] );
		$post_id = intval($_POST['post_id']);
		$user_id = intval($_POST['user_id']);

		check_ajax_referer('floliving_notetaker_update_'.$post_id);

		//Get post data
		if ( !isset( $_POST['ajax_form_data'] ) ) die("-1");
		parse_str( $_POST['ajax_form_data'], $form_data );
		
		// one more security check
		if( $current_user->ID != $_POST['user_id'] ) die("-1");
		
		/**
		 *	Share the good news with the browser
		 */
		$error_response = $success_response = new WP_Ajax_Response();
		$errors = new WP_Error();
		
		//If any further errors, send response
		if ( count ( $errors->get_error_codes() ) > 0 ) {
			$error_response->add(array(
					'what' => 'errors',
					'id' => $errors
			));
			$error_response->send();
			exit;
		}

		/**
		 *	Prepare content for saving as custom post type
		 */
		$post = get_post($post_id);
		$permalink = get_permalink($post_id);
		
		$connections = new WP_Query(array(
			'connected_type'	=> AnattaNoteTaker::$p2p_connection,
			'connected_items'	=> $post_id,
			'author'			=> $current_user->ID,
		));
		
		$note = array(
			'post_id' 	=> $post_id,
			'note'		=> null,
			'title' 	=> $post->post_title, 
			'permalink' => $permalink, 
			'message' 	=> $message,
			'excerpt'	=> Anatta_Note_Manager::excerpt($message)
		);

		if( $connections->found_posts > 0 ){
			$note['note'] = $connections->post;
			$note_found = true;
			$result = Anatta_Note_Manager::update_note($post_id, $user_id, $note);
		} else {
			$note_found = false;
			$result = Anatta_Note_Manager::write_note($post_id, $user_id, $note);
		}
		 

		//Send back a response
		$success_response->add(array(
					'what' => 'object',
					'data' => __('Note Saved.', 'floliving'),
					'supplemental' => array(
						'html'	=> $result['content'],
						'widget_id' => $result['widget_id']
					)
		));
		$success_response->send();		

		exit; // clean getaway;
	}
/**
 *		ADMINISTRATIVE FUNCTIONS
 */
	function admin_init(){
	
		add_filter( 'plugin_action_links', array($this, 'plugin_action_links'), 10, 2 );
		
		register_setting( $this->settings_fields, self::$option_name, array($this, 'validate_options') );
		add_settings_section( $this->settings_section, __('Select Custom Post Types that support Notes', 'floliving'), array($this, 'setup_settings_section'), $this->settings_page_name);
		add_settings_field('cpts_supported', 'Post Types Supported', array($this,'list_post_types'), $this->settings_page_name, $this->settings_section);
	}
	function admin_add_submenu_item() {
	    add_submenu_page($this->settings_page_uri, 'Add Notes to Post Types', 'Settings', 'manage_options', 'anatta_notetaker', array($this,'render_settings_form'));
	}
	function setup_settings_section(){
?>
		<p><?php _e('Check the Post Types that may have note fields', 'floliving'); ?></p>
		<p><?php _e('For the "checked" post types below, you can save notes by including the template tag in the single.php file.', 'floliving'); ?></p>
<?php
	}
	function list_post_types($args){
		$not_applicable = array('revision','nav_menu_item','mediapage',self::$custom_post_type);
	
		$args = array(
			'public'	=> true
		);
		$operator = 'and';
		$output = 'name'; // or object
		$cpts = get_post_types($args, $output, $operator);

		foreach( $cpts as $custom_post_type => $post_object ){
			if( in_array( $custom_post_type, $not_applicable ) ) continue;
			$checked = '';
			if( in_array( $custom_post_type, $this->plugin_options['cpts']) ) $checked = ' checked="checked" ';
?>
			<input type="checkbox" name="<?php echo self::$option_name; ?>[cpts][]" id="notes_<?php echo $custom_post_type; ?>" <?php echo $checked; ?> value="<?php echo $custom_post_type; ?>" />
			<label for="notes_<?php echo $custom_post_type; ?>"><?php echo $post_object->labels->name; ?></label><br />
<?php
		}
	}
	// Render the Plugin options form
	function render_settings_form() {
?>
		<div class="wrap">
			
			<!-- Display Plugin Icon, Header, and Description -->
			<div class="icon32" id="icon-options-general"><br></div>
			<h2><?php _e('Manage Anatta NoteTaker', 'floliving'); ?></h2>
			<!-- Beginning of the Plugin Options Form -->
			<form method="post" action="options.php">
				<?php settings_fields($this->settings_fields); ?>
				<?php do_settings_sections($this->settings_page_name); ?>
				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
		</div>
<?php	
	}
	
	// Sanitize and validate input. Accepts an array, return a sanitized array.
	function validate_options($input) {
		return $input;
	}
	/**
	 * plugin_action_links
	 * 
	 * Add direct link to plugin settings on plugins.php
	 * 
	 * @param $links array Default links passed in by filter
	 * @param $file
	 * @return $links array Modified links to display below the plugin
	 */
	function plugin_action_links( $links, $file ) {
	
		if ( $file == plugin_basename( __FILE__ ) ) {
			$settings_links = '<a href="'.get_admin_url().$this->settings_page_uri.'&page=anatta_notetaker">'.__('Settings').'</a>';
			// make the 'Settings' link appear first
			array_unshift( $links, $settings_links );
		}
	
		return $links;
	}
	function is_note_attached(){
		return ($this->connected_posts->found_posts > 0);
	}
}

if( class_exists('AnattaNoteTaker') ){
	global $Anatta_Note_Taker;
	$Anatta_Note_Taker = new AnattaNoteTaker;

	function anatta_notetaker(){
		global $Anatta_Note_Taker;
		
		$options = get_option($Anatta_Note_Taker->option_name);
		if( !is_singular($options['cpts']) ) return;

		$current_query = get_queried_object();

		echo '<div id="anatta_notefield">';
		
		if( is_user_logged_in() ){
			$Anatta_Note_Taker->insert_notefield();
		} else {
			echo '<h3>'.__('Registered Users can keep personal notes with each lesson', 'floliving').'</h3>';
		}
		
		echo '</div>';
	}
}

class Anatta_Note_Manager{
	function _construct(){}
	function read_note($post_id, $return=false){
		$message = "Nostissi modignis aenean praesent vendipissit. Sismolore quis iscipit, dionull ationullaoret facipsu hac, veros exercillaore illuptatie auctor. Natoque tincidunt odigna modipsustie lut nisl ullutpat netus consequ, dolore lutat dolobore.";
		$note = array(
			'post_id' => '41', 
			'title' => 'deep fry', 
			'permalink' => '#', 
			'message' => $message,
			'excerpt'	=> self::excerpt($message)
		);
		if( 'array' == $return ) return $note;
		
		return self::format_as_html($note);
	}
	function format_as_html($post){
		// Find the post connected to this note
		$related = p2p_type( AnattaNoteTaker::$p2p_connection )->get_connected( $post->ID );

		return array(
			'content' =>  '
				<li id="'.self::note_id($post).'" class="show-tip" title="'.esc_html($post->post_content).'">
					<big><a href="'.get_permalink($related->post->ID).'">'.$related->post->post_title.'</a></big>
					<p>'.self::excerpt($post->post_content).'</p>
				</li>',
			'widget_id' => self::note_id($post),
			'post_author'=> self::author_id($post)
		);
		unset($related);
	}
	function note_id($post){
		if( is_object($post) )
			return 'anatta_note_lesson_'.$post->ID;
		if( is_array($post) )
			return 'anatta_note_lesson_'.$post['ID'];
	}
	function author_id($post)
	{
		return $post->post_author;
	}
	
	function update_note($post, $user_id, $note){
	
		$the_note = get_post( $note['note']->ID, ARRAY_A, 'edit');
		$the_note['post_content'] = $note['message'];
		
		wp_update_post($the_note);
		
		return Anatta_Note_Manager::format_as_html((object) $the_note);
	}
	function write_note($post_id, $user_id, $note){
		// Build the post
		$post_it_note = array(
				'post_status' 	=> 'publish',
				'post_type' 	=> AnattaNoteTaker::$custom_post_type,
				'post_author' 	=> $user_id,
				'ping_status' 	=> false,
				'post_parent' 	=> 0,
				'menu_order' 	=> 0,
				'to_ping' 		=>  '',
				'pinged' 		=> '',
				'post_password' => '',
				'guid' 			=> '',
				'post_content_filtered' => '',
				'post_excerpt' 	=> '',
				'import_id' 	=> 0,
				'post_content' 	=> $note['message'],
				'post_title' 	=> $note['title']
		);
	
		// Insert reference in the database and get the resulting ID
		$post_it_note['ID'] = wp_insert_post($post_it_note, true);
	
		// Register a Post2Post Connection
		
		p2p_create_connection( AnattaNoteTaker::$p2p_connection, array(
			'from'	=> $post_id,
			'to'	=> $post_it_note['ID'],
			'meta'	=> array(
				'author'	=> $user_id
			)
		));
file_put_contents ( ABSPATH.'/wp-content/notewriter.txt', print_r($post_it_note, true).print_r($note, true) );		
		// Return the markup for Ajax
		
		return Anatta_Note_Manager::format_as_html((object) $post_it_note);
	}
	function delete_note($post_id, $note){
	
		// Delete any connections to this note
		p2p_delete_connections( AnattaNoteTaker::$p2p_connection, array(
			'to'	=> $note['note_id']
		));
		
		// Delete the actual post
		wp_delete_post($note['note_id']);
	}
	function list_notes(){
		global $current_user;
		// Get the list of notes for the current user
		$notes = new WP_Query(array(
			'post_type'	=> AnattaNoteTaker::$custom_post_type,
			'author'	=> $current_user->ID
		));
		return $notes;
	}
	function excerpt($message, $length=28){
		return wp_html_excerpt($message, $length).'&hellip;';
	}
}

/**
 * NoteTaker List Widget
 *
 * @package WordPress
 * @subpackage NoteTaker List
 */

/**
 * NoteTaker List widget class
 *
 * @since 2.8.0
 */
class WP_Widget_Anatta_NoteTaker extends WP_Widget {

	function WP_Widget_Anatta_NoteTaker() {
		$widget_ops = array('classname' => 'widget_Anatta_NoteTaker', 'description' => __( 'Lists Notes Posted by Current User') );
		$this->WP_Widget('Anatta_NoteTaker', __('NoteTaker List'), $widget_ops);
		
		add_action('widgets_init', array(&$this, 'register'));
	}
	
	function register(){
		register_widget('WP_Widget_Anatta_NoteTaker');
//		load_plugin_textdomain( 'floliving', 'wp-content/plugins/' . $this->plugin_dir . '/lang', $this->plugin_dir . '/lang' );
	}

	function widget( $args, $instance ) {		// Kick out the Widget after checking for default settings
		global $post, $Anatta_Note_Taker;
		
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'NoteTaker List' ) : $instance['title']);
		$list_id = '';
		if( is_user_logged_in() ) {
		
			$list_id = 'id="anatta_notetaker_list"';

		}
		
		echo $before_widget;
		if ( $title)
			echo $before_title . $title . $after_title;

		echo '<ul '.$list_id.'>';

		if( is_user_logged_in() ){
			$notes_query_object = Anatta_Note_Manager::list_notes();
			if( $notes_query_object->have_posts() ){
				while($notes_query_object->have_posts() ) : $notes_query_object->the_post();
					$output = Anatta_Note_Manager::format_as_html($post);
					//echo "<pre>";print_r($output); echo "</pre>";
					echo $output['content'];
				endwhile;
			} else {
				echo '<li id="'.AnattaNoteTaker::$empty_list_id.'">'.$Anatta_Note_Taker->empty_list_title.'</li>';				
			}
			wp_reset_postdata();
		} else {
			echo '<li>'.__('You must be logged in to see your notes', 'floliving').'</li>';
		}		


		echo '</ul>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {		// Make additional copies of the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
// 		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
// 			$instance['sortby'] = $new_instance['sortby'];
// 		} else {
// 			$instance['sortby'] = 'menu_order';
// 		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) { 		// Form for Widget Options
		//Defaults
		$instance = wp_parse_args( (array) $instance, array(   // Replace incoming args with defaults
			'title' => ''
		) );
		$title = esc_attr( $instance['title'] );

	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
<?php
	}
}

function load_WP_Widget_Anatta_NoteTaker(){
	// P2P Plugin is required for this widget to work
	if( !function_exists('p2p_register_connection_type') ) return;
	new WP_Widget_Anatta_NoteTaker;
}
add_action('plugins_loaded', 'load_WP_Widget_Anatta_NoteTaker');