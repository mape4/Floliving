<?php get_header(); ?>
	<section class="content clearfix wrapper">
	<article class="left-column home-page">
	<?php if (have_posts()) : ?>
	<h1 class="page-title">
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
		<?php single_cat_title(); ?>
				
	
	
	</h1>
	<div class="page-des"><?php echo category_description(); ?></div>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	
	<?php } ?>
	<?php while (have_posts()) : the_post(); ?>

		
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
						    </div>
						</article>
			
						</section>
						
						<?php endwhile; ?>
						<?php else : ?>
						<header>
							<h2>Not Found</h2>
						</header>
						<?php endif; ?>
						</article>
				

		
		<div class="sidebar">
        <?php get_sidebar(); ?>
        </div>
	</section>
<?php get_footer(); ?>
