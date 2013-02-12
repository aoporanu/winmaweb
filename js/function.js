//Pirobox
jQuery(document).ready(function(){
	jQuery('.pirobox').each(function(){
			jQuery('img',this).animate({
					opacity:1
			},0);
	});

	jQuery('img','.pirobox').hover(function(){
			jQuery(this).stop().animate({
					opacity:0.4
			},500);
	},function(){
			jQuery(this).stop().animate({
					opacity:1
			},300);
	});

	jQuery('.images img').hover(function(){
			jQuery('img',this).stop().animate({
					opacity:0.4
			},500);
	},function(){
			jQuery('img',this).stop().animate({
					opacity:1
			},300);
	});
});