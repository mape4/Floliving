<?php get_header(); ?>
	<section class="content clearfix wrapper">
		
				
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" class="left-column blog">
		<h1 class="page-title">The Sweet Spot</h1>
		<p class="page-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin.</p>
		
		<article class="clearfix">
		  <div class="video"><img src="<?php bloginfo('template_url') ?>/images/image1.jpg" alt="video" /><span>&nbsp;</span><a href="#" class="play">&nbsp;</a></div>
		  <div class="entry">
		    <h2><a href="#">Session One: Healing from Stress and Supporting Your Adrenals</a></h2>
		    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin tincidunt. Mauris pharetra condimentum tincidunt. </p>
		    <a href="#" class="read-more">Watch &amp; Learn More ></a> </div>
		</article>
		<article class="clearfix">
		  <div class="video"><img src="<?php bloginfo('template_url') ?>/images/image2.jpg" alt="video" /><span>&nbsp;</span><a href="#" class="play">&nbsp;</a></div>
		  <div class="entry">
		    <h2><a href="#">Session Two: Menstrual Cycle 101</a></h2>
		    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis velit ac ipsum sollicitudin tincidunt. Mauris pharetra condimentum tincidunt. </p>
		    <a href="#" class="read-more">Watch &amp; Learn More ></a> </div>
		</article>
			<!--<header>
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<p> <!-- edit this meta stuff? --*>
					<span>Posted on:</span> <?php the_time('F jS, Y'); ?>
					<span>by</span> <?php the_author(); ?> |
					<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
				</p>
			</header>
			<section>
				<?php the_content(); ?>
			</section>
			<footer> <!-- post metadata --*>
				<p><?php the_tags('<span>Tags:</span> ', ', ', ''); ?></p>
				<p><span>Posted in</span> <?php the_category(', ') ?> | 
				<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<?php //comments_template(); //this is only in single.php ?>
			</footer>-->
		</article>
		<?php endwhile; ?>
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
