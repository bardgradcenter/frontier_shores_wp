<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Frontier Shores</title>
	<?php wp_head(); ?>
</head>
<body onContextMenu="return false">
	<div class="container">
		<div id="mapContainer">
			<div class="attract_loop_map">
			</div>
			<div class="intro_map">
				<div class="intro_map_outline" id="outline_01">
					<h2>Areas of Study</h2>
				</div>
				<div class="intro_map_outline" id="outline_02">
				</div>
				<div class="intro_map_outline" id="outline_03">
				</div>
			</div>
			<div class="context_map big">
			</div>
		</div>
		<div class="navigation">
			<ul>
				<?php if( have_rows('frontier_shores_section', 'options')) { ?>
					<?php while ( have_rows('frontier_shores_section', 'options') ) { the_row(); ?>
						<?php
						$section_type = get_sub_field('section_type');
						if($section_type == 'About Section'){ ?>
							<li class="info_nav active"><h1><?php the_sub_field('nav_header'); ?></h1></li>
						<?php } elseif($section_type == 'Object Section'){ ?>
							<li class="context_nav"><h2><?php the_sub_field('nav_header'); ?></h2></li>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<br clear="all">
			</ul>
		</div>
		


		<?php if( have_rows('frontier_shores_section', 'options')) { ?>
			<?php $n = 1; ?>
			<?php while ( have_rows('frontier_shores_section', 'options') ) { the_row(); ?>
				<?php
				$section_type = get_sub_field('section_type');
				
				if($section_type == 'About Section'){ ?>
				
					<?php
					$attract_objects = get_sub_field('objects');
					if($attract_objects) { ?>
						<?php $a = 1; ?>
						<div class="attract_loop active" style="display:block;">
						<?php foreach( $attract_objects as $post ){ ?>
							<?php setup_postdata($post); ?>
							<?php if($a == 1){?>
							<div class="attract_item active" style="display:block;">
							<?php } else { ?>
							<div class="attract_item">
							<?php } ?>
								<div class="attract_image">
									<?php 
									$image = get_field('image_for_circle');
									if($image){ 
										$size = 'attract';
										$attract = $image['sizes'][$size]; ?>
										<img src="<?php echo $attract; ?>">
									<?php } ?>
									<div class="x_cord"><?php the_field('x_coord');?></div>
									<div class="y_cord"><?php the_field('y_coord');?></div>
								</div>
								<div class="locator">
									<div class="label">
										<?php the_field('locator_label'); ?>
									</div>
									<div class="circle">
									</div>
									<div class="connector">
									</div>
								</div>
								<div class="call_to">
									Explore the Map
								</div>
							</div>
							<?php $a++; ?>
						<?php } ?>
						<?php wp_reset_postdata(); ?>
						</div>
					<?php } ?>

					<div class="intro_screen">
						<div class="intro_content" style="display:block;">
							<h1 style="display:block;"><?php the_sub_field('essay_title'); ?></h1>
							<?php the_sub_field('essay_abstract'); ?>
							<?php
							$read_more = get_sub_field('read_more_page');
							if($read_more == 'true'){ ?>
								<h2 class="lightbox_trigger">Credits</h2>
								<div class="lightbox_content text_content">
									<div class="content" style="width:1024.5px; height:616px;">
										<h1>Credits</h1>
										<div class="credits">
											<div class="left_column column">
												<?php the_sub_field('left_credit_column'); ?>
											</div>
											<div class="right_column column">
												<?php the_sub_field('right_credit_column'); ?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				
				<?php } elseif($section_type == 'Object Section'){ ?>
					<?php
						$n = sprintf("%02d", $n);
					?>
					<div class="content_section" id="content_section_<?php echo $n; ?>">
						<div class="icons">
							<div class="single_icon active">
								<div class="context_icon">
									<h2><?php the_sub_field('date_period'); ?></h2>
								</div>
							</div>

							<?php
							$icons = get_sub_field('objects');
							if($icons) { ?>
								<?php foreach( $icons as $post ){ ?>
									<?php setup_postdata($post); ?>
									<div class="single_icon">
										<?php 
										$image = get_field('image_for_circle');
										$size = 'thumbnail';
										$thumb = $image['sizes'][$size]; ?>
										<div class="object_icon" style="background: url('<?php echo $thumb; ?>') center center;">
											<div class="x_cord"><?php the_field('x_coord'); ?></div>
											<div class="y_cord"><?php the_field('y_coord'); ?></div>
										</div>
									</div>
								<?php } ?>
								<?php wp_reset_postdata(); ?>
							<?php } ?>

						</div>
						<div class="expanded active">
							<div class="single_content context_content">
								<div class="content" style="display:block;">
									<h1 style="display:block;"><?php the_sub_field('essay_title'); ?></h1>

									<?php the_sub_field('essay_abstract'); ?>
									<?php
									$read_more = get_sub_field('read_more_page');
									if($read_more == 'true'){ ?>
										<h2 class="lightbox_trigger">Read More</h2>
										<div class="lightbox_content text_content">
											<div class="content" style="width:1024.5px; height:616px;">
												<h1><?php the_sub_field('essay_title'); ?></h1>
												<div class="content_column">
													<div class="abstract"><?php the_sub_field('essay_abstract'); ?></div>
													<?php the_sub_field('read_more_essay'); ?>
												</div>
											</div>
										</div>
									<?php } ?>

									<div class="label_bar in_content">
										<?php
										$german_checkbox = get_sub_field('show_german_claim_option');
										if($german_checkbox == 'true'){ ?>
											<div class="checkbox_container">
												<div class="german_checkbox unchecked"></div>
													Show German Claim
											</div>
										<?php } ?>
										
										<?php
										$powers = get_sub_field('colonial_powers');
										if($powers) { ?>
										<div class="flags">
											Colonial Powers:
											<?php foreach( $powers as $post ){ ?>
												<?php setup_postdata($post); ?>
												<?php the_post_thumbnail( 'flag', array('class' => 'flag')); ?>
											<?php } ?>
											<?php wp_reset_postdata(); ?>
										</div>
										<?php } ?>
									</div>
								</div>

							</div>


							<?php
							$beacons = get_sub_field('objects');
							if($beacons) { ?>
							<div class="beacons">
								<?php foreach( $beacons as $post ){ ?>
									<?php setup_postdata($post); ?>
									<div class="beacon" style="left:<?php the_field('x_coord'); ?>px; top:<?php the_field('y_coord'); ?>px;">
									</div>
								<?php } ?>
								<?php wp_reset_postdata(); ?>
							</div>
							<?php } ?>


							<div class="label_bar">
								<div class="checkbox unchecked"></div>
								Show Current-Day Pacific Nations
							</div>
							<?php
							$german_checkbox = get_sub_field('show_german_claim_option');
							if($german_checkbox == 'true'){ ?>
								<div class="german_map">
								</div>
							<?php } ?>
							<?php if( have_rows('current_day_nations', 'options')) { ?>
								<div class="labels non_full_map">
									<?php while ( have_rows('current_day_nations', 'options') ) { the_row(); ?>
										
										<?php
										$x_coord = get_sub_field('x_coord');
										$y_coord = get_sub_field('y_coord');
										$xcoord = ($x_coord / 1600)*100;
										$ycoord = ($y_coord / 900)*100;
										?>
										<div class="label" style="left:<?php echo $xcoord; ?>%; top: <?php echo $ycoord; ?>%">
											<strong><?php the_sub_field('label'); ?></strong>
										</div>

									<?php } ?>
								</div>
							<?php } ?>
						</div>


						<?php
						$objects = get_sub_field('objects');
						if($objects) { ?>
							<?php foreach( $objects as $post ){ ?>
								<?php setup_postdata($post); ?>
								<div class="expanded">
									<div class="triangle">
										<div class="inner">
										</div>
									</div>
									<div class="single_content object_content">
										
									<?php
									$images = get_field('image_gallery');
									if( $images ){ ?>
										<div class="images">
											<?php $n = 1; ?>
											<?php $i = 1; ?>
											<div class="image_gallery">
												<?php foreach( $images as $image ){ ?>
													
													<img src="<?php echo $image['sizes']['medium']; ?>" class="lightbox_trigger" <?php if( $n =='1' ){?>style="display:block;"<?php } else { ?>style="display: none;"<?php }; ?>>

													<div class="image_caption" <?php if( $n =='1' ){?>style="display:block;"<?php } else { ?>style="display: none;"<?php }; ?>>
														<div class="caption"><?php echo $image['caption']; ?></div><h3 class="lightbox_text_trigger"><img src="<?php echo network_site_url(); ?>wp-content/themes/frontier_shores/images/mag.png">&nbsp;Enlarge Image</h3>
													</div>
													<div class="lightbox_content image_content">
														<?php
														$lrg_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
														$lrg_img_url = $lrg_img['0'];
														$lrg_img_width = $lrg_img['1'];
														$lrg_img_height = $lrg_img['2'];
														?>
														<img src="<?php echo $image['sizes']['large']; ?>" style="width:<?php echo $image['sizes']['large-width']; ?>px; height:<?php echo $image['sizes']['large-height']; ?>px;">
														<div class="image_caption">
															<?php echo $image['caption']; ?>
														</div>
													</div>

													<?php $n++; ?>
												<?php }; ?>
											</div>
											<div class="gallery_thumbs">
												<?php foreach( $images as $image ){ ?>
												
													<img src="<?php echo $image['sizes']['gallery_thumb']; ?>" class="gallery_thumb<?php if( $i =='1' ){?> active<?php };?>">
													<?php $i++; ?>
												<?php }; ?>
											</div>
										</div>
									<?php } else { ?>
										<div class="images">
											<?php the_post_thumbnail('medium', array('class' => 'lightbox_trigger')); ?>
											<div class="image_caption">
												<div class="caption"><?php echo get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?></div><h3 class="lightbox_text_trigger"><img src="<?php echo network_site_url(); ?>wp-content/themes/frontier_shores/images/mag.png">&nbsp;Enlarge Image</h3>
											</div>
											<div class="lightbox_content image_content">
												<?php
												$lrg_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
												$lrg_img_url = $lrg_img['0'];
												$lrg_img_width = $lrg_img['1'];
												$lrg_img_height = $lrg_img['2'];
												?>
												<img src="<?php echo $lrg_img_url; ?>" style="width:<?php echo $lrg_img_width; ?>px; height:<?php echo $lrg_img_height; ?>px;">
												<div class="image_caption">
													<?php echo get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
												</div>
											</div>
										</div>
									<?php } ?>
										<div class="content">
											<h1><?php the_field('object_title'); ?></h1>
											<?php the_field('essay_abstract'); ?>
											<?php
											$read_more = get_field('read_more_page');
											if($read_more == 'true'){ ?>
												<h2 class="lightbox_trigger">Read More</h2>
												<div class="lightbox_content text_content">
													<div class="content" style="width:1024.5px; height:616px;">
														<h1><?php the_field('object_title'); ?></h1>
														<div class="content_column">
															<?php the_field('essay_abstract'); ?>
															<?php the_field('read_more_essay'); ?>
														</div>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="small_map">
										<div class="expand_map">
											Expand Full Map
										</div>
										<div class="full_map condensed">
											<?php
											$x_coord = get_field('x_coord');
											$x_percent = (($x_coord / 1600)*100)-1.546486090776;
											$y_coord = get_field('y_coord');
											$y_percent = (($y_coord / 900)*100)-3.25555555559997;
											?>
											<div class="crop_outline" style="left: <?php echo $x_percent;?>%; top: <?php echo $y_percent;?>%;">
											</div>
											<div class="collapse_map">
												Collapse Map
											</div>
											<div class="label_bar">
												<div class="checkbox unchecked"></div>
												Show Current-Day Pacific Nations
											</div>

											<?php if( have_rows('current_day_nations', 'options')) { ?>
												<div class="labels">
													<?php while ( have_rows('current_day_nations', 'options') ) { the_row(); ?>
														
														<?php
														$x_coord = get_sub_field('x_coord');
														$y_coord = get_sub_field('y_coord');
														$xcoord = ($x_coord / 1600)*100;
														$ycoord = ($y_coord / 900)*100;
														?>
														<div class="label" style="left:<?php echo $xcoord; ?>%; top: <?php echo $ycoord; ?>%">
															<strong><?php the_sub_field('label'); ?></strong>
														</div>

													<?php } ?>
												</div>
											<?php } ?>

											<img src="<?php echo network_site_url(); ?>wp-content/themes/frontier_shores/images/expand_map_new.png">
										</div>
									</div>
									<div class="label_bar">
										<div class="checkbox unchecked"></div>
										Show Current-Day Pacific Nations
									</div>
									<div class="labels non_full_map">
										<?php if( have_rows('nation_labels')) { ?>
											<?php while ( have_rows('nation_labels') ) { the_row(); ?>
												<div class="label" style="left:<?php the_sub_field('x_coord'); ?>px; top: <?php the_sub_field('y_coord'); ?>px">
													<strong><?php the_sub_field('nation_name'); ?></strong>
												</div>
											<?php } ?>
										<?php } ?>									
									</div>
									<div class="locator">
										<div class="label">
											<?php the_field('locator_label'); ?>
										</div>
										<div class="circle">
										</div>
										<div class="connector">
										</div>
									</div>
								</div>
							<?php } ?>
							<?php wp_reset_postdata(); ?>
						<?php } ?>

					</div>

					<?php
						$n++;
					?>

				<?php } ?>

			<?php } ?>
		<?php } ?>
		
	</div>
	<div class="the_lightbox">
		<div class="content">
		</div>
		<div class="close">
			X Close
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>