<?php
/**
 * @package WordPress
 * @subpackage flo-inner
 */
?>
<?php  get_header(); ?>

<div style="height:70px; width:980px;"><img src="http://www.floliving.com/images/inner_page_head_blog.png" width="331" height="77" hspace="10" /></div>
<?php include ('sidebar-innerpage.php'); ?>
<div id="mainContent-inner">
  <div style="padding-left:36px; padding-right:24px;">
    <div id="content" class="widecolumn" role="main">
      <?php //define('WP_USE_THEMES', false); get_header(); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="navigation">
        <div class="alignleft">
          <?php previous_post_link('&laquo; %link') ?>
        </div>
        <div class="alignright">
          <?php next_post_link('%link &raquo;') ?>
        </div>
      </div>
      <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
        <h2>
          <?php the_title(); ?>
        </h2>
        <small>
        <?php the_time('F jS, Y') ?>
        </small>
        <div class="postentry">
          <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
          Posted in
          <?php the_category(', ') ?>
          <?php the_tags( '<p>| Tags: ', ', ', '</p>'); ?>
        </div>
        <hr style="height:1px;" />
      </div>
      <?php comments_template(); ?>
      <?php endwhile; else: ?>
      <p>Sorry, no posts matched your criteria.</p>
      <?php endif; ?>
    </div>
    <hr style="height:1px;" />
  </div>
</div>
<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
<br class="clearfloat" />
<?php get_footer(); ?>
