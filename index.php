<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Frontier Shores</title>
	<?php wp_head(); ?>
</head>
<body>
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
								Show Current-Day Nations
							</div>
							<?php
							$german_checkbox = get_sub_field('show_german_claim_option');
							if($german_checkbox == 'true'){ ?>
								<div class="german_map">
								</div>
							<?php } ?>
							<div class="labels non_full_map">
								<div class="label" style="left:10.688140556369%; top:61.588541666667%;">
									<strong>Australia</strong>
								</div>
								<div class="label" style="left:16.617862371889%; top:38.151041666667%;">
									<strong>Paupa New<br>Guinea</strong>
								</div>
								<div class="label" style="left:30.234260614934%; top:80.989583333333%;">
									<strong>New Zealand</strong>
								</div>
							</div>
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
										<div class="images">
											<?php the_post_thumbnail('medium', array('class' => 'lightbox_trigger')); ?>
											<div class="image_caption">
												<?php echo get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
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
											$x_percent = (($x_coord / 1366)*100)-1.546486090776;
											$y_coord = get_field('y_coord');
											$y_percent = (($y_coord / 768)*100)-2.92968749999997;
											?>
											<div class="crop_outline" style="left: <?php echo $x_percent;?>%; top: <?php echo $y_percent;?>%;">
											</div>
											<div class="collapse_map">
												Collapse Map
											</div>
											<div class="label_bar">
												<div class="checkbox unchecked"></div>
												Show Current-Day Nations
											</div>
											<div class="labels">
												<div class="label" style="left:10.688140556369%; top:61.588541666667%;">
													<strong>Australia</strong>
												</div>
												<div class="label" style="left:16.617862371889%; top:38.151041666667%;">
													<strong>Paupa New<br>Guinea</strong>
												</div>
												<div class="label" style="left:30.234260614934%; top:80.989583333333%;">
													<strong>New Zealand</strong>
												</div>
											</div>
											<img src="<?php echo network_site_url(); ?>wp-content/themes/frontier_shores/images/expand_map.png">
										</div>
									</div>
									<div class="label_bar">
										<div class="checkbox unchecked"></div>
										Show Current-Day Nations
									</div>
									<div class="labels non_full_map">
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