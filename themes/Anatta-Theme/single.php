<?php get_header(); ?>
	<section class="content clearfix wrapper">
		<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
	 <article id="post-<?php the_ID(); ?>" class="left-column home-page-inner">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<header>
				<h2><?php the_title(); ?></h2>
			
			</header>
			<section class="posts">
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
		<div class="sidebar" id="breadcrumb-pages">
		<aside>
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Lesson-Detail-Page') ) : else : ?>
	    <?php endif; ?>
	</aside>
	</div>
	</section>
<?php get_footer(); ?>
