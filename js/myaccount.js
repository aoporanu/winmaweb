var mda = window.location.hash.replace(/#/,'');
mda = mda.replace(/!/,'');
if(mda != '') {
    document.location.href = mda;
}

function initTinymce(){
    $('textarea.tinymce').tinymce({
            // Location of TinyMCE script
            script_url : '/tiny_mce/tiny_mce.js',

            // General options
            theme : "advanced",
            mode : "textareas",
		setup : function(ed) {
			ed.onPaste.add( function(ed, e, o) {
                        // return tinymce.dom.Event.cancel(e);
                                    //tinymce.execCommand('mcePasteText');
                                    } );
                            }, 

            plugins : "bbcode,safari,pagebreak,paste,media,style,layer,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            //theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,forecolor,cleanup,code",
						theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,cleanup",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",

            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,
            //entity_encoding : "raw",
            theme_advanced_resizing_max_width : 400,
            theme_advanced_blockformats:"",
            //inline_styles : false,
            force_br_newlines : true,
            force_p_newlines : false,
            forced_root_block : '', // Needed for 3.x
            //object_resizing : false,
            remove_linebreaks : false,
            //convert_newlines_to_brs : false,
            paste_auto_cleanup_on_paste : true,
            paste_convert_headers_to_strong : false,
            paste_strip_class_attributes : "all",
            paste_remove_spans : true,
            paste_remove_styles : true,
            //convert_newlines_to_brs : true,
            paste_preprocess : function(pl, o) {

    },
    paste_postprocess : function(pl, o) {
               tinymce.execCommand('mcePasteText');
    }

            //paste_strip_class_attributes: true,
    });
}

$(function() {
    var started = false;
    
    $('.ma_menu li a').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        if(url == '#') {
            return false;
        }
				if (m.hasClass("modal-refvisual")) {
					return false;
				}
        $.ajax({
            url: url,
            beforeSend: function(){
                if(!started){
                $('#ajax-content').append('<div class="overlay"><!--<div class="context-loader">Please wait</div>--></div>');
                $('.overlay').css('width', $('#ajax-content').width()).css('height', $('#ajax-content').height());
                $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                }
                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
					$.scrollTo('#ajax-content', {
						duration:1000
					});
                }
                m.addClass('over');
                started = true;
            },
            success: function(data){
                $('#hello_bar').remove();
                $('.ma_menu li').each(function(kye, value) {
                    var t = $(value).find('.selected');
                    t.removeClass('selected');

                });
                m.removeClass('over');
                m.addClass('selected');
                if(data.ajaxRedir) {
                    document.location.href = data.ajaxRedir;
                } else {
                    $('#ajax-content').animate({
                        opacity: 0
                        //height:'0'
                      }, 400, 'linear', function() {
                          $('#ajax-content').html(data)
                          $('#ajax-content').animate({
                                //height: '100%',
                                opacity: 1
                              }, 400, 'linear', function() {
                              });
                      });
                    
                    window.location.hash = '!' + url;
                }
                
                started = false;
            },
            error: function(jqXHR, textStatus, errorThrown){
            },
            statusCode: {
                404: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay').remove();
                    $('.ma_menu li').each(function(kye, value) {
                        var t = $(value).find('.selected');
                        t.removeClass('selected');

                    });
                    m.removeClass('over');
                    $('#ajax-content').html('This page do not exist!');
                },
                403: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay').remove();
                    $('.ma_menu li').each(function(kye, value) {
                        var t = $(value).find('.selected');
                        t.removeClass('selected');

                    });
                    m.removeClass('over');
                    $('#ajax-content').html('You dont not have access to this page!');
                }
              }
        });
    });
	var stime;
    var ntime
    $('.p_timer_content').each(function(key, value) {
        stime = new Date($('.p_timer_content span').last().text());
        ntime = new Date($('.p_timer_content span').first().text());
//        $(this).countdown({until: ntime, onTick: timerPbar, format: 'HMS'});
		$(this).countdown({
			until: ntime, 
			onTick: timerPbar
		});
    });
    
    
    function timerPbar(perriods) {
	    var days = perriods[3];
	    var hours = perriods[4];
	    var minutes = perriods[5];
	    var seconds = perriods[6];
	    
	    if($('#progressbar').length>0) {
	        if (days > 0 || hours > 0 || minutes > 0) {
	            //return;
	        }
	        if(days > 0) {
	            realDif = date_between(ntime,stime, 1000 * 60 * 60 * 24);
	            percent = (100/realDif)*(realDif-days);
	        } else if(hours > 0) {
	            realDif = date_between(ntime,stime, 1000 * 60 * 60);
	            percent = (100/realDif)*(realDif-hours);
	        } else if(minutes > 0) {
	            realDif = date_between(ntime,stime, 1000 * 60);
	            percent = (100/realDif)*(realDif-minutes);
	        } else if(seconds >= 0) {
	            realDif = date_between(ntime,stime, 1000 * 60);
	            percent = (100/realDif)*(realDif-seconds);
	            if (seconds == 0) {
	                percent = 100;
	            }
	        }
	
	        $("#progressbar").progressbar({
	            value: percent,
	            create: function(event, ui) {
	                
	            }
	        });
	    }
	}

	function date_between(date1, date2, diff) {
	
	    // The number of milliseconds in one day
	    var ONE_DAY = diff;
	
	    // Convert both dates to milliseconds
	    var date1_ms = date1.getTime()
	    var date2_ms = date2.getTime()
	
	    // Calculate the difference in milliseconds
	    var difference_ms = Math.abs(date1_ms - date2_ms)
	
	    // Convert back to days and return
	    return Math.round(difference_ms/ONE_DAY)
	}

    $('.modal-addprod').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.text();
        $().modal({
            'boxType': 'ajaxBox',
            'width': 720,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){
                var p_price = $('#producer_price').val();
                var discount = $('#discount').val();

                $('#product_price').text(((p_price - (p_price*discount/100)))+' $');
            }
        });
    });
    
    $('.modal-prodgal').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.text();
        $().modal({
            'boxType': 'ajaxBox',
            'width': 470,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){
            }
        });
    });
    
    $('.modal-normal').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        $().modal({
            'boxType': 'ajaxBox',
            'width': 570,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){
            }
        });
    });
    
    $('.modal-normal-with-close').live('click', function(e) {
    	e.preventDefault();
    	var m = $(this);
    	var url = m.attr('href');
    	var title = m.attr('title');
    	$().modal({
    		'boxType': 'ajaxBox',
    		'width': 570,
    		'modalTitle': title,
    		'ajaxUrl': url,
    		'onSuccess': function() {
    			setTimeout('5000');
    			$('#modal-popup-1').remove();
    			location.reload(true);
    		}
    	});
    });
    
    $('.modal-refvisual').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.text();
        $().modal({
            'boxType': 'ajaxBox',
            'width': 870,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){
            }
        });
    });
    
    /*
     * Datetime picker
     */
    
    $('#start_time, #end_time').live('focusin focusout', function(e){
        var cur = $(this);
        $('#start_time').datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: 'hh:mm'
            
            //minDate:+0,
            /*onClose: function(dateText, inst) {
				var tempDate = $('#start_time').val(dateText);
				$('#start_time').timepickr({
					onClose: function(timeText, inst) {
						var tempTime = $("#start_time").val(dateText);  
						alert("Temp Time: '" + tempTime.val() + "'");
						$("#start_time").val(tempDate.val() + ' ' + tempTime.val());
					}
                /*var endDateTextBox = $('#end_time');
                if (endDateTextBox.val() != '') {
                    var testStartDate = new Date(dateText);
                    var testEndDate = new Date(endDateTextBox.val());
                    if (testStartDate > testEndDate)
                        endDateTextBox.val(dateText);
                }
                else {
                    endDateTextBox.val(dateText);
                }
            },
            onSelect: function (selectedDateTime){
                var start = $(this).datetimepicker('getDate');
                $('#end_time').datetimepicker('option', 'minDate', new Date(start.getTime()));
            }*/
        });
        $('#end_time').datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: 'hh:mm'
            
            //minDate:+0,
            /*onClose: function(dateText, inst) {
                var startDateTextBox = $('#start_time');
                if (startDateTextBox.val() != '') {
                    var testStartDate = new Date(startDateTextBox.val());
                    var testEndDate = new Date(dateText);
                    if (testStartDate > testEndDate)
                        startDateTextBox.val(dateText);
                }
                else {
                    startDateTextBox.val(dateText);
                }
            },
            onSelect: function (selectedDateTime){
                var end = $(this).datetimepicker('getDate');
                $('#start_time').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
            }*/
        });
    });
    
    $('#category').live('change', function(e){
        var m = $(this);
        
        $.ajax({
            url: '/my-account/my-offers/getsubc?id='+m.val(),
            beforeSend: function(){
                $('#subcategory').html('<option value="-1">Plese wait...</option>');
            },
            success: function(data){
                $('#subcategory').html(data);
            },
            error: function(){
            }
        });
    })
    
    $('.modal-submit-product').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
		var modalOptions = $().modal({
			'boxType': 'getOptions'
		});

        var options = { 
            //target: ,   // target element(s) to be updated with server response 
            beforeSubmit: function(){
                $("#isajaxrequest").attr("value", 1);
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
              
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
					$.scrollTo(modalId, {
						duration:1000
					});
                }
            },
            success: function(response){
                
                if(response.ajaxRedir) {
                    document.location.href = response.ajaxRedir;
                } else {
                    
                    $('#modal-popup-' + modalOptions + ' .modal-content').html(response);

                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    
                    var p_price = $('#producer_price').val();
                    var discount = $('#discount').val();

                    $('#product_price').text(((p_price - (p_price*discount/100)))+' $');
                    
                    if ($().tinymce) {
                        initTinymce();
                    }
                    if ($().tagsInput) {
                        $('#tags').tagsInput({
                            autocomplete_url: '/get-tags',
							autocomplete: {
								selectFirst:true,
								width:'100px',
								autoFill:true
							}
                        });
                    }
                    if(window.location.hash != '')
                    {
                            var url = window.location.hash.replace(/\#/, '');
                            url = url.replace(/\!/, '');
                            var h = window.location.hash;
                    }else{
                            var url = document.location.pathname + document.location.search;
                            var h = '!' + document.location.pathname + document.location.search;
                    }

                    $.ajax({
                            url: url,
                            beforeSend: function(){
                                $('#ajax-content').append('<div class="overlay"><div class="context-loader">Please wait</div></div>');
                                $('.overlay').css('width', $('#ajax-content').width()+10).css('height', $('#ajax-content').height()+10)
                            },
                            success: function(data){
                                    $('#ajax-content').html(data);
                                    window.location.hash = h;
                            },
                            error: function(){
                            }
                    });

                    started = false;
                }
            },
            statusCode: {
                404: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('This page do not exist!');
                },
                403: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('You dont not have access to this page!');
                }
              }
        }; 

        // bind form using 'ajaxForm' 
        $(this).closest('form').ajaxSubmit(options);
        return false;
    });
    
	$('.ajax-link, .pagination li a, .pag_cal').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        $.ajax({
            url: url,
            beforeSend: function(){
                if(!started){
                $('#ajax-content').append('<div class="overlay"><!--<div class="context-loader">Please wait</div>--></div>');
                $('.overlay').css('width', $('#ajax-content').width()).css('height', $('#ajax-content').height());
                $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                }
                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
					$.scrollTo('#ajax-content', {
						duration:1000
					});
                }
                m.addClass('over');
                started = true;
            },
            success: function(data){
                $('#hello_bar').remove();
                if(data.ajaxRedir) {
                    document.location.href = data.ajaxRedir;
                } else {
                    $('#ajax-content').animate({
                        opacity: 0
                        //height:'0'
                      }, 400, 'linear', function() {
                          $('#ajax-content').html(data)
                          $('#ajax-content').animate({
                                //height: '100%',
                                opacity: 1
                              }, 400, 'linear', function() {
                              });
                      });
                    
                    window.location.hash = '!' + url;
                }
                
                started = false;
            },
            error: function(jqXHR, textStatus, errorThrown){
            },
            statusCode: {
                404: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay').remove();
                    $('#ajax-content').html('This page do not exist!');
                },
                403: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay').remove();
                    $('#ajax-content').html('You dont not have access to this page!');
                }
              }
        });
    })
    
    /*
     *  Calculate price
     **/
    $('#producer_price, #discount').live('focusin focusout', function(e){
        var p_price = $('#producer_price').val();
        var discount = $('#discount').val();
        
        $('#product_price').text(((p_price - (p_price*discount/100)))+' $');
    });
    
    function roundNumber2(num, dec) {
      var result = String(Math.round(num*Math.pow(10,dec))/Math.pow(10,dec));
		if(result.indexOf('.')<0) {
			result+= '.';
		}
		while(result.length- result.indexOf('.')<=dec) {
			result+= '0';
		}
      return result;
    }
    
    $('.modal-ajax-link, .pagination-modal li a').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
		var modalOptions = $().modal({
			'boxType': 'getOptions'
		});
        
		$.ajax({
			url: url,
			beforeSend: function(){
				$('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
				$('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
				var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
				if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
					$.scrollTo(modalId, {
						duration:1000
					});
                }
            },
            success: function(data){
                $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                $('#modal-popup-' + modalOptions + ' .modal-content').html(data);
                
                if(window.location.hash != '')
                {
                        var url = window.location.hash.replace(/\#/, '');
                        url = url.replace(/\!/, '');
                        var h = window.location.hash;
                }else{
                        var url = document.location.pathname + document.location.search;
                        var h = '!' + document.location.pathname + document.location.search;
                }

                $.ajax({
                        url: url,
                        beforeSend: function(){
                            $('#ajax-content').append('<div class="overlay"><div class="context-loader">Please wait</div></div>');
                            $('.overlay').css('width', $('#ajax-content').width()+10).css('height', $('#ajax-content').height()+10)
                        },
                        success: function(data){
                                $('#ajax-content').html(data);
                        },
                        error: function(){
                        }
                });
                started = false;
            },
            error: function(jqXHR, textStatus, errorThrown){
            },
            statusCode: {
                404: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('This page do not exist!');
                },
                403: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('You dont not have access to this page!');
                }
              }
        });
    });
    
    $('.ajax-del').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        $().modal({
            'boxType': 'confirmationBox',
            'width': 300,
            'modalTitle': 'Confirmation',
            'modalContent': 'Are you sure you want to delete?',
            'onConfirm': function(){
                        $.ajax({
                            url: url,
                            beforeSend: function(){
                                if(!started){
                                    $('#ajax-content').append('<div class="overlay"><!--<div class="context-loader">Please wait</div>--></div>');
                                    $('.overlay').css('width', $('#ajax-content').width()).css('height', $('#ajax-content').height());
                                    $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                                }
                                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
							$.scrollTo('#ajax-content', {
								duration:1000
							});
                                }
                                started = true;
                            },
                            success: function(data, textStatus, jqXHR){
                                $('#hello_bar').remove();
                                if(data.ajaxRedir) {
                                    document.location.href = data.ajaxRedir;
                                } else {
                                    $('#ajax-content').animate({
                                        opacity: 0
                                        //height:'0'
                                      }, 400, 'linear', function() {
                                          $('#ajax-content').html(data)
                                          $('#ajax-content').animate({
                                                //height: '100%',
                                                opacity: 1
                                              }, 400, 'linear', function() {
                                              });
                                      });
                                }

                                started = false;   
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                            },
                            statusCode: {
                                404: function() {
                                    $('#hello_bar').remove();
                                    $('#ajax-content .overlay').remove();
                                    $('#ajax-content').html('This page do not exist!');
                                },
                                403: function() {
                                    $('#hello_bar').remove();
                                    $('#ajax-content .overlay').remove();
                                    $('#ajax-content').html('You dont not have access to this page!');
                                }
                              }
                });
            }

        });
    });
    
    $('.ajax-confirm').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var t = m.attr('title');
        $().modal({
            'boxType': 'confirmationBox',
            'width': 300,
            'modalTitle': 'Confirmation',
            'modalContent': t,
            'onConfirm': function(){
                        $.ajax({
                            url: url,
                            beforeSend: function(){
                                if(!started){
                                    $('#ajax-content').append('<div class="overlay"><!--<div class="context-loader">Please wait</div>--></div>');
                                    $('.overlay').css('width', $('#ajax-content').width()).css('height', $('#ajax-content').height());
                                    $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                                }
                                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
							$.scrollTo('#ajax-content', {
								duration:1000
							});
                                }
                                started = true;
                            },
                            success: function(data, textStatus, jqXHR){
                                $('#hello_bar').remove();
                                if(data.ajaxRedir) {
                                    document.location.href = data.ajaxRedir;
                                } else {
                                    $('#ajax-content').animate({
                                        opacity: 0
                                        //height:'0'
                                      }, 400, 'linear', function() {
                                          $('#ajax-content').html(data)
                                          $('#ajax-content').animate({
                                                //height: '100%',
                                                opacity: 1
                                              }, 400, 'linear', function() {
                                              });
                                      });
                                }

                                started = false;   
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                            },
                            statusCode: {
                                404: function() {
                                    $('#hello_bar').remove();
                                    $('#ajax-content .overlay').remove();
                                    $('#ajax-content').html('This page do not exist!');
                                },
                                403: function() {
                                    $('#hello_bar').remove();
                                    $('#ajax-content .overlay').remove();
                                    $('#ajax-content').html('You dont not have access to this page!');
                                }
                              }
                });
            }

        });
    });
    
    $('.add-price').live('click', function(e){
        e.preventDefault();
        var no = $('.price-box').length;
        no = no + 1
        $('.remove-price').remove();
        $('.prices-box').append('<div class="price-box"><input name="price[]" id="price" value="1" type="hidden">'
				+ '<div style="float: right;"><strong>This is the Price #'+no+' of the Deal Offer</strong></div>'
				+ '<div class="clear"></div>'
        +'<div style="border:1px solid #cacaca;padding:5px;margin:10px 0;">'
        +'    <div class="clearfix">'
        +'    <div class="label label_big"><label for="offer_price_name_'+no+'">Name of Deal Offer #'+no+':</label></div>'
       +'     <div class="input">'
         +'           <input name="offer_price_name_'+no+'" id="offer_price_name_'+no+'" value="" size="20" type="text">'
         +'   </div>'
         +'   </div>'
			 +'<div class="clearfix">'
				+'	<div class=" label label_big"></div>'
				+'			<div class="input">'
				+'				<div style="color:#666">This is the name of the deal offer under the First Price it will have (This is to allow Merchants to change the pricing on the same deal, but for example at different times)  Eg. A Merchant wishes to sell a vacation package at one price on weekends, another on weekdays.</div>'
				+'			</div>'
				+'		</div>'
        +'    <div class="clearfix">'
        +'    <div class="label label_big"><label for="producer_price_'+no+'">Original Price:</label></div>'
       +'     <div class="input">'
         +'           <input name="producer_price_'+no+'" id="producer_price_'+no+'" value="" size="20" type="text">'
         +'   </div>'
         +'   </div>'
				+'<div class="clearfix">'
				+'			<div class=" label label_big"></div>'
				+'			<div class="input">'
				+'				<div style="color:#666">Note: This is the normal cost of the product or service you are providing through WinMaWeb before any discounts are applied.</div>'
				+'			</div>'
				+'		</div>'
         +'   <div class="clearfix">'
         +'   <div class="label label_big"><label for="discount_'+no+'">Discount %:</label></div>'
         +'   <div class="input">'
         +'           <input name="discount_'+no+'" id="discount_'+no+'" value="" size="20" type="text">'
        +' </div>'
         +'   </div>'
			 +'<div class="clearfix">'
				+'			<div class=" label label_big"></div>'
				+'			<div class="input">'
				+'				<div style="color:#666">Please only input numbers with no units (no percentages, no currency symbols)</div>'
				+'			</div>'
				+'		</div>'
        +'    <div class="clearfix">'
         +'   <div class="label label_big"><label>Sale Price on WinMaWeb:</label></div>'
          +'  <div class="input" style="padding:4px;" id="product_price_'+no+'">$ <span class="s">0</span> <a href="#" class="calc" rel="'+no+'">Calculate</a></div>'
           +' </div>'
				 +'<div class="clearfix">'
					+'		<div class=" label label_big"></div>'
					+'		<div class="input">'
					+'			<div style="color:#666">This is the sale price that members will see and purchase at on WinMaWeb.</div>'
					+'		</div>'
					+'	</div>'
         +'   <div class="clearfix">'
         +'   <div class="label label_big"><label for="stock_'+no+'">WinMaWeb Stock:</label></div>'
         +'   <div class="input">'
         +'           <input name="stock_'+no+'" id="stock_'+no+'" value="" size="20" type="text">'
         +'   </div>'
         +'   </div>'
				 +'<div class="clearfix">'
					+'		<div class=" label label_big"></div>'
					+'		<div class="input">'
					+'			<div style="color:#666">This is the maximum number of deal offers that WinMaWeb may sell of your product and service.</div>'
					+'		</div>'
					+'	</div>'
            +'   <div class="clearfix">'
         +'   <div class="label label_big"><label for="expire_'+no+'">Price #'+no+' Expires on:</label></div>'
         +'   <div class="input">'
         +'           <input name="expire_'+no+'" id="expire_'+no+'" value="" size="20" type="text" class="exdate">'
         +'   </div>'
         +'   </div>'
				 +'<div class="clearfix">'
					+'		<div class=" label label_big"></div>'
					+'		<div class="input">'
					+'			<div style="color:#666">This is the Voucher expiration date and time.  The Voucher will no longer be redeemable after this date and time.</div>'
					+'		</div>'
					+'	</div>'
					+' <div class="remove-button"><a href="#" class="remove-price">Remove</a></div>'
       +' </div></div>');
    })
    
    $('.remove-price').live('click', function(e){
        e.preventDefault();
        var no = $('.price-box').length;
        if(no > 1) {
            $('.price-box:last-child').remove();
            var l = $('.price-box').length;
            if(l > 1) {
                $('.price-box:last-child .remove-button').html('<a href="#" class="remove-price">Remove</a>');
            }
        }
    });
    function roundNumber2(num, dec) {
      var result = String(Math.round(num*Math.pow(10,dec))/Math.pow(10,dec));
		if(result.indexOf('.')<0) {
			result+= '.';
		}
		while(result.length- result.indexOf('.')<=dec) {
			result+= '0';
		}
      return result;
    }
    $('.calc').live('click', function(e){
        e.preventDefault();
        var idd = $(this).attr('rel');
        var pr = $('#producer_price_'+idd).val();
        var dc = $('#discount_'+idd).val();
        $(this).prev().html(roundNumber2(pr - roundNumber2(pr*dc/100, 2), 2));
    });
    
		$('a.ui-state-default').live('click', function(e) {
			return false;
		});
    $('.exdate').live('focusin focusout', function(e){
        var cur = $(this);
        
        var dates = $( '#'+cur.attr('id') ).datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 3,
            minDate:+0,
            onSelect: function( selectedDate ) {
                var option = this.id == "start_date" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" ),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
    });
    
    /*
     * Modal ajax submit 2
     */
    
    $('.modal-ajax-submit-rel').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
		var modalOptions = $().modal({
			'boxType': 'getOptions'
		});
        var rel =  $(this).closest('form').attr('rel');
        
        var options = { 
            //target: ,   // target element(s) to be updated with server response 
            beforeSubmit: function(){
                $("#isajaxrequest").attr("value", 1);
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
              
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
					$.scrollTo(modalId, {
						duration:1000
					});
                }
            },
            success: function(response){
                
                if(response.ajaxRedir) {
                    document.location.href = response.ajaxRedir;
                } else {
                    
                    $('#modal-popup-' + modalOptions + ' .modal-content').html(response);

                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    
                    if(window.location.hash != '')
                    {
                            var url = window.location.hash.replace(/\#/, '');
                            url = url.replace(/\!/, '');
                            var h = window.location.hash;
                    }else{
                            var url = document.location.pathname + document.location.search;
                            var h = '!' + document.location.pathname + document.location.search;
                    }

                    $.ajax({
                            url: url,
                            beforeSend: function(){
                                $('#ajax-content').append('<div class="overlay"><div class="context-loader">Please wait</div></div>');
                                $('.overlay').css('width', $('#ajax-content').width()+10).css('height', $('#ajax-content').height()+10)
                            },
                            success: function(data){
                                    $('#ajax-content').html(data);
                                    window.location.hash = h;
                            },
                            error: function(){
                            }
                    });
                    
                    $.ajax({
                        url: rel,
                        beforeSend: function(){
                            $('#modal-popup-' + (modalOptions-1) + ' .modal-bg').append('<div class="overlay"><div class="context-loader">Please wait</div></div>');
                            $('.overlay').css('width', $('#modal-popup-' + (modalOptions-1) + ' .modal-bg').width()+10).css('height', $('#modal-popup-' + (modalOptions-1) + ' .modal-bg').height()+10)
                        },
                        success: function(data){
                                $('#modal-popup-' + (modalOptions-1) + ' .modal-bg .overlay').remove();
                                $('#modal-popup-' + (modalOptions-1) + ' .modal-content').html(data);
                        },
                        error: function(){
                        }
                    });
                
                    started = false;
                }
            },
            statusCode: {
                404: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('This page do not exist!');
                },
                403: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('You dont not have access to this page!');
                }
              }
        }; 

        // bind form using 'ajaxForm' 
        $(this).closest('form').ajaxSubmit(options);
        return false;
    });
    
    $('.acc').live('click', function(e){
        e.preventDefault();
        $(this).next().next('.sub_menu2').show('slow');
				$(this).next().next('.sub_menu3').show('slow');
        $(this).parent().addClass('sub_open')
    });
    
    $('.tog').live('click', function(e){
        e.preventDefault();
        $(this).next('ul').toggle('slow');
        $(this).parent().toggleClass('sub_open');
        return false;
    });
    
    
    
    
    
    $('.modal-submit-crop').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
		var modalOptions = $().modal({
			'boxType': 'getOptions'
		});
        var mda = $(this).attr('rel');
        var options = { 
            //target: ,   // target element(s) to be updated with server response 
            beforeSubmit: function(){
                $("#isajaxrequest").attr("value", 1);
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
              
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
					$.scrollTo(modalId, {
						duration:1000
					});
                }
            },
            success: function(response){
                //console.info(response);
                if(response.ajaxRedir) {
                    document.location.href = response.ajaxRedir;
                } else {
                    
                    $('#modal-popup-' + modalOptions + ' .modal-content').html(response);

                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    if(window.location.hash != '')
                    {
                            var url = window.location.hash.replace(/\#/, '');
                            url = url.replace(/\!/, '');
                            var h = window.location.hash;
                    }else{
                            var url = document.location.pathname + document.location.search;
                            var h = '!' + document.location.pathname + document.location.search;
                    }
                    $.ajax({
                            url: url,
                            beforeSend: function(){
                                $('#ajax-content').append('<div class="overlay"><div class="context-loader">Please wait</div></div>');
                                $('.overlay').css('width', $('#ajax-content').width()+10).css('height', $('#ajax-content').height()+10)
                            },
                            success: function(data){
							console.info(data);
                                    $('#ajax-content').html(data);
                                    window.location.hash = h;
                            },
                            error: function(){
                            }
                    });
                    $.ajax({
                            url: mda,
                            beforeSend: function(){
                                //$('#ajax-content').append('<div class="overlay"><div class="context-loader">Please wait</div></div>');
                                //$('.overlay').css('width', $('#ajax-content').width()+10).css('height', $('#ajax-content').height()+10)
                            },
                            success: function(data){
                                    
                                    $('#modal-popup-' + modalOptions-1 + ' .modal-content').html(data);
                            },
                            error: function(){
                            }
                    });
                    started = false;
                }
				$('#modal-popup-2 .modal-close').click();
            },
            statusCode: {
                404: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('This page do not exist!');
                },
                403: function() {
                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    $('#modal-popup-' + modalOptions + ' .modal-content').html('You dont not have access to this page!');
                }
              }
        }; 

        // bind form using 'ajaxForm' 
        $(this).closest('form').ajaxSubmit(options);
		
		return false;
	});
	if($('#terms').val() == '0') {
		$('#terms').val('');
	}
	$('a[href="/my-account/my-offers/add"]').click(function() {
	    $('.content').css('height', '2935px');
	});
    var site_root = '/';
    //$.post(site_root + 'my-account/autocomplete-user');
    /*$.getJSON(site_root + 'json.json', function(data) {
        $('#users').autocomplete({source: data});
    });*/
		$.get('/my-account/get-unread-messages', function(response) {
			$('.messages').html(response);
			$.get('/my-account/new-friendship-requests', function(resp) {
				$('.friends').html(resp);
			});
		});
});