function navigateto(x_cord, y_cord, zoom){

	//ENTER X AND Y COORDINATES OF ZOOM POINT ON MAP THAT IS 1600PX WIDE

	var map = $('.context_map');
	var scale = zoom;
	var x = x_cord;
	var y = y_cord;
	var xScaled = x*scale;
	var yScaled = y*scale;
	var mapXScaled = 1600*scale;
	var mapYScaled = 900*scale;
	var xp = xScaled-(200); // 1600 * 0.125
	var yp = yScaled-(270); // 900 * 0.3
	
	map.animate({
		'left' : '-' + xp,
		'top' : '-' + yp,
		'width' : mapXScaled,
		'height' : mapYScaled,
	}, 3000, 'easeInOutCubic', function(){
		if($('.content_section.active .expanded.active .label_bar .checkbox').hasClass('checked')){
			$('.content_section.active .expanded.active .labels.non_full_map').fadeIn(250);
		}
	});
}

function attract_loop(active_item){
	if($(active_item).is(':last-of-type')){
		var next_item = $('.attract_item:first-of-type');
	} else {
		var next_item = $(active_item).next('.attract_item');
	}
	var map = $('.attract_loop_map');
	var scale = 8;
	var x = $(active_item).find('.x_cord').text();
	var y = $(active_item).find('.y_cord').text();
	var xScaled = x*scale;
	var yScaled = y*scale;
	var mapXScaled = 1600*scale;
	var mapYScaled = 900*scale;
	var xp = xScaled-(200); // 1600 * 0.125
	var yp = yScaled-(455); // 900 * 0.5 + 5
	map.animate({
		'left' : '-' + xp,
		'top' : '-' + yp,
		'width' : mapXScaled,
		'height' : mapYScaled,
	}, 3000, 'easeInOutCubic', function(){
		setTimeout(function(){
			$(next_item).css('z-index',20).addClass('active');
			$(active_item).css('z-index',100);
			$(next_item).show();
			$(active_item).removeClass('active').fadeOut(1000);
			if($('.attract_loop').hasClass('active')){
				attract_loop(next_item);
			}
		},6000);
	});
}

idleTime = 0;
function timerIncrement() {
	idleTime = idleTime + 1
	if( idleTime > 1) {
		if($('.attract_loop').hasClass('active')){

		} else {
			if($('.the_lightbox').is(':visible')) {
				$('.the_lightbox .close').trigger('click')
			}
			$('.info_nav').trigger('click');
			setTimeout(function(){
				$('.intro_screen').fadeOut(1000);
				$('.intro_screen').removeClass('active');
				$('.attract_loop').addClass('active');
				$('.attract_loop').fadeIn(1000);
				$('.attract_loop_map').fadeIn(1000);
				$('.context_nav').animate({
					'opacity': 0
				},1000);
				$('.attract_item .locator').show().css('left','0%');
				attract_loop($('.attract_item.active'));
			}, 3000)
		}
	}
}

$(function(){

	//Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 90000); // Half minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });



	if($('.attract_loop').hasClass('active')){
		attract_loop($('.attract_item.active'));
		$('.context_nav').css('opacity',0);
	}
	$('.attract_item').click(function(){
		$('.intro_screen').fadeIn(1000);
		$('.intro_screen').addClass('active');
		$('.attract_loop').removeClass('active');
		$('.attract_loop').fadeOut(1000);
		$('.attract_loop_map').fadeOut(1000);
		$('.context_nav').animate({
			'opacity': 1
		},1000);
	});

	$('.info_nav').click(function(){
		var container = $('.container');
		if($(this).hasClass('active')){

		} else if($(container).hasClass('stuff_moving')){

		} else {
			var active_section = $('.content_section.active');
			var active_nav = $('.navigation .context_nav.active');
			var active_icon = $(active_section).find('.single_icon.active');
			var active_icon_type = $(active_icon).find('div').attr('class');
			var goto_nav = $(this);
			var goto_section = $('.intro_screen');
			var checkbox = $(active_section).find('.expanded.active').find('.checkbox');

			$(active_section).find('.context_icon').trigger('click');

			$(active_nav).removeClass('active');
			$(goto_nav).addClass('active');
			$(goto_section).addClass('active');
			$(active_section).find('.beacons').fadeOut(500);
			$(active_section).find('.labels').fadeOut(500);
			$(goto_section).fadeIn(500);
			$(active_section).removeClass('active').fadeOut(500, function(){
				$('.intro_screen .intro_content').animate({
					'width' : '31.25%',
					'right' : '0%'
				},1000, function(){
					$('.intro_content h1').fadeIn(1000);
					$('.intro_content p').fadeIn(1000);
				});
			});

			$('.intro_map').animate({
				'width': 1100,
				'height' : 852,
				'top' : '48px',
				'left' : '0',
				'opacity' : 1
			}, 3000, 'easeInOutCubic');
			if($(checkbox).hasClass('checked')){
				$('.checkbox').trigger('click');
			}
		}

	});
	$('.context_nav').click(function(){
		var container = $('.container');
		if($('.attract_loop').hasClass('active')){

		} else if($(container).hasClass('stuff_moving')){

		} else {
			var active_section = $('.content_section.active');
			var active_nav = $('.navigation .context_nav.active');
			var active_icon = $(active_section).find('.single_icon.active');
			var active_icon_type = $(active_icon).find('div').attr('class');
			var goto_nav = $(this);
			var index = $('.navigation .context_nav').index( goto_nav );
			var goto_section = $('.content_section').eq( index );
			var checkbox = $(goto_section).find('.expanded.active').find('.checkbox');
			if($('.intro_screen').hasClass('active')){
				$(container).addClass('stuff_moving');
				$('.intro_screen').removeClass('active');
				$('.info_nav').removeClass('active');
				$(goto_section).addClass('active');
				$(goto_nav).addClass('active');
				$('.intro_content h1').fadeOut(1000);
				$('.intro_content p').fadeOut(1000, function(){
					$('.intro_screen .intro_content').animate({
						'width' : '31.25%',
						'right' : '6.25%'
					},1000, function(){
						$(goto_section).fadeIn(1000, function(){
							$(goto_section).find('.beacons').fadeIn(1000, function(){
								$(goto_section).find('.object_icon').each(function(){
									var borderColor = $(this).css('borderColor');
									$(this).animate({
										boxShadow : '0px 0px 15px 3px ' + borderColor
									},1000, function(){
										$(this).animate({
											boxShadow : 'none'
										},1000);
									});	
								});
							});
							if($(checkbox).hasClass('checked')){
								$(goto_section).find('.expanded.active').find('.labels.non_full_map').fadeIn(250);
							}
							
						});
						$('.intro_screen').fadeOut(1000);
					});
				});
				$('.intro_map').animate({
					'width': 3052.15625,
					'height' : 2340,
					'top' : '-98%',
					'left' : '-75%',
					'opacity' : 0
				}, 3000, 'easeInOutCubic');
				setTimeout(function(){
					$(container).removeClass('stuff_moving');
				}, 5100);
				

			} else {
				if($(goto_nav).hasClass('active')){
					$(active_section).find('.context_icon').trigger('click');
				} else {
					$(active_section).find('.context_icon').trigger('click');

					$(active_nav).removeClass('active');
					$(goto_nav).addClass('active');
					$(goto_section).addClass('active');
					$(active_section).find('.beacons').fadeOut(500);
					$(active_section).find('.labels').fadeOut(500);
					$(goto_section).find('.beacons').hide();
					$(active_section).removeClass('active').fadeOut(500, function(){
						$(goto_section).fadeIn(500, function(){
							if(active_icon_type === 'context_icon'){
								$(goto_section).find('.beacons').fadeIn(1000, function(){
									setTimeout(function(){
										$(goto_section).find('.object_icon').each(function(){
											var borderColor = $(this).css('borderColor');
											$(this).animate({
												boxShadow : '0px 0px 15px 3px ' + borderColor
											},1000, function(){
												$(this).animate({
													boxShadow : 'none'
												},1000);
											});	
										});
									}, 1000);
								});
							} else {
								setTimeout(function(){
									$(goto_section).find('.beacons').fadeIn(1000);
									if($(checkbox).hasClass('checked')){
										$(goto_section).find('.expanded.active').find('.labels.non_full_map').fadeIn(250);
									}
									setTimeout(function(){
										$(goto_section).find('.object_icon').each(function(){
											var borderColor = $(this).css('borderColor');
											$(this).animate({
												boxShadow : '0px 0px 15px 3px ' + borderColor
											},1000, function(){
												$(this).animate({
													boxShadow : 'none'
												},1000);
											});	
										});
									}, 1000);
								},2000);
							}
						});
					});

					if(active_icon_type === 'context_icon'){
					} else {
						var map = $('.context_map');
						map.animate({
							'left' : 0,
							'top' : 0,
							'width' : 1600,
							'height' : 900,
						}, 3000, 'easeInOutCubic', function(){
						});
					}
				}
			}
		}
		
	});
	$('.context_map.big').removeClass('big');
	$('.single_icon').click(function(){
		var container = $('.container');
		if($(container).hasClass('stuff_moving')){

		} else {
			var active_icon = $('.content_section.active .single_icon.active');
			var icon = $(this);
			var index = $('.content_section.active .icons .single_icon').index( icon );
			var icon_type = $(icon).find('div').attr('class');
			var active_icon_type = $(active_icon).find('div').attr('class');
			var active_expanded = $('.content_section.active .expanded.active');
			var expanded = $('.content_section.active .expanded').eq( index );
			$(container).addClass('stuff_moving');

			if($(icon).hasClass('active')){

			} else {
				$(active_expanded).find('.collapse_map').trigger('click');
				$(active_icon).removeClass('active');
				$(icon).addClass('active');
				$(active_expanded).removeClass('active');
				$(expanded).addClass('active');
				$(expanded).find('.gallery_thumb:first-of-type').trigger('click');

				$(active_icon).animate({
					'background-color': 'rgb(182,175,166)'
				},700, function(){
				});
				
				$(icon).animate({
					'background-color': 'rgb(225,219,206)'
				},700, function(){
				});

				if(icon_type === 'object_icon') {
					if(active_icon_type === 'context_icon'){
	//					$('.single_content').css('z-index',20);
					}
					$(active_expanded).find('h1').fadeOut(500);
					$(active_expanded).find('h2').fadeOut(500);
					$(active_expanded).find('.images').fadeOut(500);
					$(active_expanded).find('.content').fadeOut(500, function(){
						$(active_expanded).css('z-index',20).fadeOut(700);
						$(expanded).css('z-index',30).fadeIn(300, function(){
							if(active_icon_type === 'context_icon'){
								$(expanded).find('.object_content').animate({
									'width' : '68.75%',
								}, 500, function(){
									$('.object_content').css('width','68.75%');
									$(expanded).find('h1').fadeIn(500);
									$(expanded).find('h2').fadeIn(500);
									$(expanded).find('.images').fadeIn(500);
									$(expanded).find('.triangle').fadeIn(500, function(){
										$('.triangle').show();
									});
									$(expanded).find('.content').fadeIn(500, function(){
										setTimeout(function(){
	//										$('.single_content').css('z-index','');
										}, 1925);
										$(expanded).find('.locator').show().animate({
											'left' : '0',
										},2000, function(){
											$('.locator').css('left','0').show();
											$('.context_map').addClass('big');

											var borderColor = $(expanded).find('.map_button').css('borderColor');
											$(expanded).find('.map_button').animate({
												boxShadow : '0px 0px 15px 3px ' + borderColor
											},250, function(){
												$(expanded).find('.map_button').animate({
													boxShadow : 'none'
												},250);
											});

										});
										$(active_expanded).css('z-index', '');
										$(expanded).css('z-index', '');
									});
								});
							} else {
								$('.object_content').css('width','68.75%');
								$(expanded).find('h1').fadeIn(500);
								$(expanded).find('h2').fadeIn(500);
								$(expanded).find('.images').fadeIn(500);
								$(expanded).find('.content').fadeIn(500, function(){
									setTimeout(function(){
	//									$('.single_content').css('z-index','');
									}, 1925);

									$('.locator').css('left','0');

									var borderColor = $(expanded).find('.map_button').css('borderColor');

								});
								$(active_expanded).css('z-index', '');
								$(expanded).css('z-index', '');
							}
						});
					});

					var x_cord = $(icon).find('.x_cord').text();
					var y_cord = $(icon).find('.y_cord').text();

					if($('.content_section.active .expanded.active .label_bar .checkbox').hasClass('checked')){
						$(active_expanded).find('.labels.non_full_map').fadeOut(250);
					}
					if(active_icon_type === 'context_icon'){
						$(active_expanded).find('.beacons').fadeOut(250, function(){
							navigateto(x_cord, y_cord, 8);
						});
					} else {
						navigateto(x_cord, y_cord, 8);
					}

				} else if (icon_type === 'context_icon') {
					$('.context_map').removeClass('big');
	//				$(active_expanded).find('.single_content').css('z-index','20');
					$(active_expanded).find('.locator').animate({
						'left' : '62.5%',
					},1000, function(){
						$('.locator').css('left','62.5%').hide();
						$(active_expanded).find('h1').fadeOut(500);
						$(active_expanded).find('h2').fadeOut(500);
						$(active_expanded).find('.images').fadeOut(500);
						$(active_expanded).find('.triangle').fadeOut(500, function(){
							$('.triangle').hide();
						});
						$(active_expanded).find('.content').fadeOut(500, function(){
							$(active_expanded).find('.object_content').animate({
								'width' : '31.25%',
							}, 500, function(){
								$('.object_content').css('width','31.25%');
								$(active_expanded).css('z-index',20).fadeOut(700);
								$(expanded).css('z-index',30).fadeIn(300, function(){
									$(expanded).find('h1').fadeIn(500);
									$(expanded).find('h2').fadeIn(500);
									$(expanded).find('.images').fadeIn(500);
									$(expanded).find('.content').fadeIn(500, function(){
	//									$('.single_content').css('z-index','');
										$(active_expanded).css('z-index', '');
										$(expanded).css('z-index', '');
									});
								});
							});
						});
					});

					var map = $('.context_map');
					$(active_expanded).find('.labels.non_full_map').fadeOut(250, function(){
						map.animate({
							'left' : 0,
							'top' : 0,
							'width' : 1600,
							'height' : 900,
						}, 3000, 'easeInOutCubic', function(){
							$(expanded).find('.beacons').fadeIn(250);
							if($('.label_bar .checkbox').hasClass('checked')){
								$(expanded).find('.labels.non_full_map').fadeIn(250);
							}
						});
					});
				}
			}
			setTimeout(function(){
				$(container).removeClass('stuff_moving');
			}, 3000);
		}
	});
	$('.beacon').click(function(){
		var beacon = $(this);
		var index = $('.content_section.active .beacons .beacon').index( beacon );
		var click_this = $('.content_section.active .icons .single_icon').eq( index + 1 );
		$(click_this).trigger('click');
	});
	


	$('.label_bar .checkbox').click(function(){
		if($(this).hasClass('checked')){
			$('.label_bar .checkbox').removeClass('checked').addClass('unchecked');
			$('.labels').hide();
		} else if ($(this).hasClass('unchecked')){
			$('.label_bar .checkbox').removeClass('unchecked').addClass('checked');
			$('.content_section.active .expanded.active').find('.labels').show();
			$('.content_section.active .expanded.active .condensed .labels').hide();
		}
	});
	$('.german_checkbox').click(function(){
		if($(this).hasClass('checked')){
			$(this).removeClass('checked').addClass('unchecked');
			$('.german_map').hide();
		} else {
			$(this).removeClass('unchecked').addClass('checked');
			$('.german_map').show();
		}
	});

	$('.expand_map').click(function(){
		$(this).next('.full_map').removeClass('condensed');
		$('.content_section.active .expanded.active .small_map .full_map').css('z-index',30).css('border-right','1px solid #e1dbce').animate({
			'width' : 1499,
			'height' : 852,
			'background-color' : 'rgb(182, 175, 166)'
		}, 500, function(){
			if($('.label_bar .checkbox').hasClass('checked')){
				$('.content_section.active .expanded.active .small_map .full_map .labels').fadeIn(500);
			}
		});
		$('.content_section.active .expanded.active .small_map .full_map img').animate({
			'opacity' : 1
		}, 500);
		$('.content_section.active .expanded.active .small_map .full_map .collapse_map').fadeIn(500);
		$('.content_section.active .expanded.active .small_map .full_map .label_bar').fadeIn(500);
	});
	$('.collapse_map').click(function(){
		$(this).parent('.full_map').addClass('condensed');
		var active_expanded = $('.content_section.active .expanded.active');
		$(active_expanded).find('.small_map .full_map .labels').fadeOut(500, function(){
			$(active_expanded).find('.small_map .full_map .label_bar').fadeOut(500);
			$(active_expanded).find('.small_map .full_map').css('border-right','none').animate({
				'width' : 200,
				'height' : 113,
				'background-color' : 'rgb(146, 140, 133)'
			}, 500, function(){
				$(this).css('z-index','');
			});
			$(active_expanded).find('.small_map .full_map img').animate({
				'opacity' : 0.8
			}, 500);
			$(active_expanded).find('.small_map .full_map .collapse_map').fadeOut(500);
		});
	});
	$('.lightbox_trigger').click(function(){
		var index = $(this).parent().find('.lightbox_trigger').index( this );
		var lightbox_content = $(this).parent().find('.lightbox_content').eq( index );
		var lightbox_html = $(lightbox_content).html();
		var link_color = $(this).parent().parent().parent().find('.content').find('h1').css('color');
		$('.the_lightbox .content').html(lightbox_html);
		if($(lightbox_content).hasClass('image_content')){
			var image_width = $(lightbox_content).find('img').width();
			var image_height = $(lightbox_content).find('img').height();
			$('.the_lightbox .content').width(image_width);
			$('.the_lightbox .close').css('border-color', link_color).css('color', link_color);
			$('.the_lightbox').fadeIn(500);
			var text_height = $('.the_lightbox .content .image_caption').height()+20;
			var content_height = image_height + text_height;
			$('.the_lightbox .content').height(content_height);
		} else if ($(lightbox_content).hasClass('text_content')){
			var content_width = $(lightbox_content).find('.content').width()+30;
			var content_height = $(lightbox_content).find('.content').height()+30;
			$('.the_lightbox .content').width(content_width).height(content_height);
			$('.the_lightbox .close').css('border-color', link_color).css('color', link_color);
			$('.the_lightbox').fadeIn(500);
			$('.the_lightbox .content_column').columnize({width:512.250, accuracy:1});

		}
	});
	$('.lightbox_text_trigger').click(function(){
		var index = $(this).parent().parent().find('.lightbox_text_trigger').index( this );
		var lightbox_content = $(this).parent().parent().find('.lightbox_content').eq( index );
		var lightbox_html = $(lightbox_content).html();
		var link_color = $(this).parent().parent().parent().parent().find('.content').find('h1').css('color');
		$('.the_lightbox .content').html(lightbox_html);
		if($(lightbox_content).hasClass('image_content')){
			var image_width = $(lightbox_content).find('img').width();
			var image_height = $(lightbox_content).find('img').height();
			$('.the_lightbox .content').width(image_width);
			$('.the_lightbox .close').css('border-color', link_color).css('color', link_color);
			$('.the_lightbox').fadeIn(500);
			var text_height = $('.the_lightbox .content .image_caption').height()+20;
			var content_height = image_height + text_height;
			$('.the_lightbox .content').height(content_height);
		} else if ($(lightbox_content).hasClass('text_content')){
			var content_width = $(lightbox_content).find('.content').width()+30;
			var content_height = $(lightbox_content).find('.content').height()+30;
			$('.the_lightbox .content').width(content_width).height(content_height);
			$('.the_lightbox .close').css('border-color', link_color).css('color', link_color);
			$('.the_lightbox').fadeIn(500);
			$('.the_lightbox .content_column').columnize({width:512.250, accuracy:1});

		}
	});
	$('.the_lightbox .close').click(function(){
		$('.the_lightbox').fadeOut(500, function(){
			$('.the_lightbox .content').html('');
		});
	});

	// OBJECT IMAGE GALLERY
	$('.gallery_thumb').click(function(){
		var that = $(this);
		if($(that).hasClass('active')){

		} else {
			var index = $('.expanded.active .gallery_thumbs .gallery_thumb').index( that );
			var new_image = $('.expanded.active .image_gallery .lightbox_trigger').eq( index );
			var new_caption = $( new_image ).next( '.image_caption' );
			$('.expanded.active .gallery_thumb.active').removeClass('active');
			$('.expanded.active .image_gallery .lightbox_trigger').hide();
			$('.expanded.active .image_gallery .image_caption').hide();
			$('.expanded.active .image_gallery .lightbox_content .image_caption').show();
			$(new_image).show();
			$(new_caption).show();
			$(that).addClass('active');
		}
	});
});