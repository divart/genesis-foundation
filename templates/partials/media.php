<?php 

include( CHILD_DIR . '/templates/includes/additional-classes.php' );

?>

<?php $media_type = sanitize_title_with_dashes( get_sub_field('media_type') ); ?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block media<?php echo $media_type != NULL ? ' ' . $media_type : ''; ?> row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

	<?php $media_size = get_sub_field('media_size'); ?>

	<?php if ( $media_size == 'Contained' ) { ?>

	<div class="wrap">

	<?php } ?>

		<?php if ( get_sub_field('headline') || get_sub_field('subheadline') ) { ?>

		<header class="section-header small-12 column">		

			<?php if ( $headline = get_sub_field('headline') ) { ?>

			<h1 class="section-title"><?php echo $headline; ?></h1>

			<?php } ?>

			<?php if ( $subheadline = get_sub_field('subheadline') ) { ?>

			<h2 class="section-subtitle"><?php echo $subheadline; ?></h2>

			<?php } ?>

		</header>

		<?php } ?>

		<div class="small-12 column<?php echo $media_size == 'Full Width' ? ' large-collapse' : ''; ?>">

			<?php if ( get_sub_field('media_type') == 'Photo' && $image = get_sub_field('image') ) { ?>

			<?php if ( $image_link = get_sub_field('image_link') ) { ?>

			<?php $target = get_sub_field('link_target'); ?>

			<a href="<?php echo $image_link; ?>"<?php echo $target == "New Tab" ? ' target="_blank"' : ''; ?>>

			<?php } ?>
			
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />

			<?php if ( $image_link = get_sub_field('image_link') ) { ?>
			
			</a>

			<?php } ?>

			<?php } elseif ( get_sub_field('media_type') == 'Video' && $video = get_sub_field('video') ) { ?>

			<div class="flex-video">

				<?php echo $video; ?>

			</div>
			<!-- end .video -->

			<?php } elseif ( get_sub_field('media_type') == 'Gallery' && $gallery = get_sub_field('gallery') ) { ?>

				<?php if ( get_sub_field( 'layout' ) == 'Slideshow' ) { ?>

				<ul data-orbit data-options="slide_number:false;timer:false;">

					<?php foreach ( $gallery as $image ) { ?>

					<li>

						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />

						<?php if ( $image['caption'] ) { ?>

						<div class="orbit-caption">

							<?php echo $image['caption']; ?>

						</div>
						<!-- end .orbit-caption -->

						<?php } ?>

					</li>

					<?php } ?>

				</ul>
				<!-- end data-orbit -->

				<?php } elseif ( get_sub_field( 'layout' ) == 'Thumbnails with Modal Preview' ) { ?>

				<ul class="clearing-thumbs small-block-grid-2 medium-block-grid-4 large-block-grid-6" data-clearing>

					<?php foreach ( $gallery as $image ) { ?>

					<li>

						<a href="<?php echo $image['url']; ?>">

							<img src="<?php echo $image['sizes']['square-500']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>" />
						
						</a>

					</li>

					<?php } // end foreach $image ?>

				</ul>
				<!-- end .clearing-thumbs -->

				<?php } // endif Thumbnails with Modal Preview ?>

			<?php } // endif $gallery ?>

		</div>
		<!-- end .column -->

	<?php if ( get_sub_field('media_size') == 'Contained' ) { ?>

	</div>
	<!-- end .wrap -->

	<?php } ?>

</section>
<!-- end .media -->