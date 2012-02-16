<?php
if ( is_user_logged_in() ) 

 {
?>
<?php get_header(); ?>

	<section class="content clearfix wrapper">
		<article id="post-<?php the_ID(); ?>" class="left-column home-page">
		<h1 class="page-title">The Sweet Spot</h1>
		<p class="page-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin.</p>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="home-section">
			<article class="clearfix">
			  <div class="video"><?php the_post_thumbnail(); ?></div>
			  <div class="entry">
			  <header>
			  	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			  	<!--<p> <!-- edit this meta stuff? --*>
			  		<span>Posted on:</span> <?php the_time('F jS, Y'); ?>
			  		<span>by</span> <?php the_author(); ?> |
			  		<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
			  	</p>-->
			  </header>
			  <?php the_excerpt(); ?>
			   <a href="<?php the_permalink() ?>" class="read-more">Watch &amp; Learn More ></a> </div>
			    </div>
			</article>

			</section>
			<!--<footer> <!-- post metadata --*>
				<p><?php the_tags('<span>Tags:</span> ', ', ', ''); ?></p>
				<p><span>Posted in</span> <?php the_category(', ') ?> | 
				<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<?php //comments_template(); //this is only in single.php ?>
			</footer>-->
			<?php endwhile; ?>
		</article>
		
		<?php else : ?>
		<article>
			<header>
				<h2>Not Found</h2>
			</header>
		</article>
		<?php endif; ?>
		<div class="sidebar">
	    <?php get_sidebar(); ?>
	    </div>
	</section>
<?php get_footer(); ?>
<?php } else { 
header("Location: ".get_option('home')."/login/");
 } ?>
