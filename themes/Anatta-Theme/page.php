<?php get_header(); ?>
	<section class="content clearfix wrapper">
	
	
	 <article class="left-column home-page-inner">
	 <header>
	 	<h1 class="page-title"><?php the_title(); ?></h1>
	 
	 </header>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<section>
				<?php the_content(); ?>
			</section>


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

