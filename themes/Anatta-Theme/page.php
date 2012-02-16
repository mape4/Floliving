<?php
if ( is_user_logged_in() ) 
 {
?>
<?php 
$request_uri = explode('/',$_SERVER['REQUEST_URI']);
$request_uris = $request_uri[1];
?>

<?php get_header(); ?>

	<section class="content clearfix wrapper">
	
	
	 <article class="left-column home-page-inner" <?php if($request_uris == 'wishlist-member') { ?> id="registration_page" <?php } ?>>
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
        <?php if($request_uris != 'wishlist-member') {?>
		<div class="sidebar">
		 <?php get_sidebar(); ?>
	</div>
    <?php } ?>
	</section>
<?php get_footer(); ?>
<?php } else { 
header("Location: ".get_option('home')."/login/");
 } ?>

