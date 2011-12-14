<?php
/*
Plugin Name: Atanatta Design Lesson Manager
Plugin URI: http://geek.1bigidea.com/wordpress/plugins/lesson-planner
Description: Adds Lesson and Course Manager.
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

if( is_admin() && !class_exists('Post_Options_Fields_1_0') ){
	require_once('classes/post-options-api/post-options-api.1.0.php');
}

class anattaLessonPlanner {
	var $plugin_slug = "anattaLessonPlanner";
	var $plugin_name = "Lesson Planner";
	var $plugin_version = "1.0";
	
	var $custom_post_type = 'anatta_lessons';
	var $settings_page_uri;

	function anattaLessonPlanner(){ $this->__construct(); }
	function __construct() {
		register_activation_hook(   __FILE__, array( __CLASS__, 'activate'   ) );
		register_deactivation_hook( __FILE__, array( __CLASS__, 'deactivate' ) );
		
		add_action('init', array($this, 'init'));

		add_action('admin_menu', array($this, 'admin_add_submenu_item'));


		$this->settings_page_uri = 'edit.php?post_type='.$this->custom_post_type;
	}
	function __destruct(){
	}
	function activate() {
		// Add options, initiate cron jobs here
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );
	}
	function deactivate() {
		// Remove cron jobs here
	}
	function uninstall() {
		// Delete options here
	}
	/*
	 *	Functions below actually do the work
	 */
	function init(){
		
		add_action('load-post-new.php', array($this, 'add_javascript'));
		add_action('load-post.php', array($this, 'add_javascript'));
		add_action('load-anatta_lessons_page_lessons-set-order', array($this, 'add_javascript'));

		$this->register_cpt_lessons();
		$this->register_taxonomy_course();
		
		if( !is_admin() ) return;

		$this->post_options();
	}
	function register_cpt_lessons() {
	
		$labels = array( 
			'name' => _x( 'Lessons', 'floliving' ),
			'singular_name' => _x( 'lesson', 'floliving' ),
			'add_new' => _x( 'Add New', 'floliving' ),
			'add_new_item' => _x( 'Add New Lesson', 'floliving' ),
			'edit_item' => _x( 'Edit Lesson', 'floliving' ),
			'new_item' => _x( 'New Lesson', 'floliving' ),
			'view_item' => _x( 'View Lesson', 'floliving' ),
			'search_items' => _x( 'Search Lessons', 'floliving' ),
			'not_found' => _x( 'No Lessons found', 'floliving' ),
			'not_found_in_trash' => _x( 'No Lessons found in Trash', 'floliving' ),
			'parent_item_colon' => _x( 'Parent Lesson:', 'floliving' ),
			'menu_name' => _x( 'Lessons', 'floliving' ),
		);
	
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'A single lesson within a course, including homework assignments and additional resources',
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions' ),
			
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 60,
			
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => array('slug' => 'lesson'),
			'capability_type' => 'post'
		);
	
		register_post_type( $this->custom_post_type, $args );
	}
	function register_taxonomy_course() {
	
		$labels = array( 
			'name' => _x( 'Courses', 'floliving' ),
			'singular_name' => _x( 'Course', 'floliving' ),
			'search_items' => _x( 'Search Courses', 'floliving' ),
			'popular_items' => _x( 'Popular Courses', 'floliving' ),
			'all_items' => _x( 'All Courses', 'floliving' ),
			'parent_item' => _x( 'Parent Course', 'floliving' ),
			'parent_item_colon' => _x( 'Parent Course:', 'floliving' ),
			'edit_item' => _x( 'Edit Course', 'floliving' ),
			'update_item' => _x( 'Update Course', 'floliving' ),
			'add_new_item' => _x( 'Add New Course', 'floliving' ),
			'new_item_name' => _x( 'New Course Name', 'floliving' ),
			'separate_items_with_commas' => _x( 'Separate courses with commas', 'floliving' ),
			'add_or_remove_items' => _x( 'Add or remove courses', 'floliving' ),
			'choose_from_most_used' => _x( 'Choose from the most used courses', 'floliving' ),
			'menu_name' => _x( 'Courses', 'floliving' ),
		);
	
		$args = array( 
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'rewrite' => true,
			'query_var' => true
		);
	
		register_taxonomy( 'course', array('anatta_lessons'), $args );
	}
	function post_options() {
		global $lessons_post_options, $lessons_post_fields;
		
		// Initialize the Post Options API and Fields
		$lessons_post_options = get_post_options_api( '1.0' );
		$lessons_post_fields = get_post_options_api_fields( '1.0' );	
		
		// Register two sections and add them both to the 'post' post type
		$lessons_post_options->register_post_options_section( 'lessons-custom-meta', __('Supplemental Content', 'floliving') );
		$lessons_post_options->add_section_to_post_type( 'lessons-custom-meta', $this->custom_post_type );
		
		
		// Homework for this lesson
		$lessons_post_options->register_post_option( array( 
			'id' => '_homework',
			'title' => __('Homework Assignments', 'floliving'),
			'section' => 'lessons-custom-meta',
			'callback' => array( 
				'function' => array($this, 'homework'),
				'sanitize_callback'	=> array($this, 'filter_homework'),
				'args' => array( 
					'description' => __('Enter assignment as HTML string. Drag to re-order.', 'dsc-enterprises') 
				)
			)
		) );
	
		// Supplemental Resources for this lesson
		$lessons_post_options->register_post_option( array( 
			'id' => '_resources',
			'title' => __('Resources', 'floliving'),
			'section' => 'lessons-custom-meta',
			'callback' => array( 
				'function' => array($this, 'resources'),
				'sanitize_callback'	=> array($this, 'filter_resources'),
				'args' => array( 
					'description' => __('The title/URI of additional resources. Drag to re-order.', 'floliving'
				)
			) )
		) );
	}
	function add_javascript(){
		global $current_screen;
		
		if( $current_screen->post_type == $this->custom_post_type ||
			$current_screen->base == 'anatta_lessons_page_lessons-set-order'
		){
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jq-lessons', plugins_url('/js/lessons.js', __FILE__), array('jquery') );
			
			wp_enqueue_style('css-lessons', plugins_url('/css/lessons.css', __FILE__) );
		}
	}
	/**
	 *	Handle the metafield homework
	 *		A line of homework can be a string including html (limted to the same markup as a post)
	 */
	 
	function homework($args){
		global $lessons_post_fields;
		
		$homework = maybe_unserialize($args['value']);
		
		if( !is_array($homework) ) $homework = array();
		
		echo '<ul class="sortable no-bullets homework-list">';
		foreach( $homework as $homework_item ){
			if( empty($homework_item ) ) continue;
?>
		<li>
			<div class="handle">
				<input <?php echo $field_id; ?> class="large-text" type="text" name="<?php echo $args['name_attr']; ?>[]" value="<?php echo esc_attr( $homework_item ); ?>" />
			</div>
		</li>
<?php	} ?>
		<li>
			<div class="handle">
				<input <?php echo $field_id; ?> class="large-text" type="text" name="<?php echo $args['name_attr']; ?>[]" value="" />
			</div>
		</li>
<?php
		echo '</ul>';
		echo '<span class="description">';
		echo $args['description'];
		echo '</span><br />';
		echo '<a href="#" class="add-a-line" id="homework-list" >';
		_e('Add Homework', 'floliving');
		echo '</a>';	
	}
	function filter_homework($input){
		$allowed = array();
		foreach($input as $homework){
			$allowed[] = wp_kses_post($homework);
		}
		return serialize($allowed);
	}
	function insert_homework($before="<ul>", $after="</ul>", $before_item="<li>", $after_item="</li>"){
		global $post;
		
		$homework = maybe_unserialize(get_post_meta($post->ID, '_homework', true));
		echo '<div id="lesson-homework">';
		echo "<h3>".__('Homework', 'floliving').'</h3>';
		echo $before;
		for($i=0;$i<count($homework);$i++){
			if( empty($homework[$i]) ) continue;
			
			echo $before_item;
			echo $homework[$i];
			echo $after_item;
		}		
		echo $after;
		echo '</div>';
	}
	
	/**
	 *	Handle the meta field - resources
	 *		A resource is a Title and a URL(required). The title cannot contain any html and becomes 
	 *		the entire link. If no title is provided, the URL is shown and hotlinked.
	 */
	 
	function resources($args){
		global $lessons_post_fields;
		$resources = maybe_unserialize($args['value']);

		if( !is_array($resources) ) $resources = array();

		echo '<ul class="sortable no-bullets resource-list clearfix">';
		for($i=0;$i<count($resources['uri']);$i++){
			if( empty($resources['uri'][$i]) ) continue;
?>
		<li>
			<div class="handle">
			<label><?php _e('Title', 'floliving'); ?></label>
			<input <?php echo $field_id; ?> class="large-text" type="text" name="<?php echo $args['name_attr']; ?>[title][]" value="<?php echo $resources['title'][$i]; ?>" />
			<label><?php _e('URL', 'floliving'); ?></label>
			<input <?php echo $field_id; ?> class="large-text" type="text" name="<?php echo $args['name_attr']; ?>[uri][]" value="<?php echo $resources['uri'][$i]; ?>" />
			</div>
		</li>
<?php
		}
?>
		<li>
			<div class="handle">
			<label><?php _e('Title', 'floliving'); ?></label>
			<input <?php echo $field_id; ?> class="large-text" type="text" name="<?php echo $args['name_attr']; ?>[title][]" value="" />
			<label><?php _e('URL', 'floliving'); ?></label>
			<input <?php echo $field_id; ?> class="large-text" type="text" name="<?php echo $args['name_attr']; ?>[uri][]" value="" />
			</div>
		</li>
<?php
		echo "</ul>";
		echo '<span class="description">';
		echo $args['description'];
		echo '</span><br />';

		echo '<a href="#" class="add-a-line" id="resource-list" >';
		_e('Add Resource', 'floliving');
		echo '</a>';	
	}
	function filter_resources($input){
		$allowed = array();
		for($i=0;$i<count($input['uri']);$i++){
			if( empty($input['uri'][$i]) ) continue;
			
			$url = esc_url_raw($input['uri'][$i]);
			$allowed['title'][] = ( !empty($input['title'][$i]) ) ? wp_filter_nohtml_kses($input['title'][$i]) : $url;
			$allowed['url'][] = $url;
		}
		return serialize($allowed);
	}
	function insert_resources($before="<ul>", $after="</ul>", $before_item="<li>", $after_item="</li>"){
		global $post;
		
		$resources = maybe_unserialize(get_post_meta($post->ID, '_resources', true));
		echo '<div id="lesson-resources">';
		echo "<h3>".__('Resources', 'floliving').'</h3>';
		echo $before;
		for($i=0;$i<count($resources['uri']);$i++){
			if( empty($resources['uri'][$i]) ) continue;
			
			echo $before_item;
			echo '<a href="'.esc_url($resources['uri'][$i]).'">'.$resources['title'][$i].'</a>';
			echo $after_item;
		}		
		echo $after;
		echo '</div>';
	}
/**
 *		ADMINISTRATIVE FUNCTIONS
 */
	function admin_add_submenu_item() {
	    add_submenu_page($this->settings_page_uri, 'Order Lessons', 'Order Lessons', 'manage_options', 'lessons-set-order', array($this,'render_lesson_order_form'));
	}
	function setup_settings_section(){
?>
		<p><?php _e('Check the Post Types that may have note fields', 'floliving'); ?></p>
		<p><?php _e('For the "checked" post types below, you can save notes by including the template tag in the single.php file.', 'floliving'); ?></p>
<?php
	}
	function render_lesson_order_form() {
		global $post, $wpdb;
	
		$terms = get_terms('course');
		if( isset($_REQUEST['_reorder_lessons_nonce']) && wp_verify_nonce($_REQUEST['_reorder_lessons_nonce'], 'reorder_lessons') ){
			if( isset($_REQUEST['lesson_reorder']) && is_array($_REQUEST['lesson_reorder'])){
				foreach( $_REQUEST['lesson_reorder'] as $term_id => $lessons ){
					foreach($lessons as $order => $post_id){
						$wpdb->update($wpdb->posts, array( 'menu_order' => $order), array('ID' => $post_id), array('%d'), array('%d'));
					}
				}
			}
		}
		
?>
		<div class="wrap">
			
			<!-- Display Plugin Icon, Header, and Description -->
			<div class="icon32" id="icon-options-general"><br></div>
			<h2><?php _e('Manage Lesson Sequencing with Course', 'floliving'); ?></h2>
			<p><?php _e('Drag and drop lessons within a course to set the presentation order', 'floliving'); ?></p>
			<!-- Beginning of the Plugin Options Form -->
			<form method="post" id="lesson-reordering">
<?php
				wp_nonce_field('reorder_lessons', '_reorder_lessons_nonce');
				foreach( $terms as $term ){
					echo '<h3>';
					echo $term->name;
					echo '</h3>';
					$posts = new WP_Query(array(
						'post_type'	=> $this->custom_post_type,
						'orderby'	=> "menu_order",
						'order'		=> 'ASC',
						'tax_query'	=> array(
							array(
								'taxonomy'	=> 'course',
								'field'		=> 'id',
								'terms'		=> $term->term_id
							)
						)
					));
					if( $posts->have_posts()) :
						echo '<ul class="sortable no-bullets">';
						while( $posts->have_posts() ) : $posts->the_post();
							echo '<li><div class="handle">';
							the_title();
							$this->hidden_field(array(
								'name' => 'lesson_reorder['.$term->term_id.'][]',
								'value' => $post->ID
							));
							echo '</div><li>';
						endwhile;
						echo '</ul>';
					endif;
				}
?>
				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
		</div>
<?php	
	}
	function hidden_field($args){
		extract($args);
		echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
	}
	
}

if( class_exists('anattaLessonPlanner') ){
	new anattaLessonPlanner;
	
	function lessons_insert_resources($before="<ul>", $after="</ul>", $before_item="<li>", $after_item="</li>"){
		anattaLessonPlanner::insert_resources($before, $after, $before_item, $after_item);
	}
	function lessons_insert_homework($before="<ul>", $after="</ul>", $before_item="<li>", $after_item="</li>"){
		anattaLessonPlanner::insert_homework($before, $after, $before_item, $after_item);
	}
}