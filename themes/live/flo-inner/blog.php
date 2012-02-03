<?php
/*
Template Name: Blog
*/
?>
<?php  get_header(); ?>

<div style="height:70px; width:980px;"><img src="<?php bloginfo('url');?>/images/inner_page_head_blog.png" width="331" height="77" hspace="10" /></div>
<?php get_sidebar(); ?>
<div id="mainContent-inner">
  <div style="padding-left:36px; padding-right:24px;">
    <?php query_posts('show_posts=-1' . '&cat=-4'); ?>
    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <!-- Display the Title as a link to the Post's permalink. -->
    <div id="post">
      <h2> <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a> </h2>
      <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
      <small>
      <?php the_time('F jS, Y') ?>
      by
      <?php the_author_posts_link() ?>
      </small>
      <!-- Display the Post's Content in a div box. -->
      <div class="entry">
        <div class="img-entry"> <img src="<?php echo catch_that_image(); ?>" style="max-width:670px; padding-top:5px;" /></div>
        <div >
          <?php the_excerpt(); ?>
        </div>
      </div>
    </div>
    <!-- Stop The Loop (but note the "else:" - see next line). -->
    <?php endwhile; ?>
    <?php else: ?>
    <p>Sorry, no posts matched your criteria.</p>
    <!-- REALLY stop The Loop. -->
    <?php endif; ?>
    <hr style="height:1px;" />
  </div>
</div>
<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
<br class="clearfloat" />
<?php get_footer(); ?>
