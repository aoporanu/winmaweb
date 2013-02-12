function changepic() {
	
	if (lang == 'de') {
		var lastpic = 'gethelp'
	} else {
		var lastpic = 'showpress'
	}
	
	var activepic = $('#carousel div:visible');
	if ( activepic.attr('id') != lastpic ) {
		activepic.next().show();
		var picname = activepic.next().attr('id');
		$('#carousel ul.nav li a').removeClass('selected');
		$('#carousel ul.nav li[rel="' + picname + '"] a').addClass('selected');
	} else {
		$('#logos').show();
		$('#carousel ul.nav li a').removeClass('selected');
		$('#carousel ul.nav li[rel="logos"] a').addClass('selected');
	}
	activepic.hide();
}

$(document).ready(function() {

	
	
	
	$('.transition').cycle({ 
		fx:     'fade', 
		timeout: 5000,
		pager:  '#carousel-nav ul',
	    pagerAnchorBuilder: function(idx, slide) {
	        // return sel string for existing anchor
	        return '#carousel-nav ul li:eq(' + (idx) + ') a';
		},
		pause:	true
	});
	
	function onBefore() { 
		var pos = $(".activeSlide").next().offset().top; //get position of the element *after* .activeSlide
		$("#marker").animate({top: pos}); //move marker to this position
	};
	
	$('#carousel-nav ul li:eq(0)').click(function() { 
		$('.transition').cycle(0); 
		return false; 
	});
	
	$('#carousel-nav ul li:eq(1)').click(function() { 
		$('.transition').cycle(1); 
		return false; 
	});
	
	$('#carousel-nav ul li:eq(2)').click(function() { 
		$('.transition').cycle(2); 
		return false; 
	});
	
	$('#carousel-nav ul li:eq(3)').click(function() { 
		$('.transition').cycle(3); 
		return false; 
	});
        
        $("a[rel^='prettyPhoto']").prettyPhoto();
});