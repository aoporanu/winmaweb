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
            setup : function(ed) {ed.onPaste.add( function(ed, e, o) {
                        // return tinymce.dom.Event.cancel(e);
                                    //tinymce.execCommand('mcePasteText');
                                    } );
                            }, 

            plugins : "bbcode,safari,pagebreak,paste,media,style,layer,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,forecolor,cleanup,code",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
						extended_valid_elements : "iframe[src|width|height|name|align]",
//						extended_valid_elements : "iframe[src|width|height|name|id|class|align|style|frameborder|border|allowtransparency],embed,object",
//						valid_elements : "*[*]",
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
    initTinymce();
    $('#main-nav li a').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        if(m.hasClass('no')) {
            //document.location.href = url;
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
                $.scrollTo('#ajax-content', {duration:1000});
                }
                m.addClass('over');
                started = true;
            },
            success: function(data){
                $('#hello_bar').remove();
                $('#main-nav li').each(function(kye, value) {
                    var t = $(value).find('.current');
                    t.removeClass('current');

                });
                m.removeClass('over');
                m.addClass('current');
                if(data.ajaxRedir) {
                    document.location.href = data.ajaxRedir;
                } else {
                    $('#ajax-content').animate({
                        opacity: 0
                        //height:'0'
                      }, 400, 'linear', function() {
                          $('#ajax-content').html(data)
                          initTinymce();
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
    
    $('.modal-user').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        $().modal({
            'boxType': 'ajaxBox',
            'width': 670,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){
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
    
//    $('.modal-prodgal').live('click', function(e) {
//        e.preventDefault();
//        var m = $(this);
//        var url = m.attr('href');
//        var title = m.text();
//        $().modal({
//            'boxType': 'ajaxBox',
//            'width': 470,
//            'modalTitle': title,
//            'ajaxUrl': url,
//            'onSuccess': function(){
//            }
//        });
//    });
    
    $('.modal-reports').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        $().modal({
            'boxType': 'ajaxBox',
            'width': 920,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){
            }
        });
    });
    
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
            timeFormat: 'hh:mm',
            //minDate:+0,
            onClose: function(dateText, inst) {
                var endDateTextBox = $('#end_time');
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
//                $('#end_time').datetimepicker('option', 'minDate', new Date(start.getTime()));
								$('#end_time').datetimepicker({
									dateFormat: "yy-mm-dd",
									timeFormat: 'hh:mm',
									minDate: new Date(start.getTime())});
            }
        });
        $('#end_time').datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: 'hh:mm',
            //minDate:+0,
            onClose: function(dateText, inst) {
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
//                $('#start_time').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
								$('#start_time').datetimepicker({
									dateFormat: "yy-mm-dd",
									timeFormat: 'hh:mm',
									maxDate: new Date(end.getTime())});
            }
        });
    });
    
    $('#category').live('change', function(e){
        var m = $(this);
        
        $.ajax({
            url: '/admin/get/subcategories?id='+m.val(),
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
    
    $('.modal-ajax-submit').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
        var modalOptions = $().modal({'boxType': 'getOptions'});

        var options = { 
            //target: ,   // target element(s) to be updated with server response 
            beforeSubmit: function(){
                $("#isajaxrequest").attr("value", 1);
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
              
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
                $.scrollTo(modalId, {duration:1000});
                }
            },
            success: function(response){
                
                if(response.ajaxRedir) {
                    document.location.href = response.ajaxRedir;
                } else {
                    
                    $('#modal-popup-' + modalOptions + ' .modal-content').html(response);

                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    
                    if ($().tinymce) {
                        initTinymce();
                    }
                    if ($().tagsInput) {
                        $('#tags').tagsInput({
                            autocomplete_url: '/get-tags',
                            autocomplete: {selectFirst:true,width:'100px',autoFill:true}
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
                $('#ajax-content').append('<div class="overlay-fff"><!--<div class="context-loader">Please wait</div>--></div>');
                $('.overlay-fff').css('width', $('#ajax-content').width()).css('height', $('#ajax-content').height());
                $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                }
                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
                $.scrollTo('#ajax-content', {duration:1000});
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
                    $('#ajax-content .overlay-fff').remove();
                    $('#ajax-content').html('This page do not exist!');
                },
                403: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay-fff').remove();
                    $('#ajax-content').html('You dont not have access to this page!');
                }
              }
        });
    })
    
    $('.ajax-link-nourl').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        $.ajax({
            url: url,
            beforeSend: function(){
                if(!started){
                $('#ajax-content').append('<div class="overlay-fff"><!--<div class="context-loader">Please wait</div>--></div>');
                $('.overlay-fff').css('width', $('#ajax-content').width()).css('height', $('#ajax-content').height());
                $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                }
                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
                $.scrollTo('#ajax-content', {duration:1000});
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
                }
                
                started = false;
            },
            error: function(jqXHR, textStatus, errorThrown){
            },
            statusCode: {
                404: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay-fff').remove();
                    $('#ajax-content').html('This page do not exist!');
                },
                403: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay-fff').remove();
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
      if(result.indexOf('.')<0) {result+= '.';}
      while(result.length- result.indexOf('.')<=dec) {result+= '0';}
      return result;
    }
    
    $('.modal-ajax-link, .pagination-modal li a').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var modalOptions = $().modal({'boxType': 'getOptions'});
        
        $.ajax({
            url: url,
            beforeSend: function(){
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
                    $.scrollTo(modalId, {duration:1000});
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
    
    /*
     * Modal ajax link 2
     */
    
    $('.modal-ajax-link-rel').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var modalOptions = $().modal({'boxType': 'getOptions'});
        var rel =  m.attr('rel');
        
        $.ajax({
            url: url,
            beforeSend: function(){
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
                    $.scrollTo(modalId, {duration:1000});
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
    
    /*
     * Modal ajax submit 2
     */
    
    $('.modal-ajax-submit-rel').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
        var modalOptions = $().modal({'boxType': 'getOptions'});
        var rel =  $(this).closest('form').attr('rel');
        
        var options = { 
            //target: ,   // target element(s) to be updated with server response 
            beforeSubmit: function(){
                $("#isajaxrequest").attr("value", 1);
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
              
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
                $.scrollTo(modalId, {duration:1000});
                }
            },
            success: function(response){
                
                if(response.ajaxRedir) {
                    document.location.href = response.ajaxRedir;
                } else {
                    
                    $('#modal-popup-' + modalOptions + ' .modal-content').html(response);

                    $('#modal-popup-' + modalOptions + ' .modal-bg .overlay-fff').remove();
                    
                    if ($().tinymce) {
                        initTinymce();
                    }
                    if ($().tagsInput) {
                        $('#tags').tagsInput({
                            autocomplete_url: '/get-tags',
                            autocomplete: {selectFirst:true,width:'100px',autoFill:true}
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
                                    $.scrollTo('#ajax-content', {duration:1000});
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
                                    $.scrollTo('#ajax-content', {duration:1000});
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
    
    $('.ajax-modal-del').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var rel = m.attr('rel');
        var modalOptions = $().modal({'boxType': 'getOptions'});
        
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
                                    $.scrollTo('#ajax-content', {duration:1000});
                                }
                                started = true;
                            },
                            success: function(data, textStatus, jqXHR){
                                $('#hello_bar').remove();
                                if(data.ajaxRedir) {
                                    document.location.href = data.ajaxRedir;
                                } else {
                                    $('#modal-popup-' + (modalOptions) + ' .modal-content').animate({
                                        opacity: 0
                                        //height:'0'
                                      }, 400, 'linear', function() {
                                          $('#modal-popup-' + (modalOptions) + ' .modal-content').html(data)
                                          $('#modal-popup-' + (modalOptions) + ' .modal-content').animate({
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
    
    $('.ajax-modal-confirm').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        var modalOptions = $().modal({'boxType': 'getOptions'});
        
        $().modal({
            'boxType': 'confirmationBox',
            'width': 300,
            'modalTitle': 'Confirmation',
            'modalContent': title,
            'onConfirm': function(){
                        $.ajax({
                            url: url,
                            beforeSend: function(){
                                if(!started){
                                    $('#ajax-content').append('<div class="overlay-fff"><!--<div class="context-loader">Please wait</div>--></div>');
                                    $('.overlay-fff').css('width', $('#ajax-content').width()).css('height', $('#ajax-content').height());
                                    $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                                }
                                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
                                    $.scrollTo('#ajax-content', {duration:1000});
                                }
                                started = true;
                            },
                            success: function(data, textStatus, jqXHR){
                                $('#hello_bar').remove();
                                if(data.ajaxRedir) {
                                    document.location.href = data.ajaxRedir;
                                } else {
                                    $('#modal-popup-' + (modalOptions) + ' .modal-content').animate({
                                        opacity: 0
                                        //height:'0'
                                      }, 400, 'linear', function() {
                                          $('#modal-popup-' + (modalOptions) + ' .modal-content').html(data)
                                          $('#modal-popup-' + (modalOptions) + ' .modal-content').animate({
                                                //height: '100%',
                                                opacity: 1
                                              }, 400, 'linear', function() {
                                              });
                                      });
                                      
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
                                }

                                started = false;   
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                            },
                            statusCode: {
                                404: function() {
                                    $('#hello_bar').remove();
                                    $('#ajax-content .overlay-fff').remove();
                                    $('#ajax-content').html('This page do not exist!');
                                },
                                403: function() {
                                    $('#hello_bar').remove();
                                    $('#ajax-content .overlay-fff').remove();
                                    $('#ajax-content').html('You dont not have access to this page!');
                                }
                              }
                });
            }

        });
    });
    
    /*
     * Product
     */
    
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
      if(result.indexOf('.')<0) {result+= '.';}
      while(result.length- result.indexOf('.')<=dec) {result+= '0';}
      return result;
    }
		$('.calc').live('click', function(e){
        e.preventDefault();
        var idd = $(this).attr('rel');
        var pr = $('#producer_price_'+idd).val();
        var dc = $('#discount_'+idd).val();
        $(this).prev().html(roundNumber2(pr - roundNumber2(pr*dc/100, 2), 2));
    });
    $('.modal-submit-product').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
        var modalOptions = $().modal({'boxType': 'getOptions'});
        var rel = $(this).closest('form').attr('rel');
        
        var options = { 
            //target: ,   // target element(s) to be updated with server response 
            beforeSubmit: function(){
                $("#isajaxrequest").attr("value", 1);
                $('#modal-popup-' + modalOptions + ' .modal-bg').append('<div class="overlay-fff"><div class="context-loader">Please wait</div></div>');
                $('.overlay-fff').css('width', $('#modal-popup-' + modalOptions + ' .modal-bg').width()).css('height', $('#modal-popup-' + modalOptions + ' .modal-bg').height())
              
                var modalId = '#modal-popup-' + modalOptions + ' .modal-title';
                if($(document).scrollTop() - $(modalId).offset().top > 0 || $(document).scrollTop() - $(modalId).offset().top < 0){
                $.scrollTo(modalId, {duration:1000});
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
                            autocomplete: {selectFirst:true,width:'100px',autoFill:true}
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
    
    $( ".sortable" ).live( "mouseenter", function(event) {
      $( ".sortable" ).sortable({ opacity: 0.6, delay: 500, revert: true, item: 'li' });
      $( ".sortable" ).disableSelection();
    });
    $( "#sortable1, #sortable2, #sortable3" ).live( "sortupdate", function(event, ui) {
      var order = $(this).closest('.sortable').sortable('serialize');
      var url = $(this).attr('rel');
      
      $.ajax({
            url: url,
            data: order,
            type: "POST",
            beforeSend: function(){
                $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                $('.sortable').sortable( "disable" )
            },
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
                $('#hello_bar').remove();                    
                $('.sortable').sortable( "enable" );
                started = false;
            },
            error: function(jqXHR, textStatus, errorThrown){
                $('#hello_bar').remove();
                $('.sortable').sortable( "enable" );
                var err = 'There have been an error!';
                if(errorThrown == 'Forbidden') {
                    err = 'You do not have access to this page!';
                }
                $().modal({
                    'boxType': 'infoBox',
                    'width': 300,
                    'modalTitle': 'Error ' + errorThrown,
                    'modalContent': err

                });
                started = false;
            }
        });
    });
    
    $('.add-price').live('click', function(e){
        e.preventDefault();
        var no = $('.price-box').length;
        no = no + 1
        $('.remove-price').remove();
        $('.prices-box').append('<div class="price-box"><input name="price[]" id="price" value="1" type="hidden">'
        +'<div style="border:1px solid #cacaca;padding:5px;margin:10px 0;">'
        +'    <div class="clearfix">'
        +'    <div class="label label_big"><label for="offer_price_name_'+no+'">Offer price name #'+no+':</label></div>'
       +'     <div class="input">'
         +'           <input name="offer_price_name_'+no+'" id="offer_price_name_'+no+'" value="" size="20" type="text">'
         +'   </div>'
         +'   </div>'
        +'    <div class="clearfix">'
        +'    <div class="label label_big"><label for="producer_price_'+no+'">Suplier price $#'+no+':</label></div>'
       +'     <div class="input">'
         +'           <input name="producer_price_'+no+'" id="producer_price_'+no+'" value="" size="20" type="text">'
         +'   </div>'
         +'   </div>'
         +'   <div class="clearfix">'
         +'   <div class="label label_big"><label for="discount_'+no+'">Discount %#'+no+':</label></div>'
         +'   <div class="input">'
         +'           <input name="discount_'+no+'" id="discount_'+no+'" value="" size="20" type="text">'
        +' </div>'
         +'   </div>'
        +'    <div class="clearfix">'
         +'   <div class="label label_big"><label>Your price #'+no+':</label></div>'
          +'  <div class="input" style="padding:4px;" id="product_price_'+no+'">0 $</div>'
           +' </div>'
         +'   <div class="clearfix">'
         +'   <div class="label label_big"><label for="stock_'+no+'">Stock #'+no+':</label></div>'
         +'   <div class="input">'
         +'           <input name="stock_'+no+'" id="stock_'+no+'" value="" size="20" type="text">'
         +'   </div>'
         +'   </div>'
        +'   <div class="clearfix">'
         +'   <div class="label label_big"><label for="expire_'+no+'">Expire #'+no+':</label></div>'
         +'   <div class="input">'
         +'           <input name="expire_'+no+'" id="expire_'+no+'" value="" size="20" type="text" class="exdate">'
         +'   </div>'
         +'   </div><div class="remove-button"><a href="#" class="remove-price">Remove</a></div>'
       +' </div></div>');
    })
    
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
    
    /*
     *  Ajax submit
     **/
    $('.ajax-search-submit').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action')+'&squery='+$('#squery').val();
        
        var options = { 
            //target: '#ajax-content',   // target element(s) to be updated with server response 
            beforeSubmit: function(jqXHR){
                $("#isajaxrequest").attr("value", 1);
                if(!started){
                    $('#ajax-content').append('<div class="overlay-fff"><!--<div class="context-loader">Please wait</div>--></div>');
                    $('.overlay-fff').css('width', $('#content').width()).css('height', $('#content').height());
                    $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                }
                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
                    $.scrollTo('#ajax-content', {duration:1000});
                }
                started = true;
                $('.tipsy').remove();
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
                    window.location.hash = '!' + h;
                    updateCoins()
                }
                
                started = false;
            },
            error: function(jqXHR, textStatus, errorThrown){
            },
            statusCode: {
                404: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay-fff').remove();
                    $('#ajax-content').html('This page do not exist!');
                },
                403: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay-fff').remove();
                    $('#ajax-content').html('You dont not have access to this page!');
                },
                500: function() {
                    $('#hello_bar').remove();
                    $('#ajax-content .overlay-fff').remove();
                    $('#ajax-content').html('500 internal server error!');
                }
              }
        }; 

        // bind form using 'ajaxForm' 
        $(this).closest('form').ajaxSubmit(options);
        return false;
    });
    $('a[href="/admin/users/actions/8?tab=edit"]').click(function() {
        $('.container').css('height', '841px');
    });
});