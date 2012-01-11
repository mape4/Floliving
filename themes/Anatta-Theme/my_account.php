<?php
/**
 * Template Name: My Account Page
 *
 */
 
	/* Get user info. */
	global $current_user, $wp_roles;
	get_currentuserinfo();
	$user_loggedin = $userdata->ID;
	$logged_user = $userdata->display_name;

 
	// check to see if the form has been posted. If so, validate the fields
	if(!empty($_POST['action']))
	{
	require_once(ABSPATH . 'wp-admin/includes/user.php');
	require_once(ABSPATH . WPINC . '/registration.php');
	check_admin_referer('update-profile_' . $user_ID);
	$errors = edit_user($user_ID);
	if ( is_wp_error( $errors ) ) {
	foreach( $errors->get_error_messages() as $message )
	$errmsg = "$message";
	//exit;
	}
	// if there are no errors, then process the ad updates
	if($errmsg == '')
	{
	do_action('personal_options_update');

	//wp_redirect( get_option("siteurl").'?page_id='.$post->ID.'&updated=true' );
	$authr_name= $user_ID->display_name;
	wp_redirect( get_permalink() );
			exit;
	}
	else {
	$errmsg = '<div class="box-red">** ' . $errmsg . ' **</div>';
	$errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';
	}
	}
    // calling the header.php
    get_header();
 
   
 
?>
 
	<div id="container">
		<div id="content">
 
            <?php
 
            the_post();
 
            ?>
 
			<div id="post-<?php the_ID(); ?>" class="">
 
                
 
				<div class="entry-content">
 
                    <?php
 
                    the_content();
 
                    edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>
 
				</div>
			</div><!-- .post -->
 
<!-- EDIT PROFILE STARTS HERE -->
 
			<?php if ( !is_user_logged_in() ) : ?>
			
 
				<p class="warning">
					<?php _e('You must be logged in to edit your profile.', 'frontendprofile'); ?>
				</p><!-- .warning -->
 
			<?php else : ?>
			 
  <div class="my-account">
  
   <h1>My Account</h1>
   <div class="account-inner">

				<?php if ( $errmsg ) echo '<p class="error">' . $errmsg . '</p>'; ?>

				<form method="post" id="edituser" name="profile" class="user-forms" action="<?php the_permalink(); ?>" enctype="multipart/form-data">
                <?php wp_nonce_field('update-profile_' . $user_loggedin) ?>
                <input type="hidden" name="from" value="profile" />
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="checkuser_id" value="<?php echo $user_loggedin ?>" />
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_loggedin; ?>" />
 
				<p class="first_name">
					<label for="first_name"><?php _e('First Name', 'frontendprofile'); ?></label>
					<input class="text-input" name="first_name" type="text" id="first_name" value="<?php the_author_meta( 'first_name', $current_user->id ); ?>" />
				</p><!-- .first_name -->
 
				<p class="last_name">
					<label for="last_name"><?php _e('Last Name', 'frontendprofile'); ?></label>
					<input class="text-input" name="last_name" type="text" id="last_name" value="<?php the_author_meta( 'last_name', $current_user->id ); ?>" />
				</p><!-- .last_name -->
 
				<p class="form-email">
					<label for="email"><?php _e('E-mail (required)', 'frontendprofile'); ?></label>
					<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->id ); ?>" />
				</p><!-- .form-email -->
 
				<p class="form-password">
					<label for="pass1"><?php _e('New Password', 'frontendprofile'); ?> </label>
					<input class="text-input" name="pass1" type="password" id="pass1" />
				</p><!-- .form-password -->
 
				<p class="form-password">
					<label for="pass2"><?php _e('Repeat Password', 'frontendprofile'); ?></label>
					<input class="text-input" name="pass2" type="password" id="pass2" />
				</p><!-- .form-password -->
				
               <?php
                
                if(function_exists('userphoto_exists')){
					echo '<div class="upload-pic"><h4 class="h2top">Profile Picture</h4>';
						//do_action('show_user_profile');

					echo "<div id='user-photo' class='user-photo1'>";
					if(userphoto_exists($user_loggedin))
					userphoto($user_loggedin);
					 echo "</div></div>"; ?>
                    <?php // if($userdata->userphoto_image_file): ?>
                    <div class="choose">
                      
                            <label>Choose file: </label>
                            <div class="choose-file">
                            <input type="file" id="userphoto_image_file" name="userphoto_image_file">
                            <span class="field-hint">(max upload size 50M)</span>
                         
                    		</div>
                              <label>  <?php _e('Delete Profile Picture?','cp') ?></label>
                            <input type="checkbox" name="userphoto_delete" id="userphoto_delete" />
                          
                         
                       
                  
                    </div>
                    <?php } ?>
 
				<p class="form-submit">
					<?php echo $referer; ?>
					<div class="clear"></div>
					<input type="submit" class="savebutton" value="Save" name="submit" />
				</p><!-- .form-submit -->
 
				</form><!-- #edituser -->
				</div>
				</div>

			<?php endif; ?>
 
<!-- EDIT PROFILE ENDS HERE -->
 
        
 
		</div><!-- #content -->
	</div><!-- #container -->

<?php 
    // calling footer.php
    get_footer();
 
?>