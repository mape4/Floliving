<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
	/* This variable is for alternating comment background */
    $oddcomment = 'alt';
?>

<!-- you can start editing here -->
<section class="comments">
<?php if ($comments) : ?>
    <h2>
        <?php comments_number('There are not any comments on this article yet!',
                              'Comment on this article! ',
                              'Comments on this article! ' ); ?>
    </h2>
    <?php $counter = 1; ?>
    <?php foreach ($comments as $comment) : ?>
    <article class="<?php echo $oddcomment; ?>">
        <header>
            <span class="number"><?php echo $counter; ?></span>
            <?php echo get_avatar( $comment, $size = '32' ); ?>
            <h3><strong><span><?php comment_author_link(); ?></span></strong></h3>
            <h3>Comment left on: <?php comment_date('F jS, Y'); ?> at <?php comment_time('g:i a'); ?></h3>
                
                
        </header>
        <div class="clear"></div>
        <?php if ($comment->comment_approved == '0') : ?>
        <em>Your comment is awaiting moderation.</em>
        <?php endif; ?>
        <?php comment_text(); ?>
    </article>
    <?php /* Changes every other comment to a different class */	
        if ('alt' == $oddcomment) { $oddcomment = ''; }
        else { $oddcomment = 'alt'; }
        //increment the counter
        $counter = $counter + 1;
    ?>
    <?php endforeach; /* end for each comment */ ?>
        
<?php else : // this is displayed if there are no comments so far ?>
    <?php if ('open' == $post->comment_status) : ?> 
        <!-- If comments are open, but there are no comments. -->
    <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments">Comments are closed.</p>
    <?php endif; ?>
<?php endif; ?>
    
<?php if ('open' == $post->comment_status) : ?>
       <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <fieldset>
            <?php if ( $user_ID ) : ?>
            <!--<label>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></label>-->
            <?php else : ?>
            <label for="author">Your Name (required):</label>
            <input name="author" id="author" value="<?php echo $comment_author; ?>" />
            <label for="email">Email Address (required, but will not be displayed):</label>
            <input name="email" id="email" value="<?php echo $comment_author_email; ?>" />
            <label for="url">Website:</label>
            <input name="url" id="url" value="<?php echo $comment_author_url; ?>" />
            <?php endif; ?>
            <!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->
            <h2 for="comment">Please comment only after having finished watching the video as the page will reload:</h2>
            <textarea name="comment" id="comment"></textarea>
            <input name="submit" type="submit" id="submit" value="Leave your comment" />
            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
            <?php do_action('comment_form', $post->ID); ?>
        </fieldset>
    </form>
</section>
<?php endif; // if you delete this the sky will fall on your head ?>
