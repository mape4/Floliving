<?php
/*
Template Name: Static
*/
?>
<?php  get_header(); ?>

<div id="">
  <div style="padding-left:36px; padding-right:24px;">
    <!-- Start the Loop. -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <!-- Display the Title as a link to the Post's permalink. -->
    <div id="post">
      <h2> <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a> </h2>
     
      <!-- Display the Post's Content in a div box. -->
      <div class="entry">
       
        <div >
          <?php the_content(); ?>
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
