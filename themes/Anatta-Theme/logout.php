<?php
/*
Template Name: logout
*/
?>
<?php get_header(); ?>
	<section class="content clearfix wrapper">
	 <article class="left-column logout">
	 <header>
	 	<h2><?php the_title(); ?></h2>
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
		</section>
<?php get_footer(); ?>
