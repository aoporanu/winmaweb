$(function() {
    $('#step_zero').click(function() {
        $('#stepumasii1').css('display', 'none');
        $('.js_enabled .step_one').css('display', 'block');
    });
    $('#step_one').click(function() {
        $('#stepumasii2').css('display', 'none');
        $('.js_enabled .step_two').css('display', 'block');
    });
    $('#step_two').click(function() {
        $('#stepumasii3').css('display', 'none');
        $('.js_enabled .step_three').css('display', 'block');
    });
		
    $('#login').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        $().modal({
            'boxType': 'ajaxBox',
            'width': 370,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){}
        });
    });
		$('#login-register').live('click', function(e) {
//        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        $().modal({
            'boxType': 'ajaxBox',
            'width': 370,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){}
        });
    });
    
    $('.modal-crop-image').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        $().modal({
            'boxType': 'ajaxBox',
            'width': 900,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){}
        });
    });
    
    $('#request-membership').live('click', function(e) {
        e.preventDefault();
        var m = $(this);
        var url = m.attr('href');
        var title = m.attr('title');
        $().modal({
            'boxType': 'ajaxBox',
            'width': 600,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){}
        });
    });
    
   /*
     *  Modal ajax submit
     */
    $('.modal-submit').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
        var modalOptions = $().modal({'boxType': 'getOptions'});

        var options = { 
            //target: ,   // target element(s) to be updated with server response 
            beforeSubmit: function(){
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
                    if ($().tagsInput()) {
                        $('#tags').tagsInput({
                            autocomplete_url: '/get-tags',
                            autocomplete: {selectFirst:true,width:'100px',autoFill:true}
                        });
                    }

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
    var started = false;
    /*
     *  Ajax submit
     **/
    $('.ajax-submit').live('click', function(e){
        e.preventDefault();
        var h = $(this).closest('form').attr('action');
        
        var options = { 
            //target: '#ajax-content',   // target element(s) to be updated with server response 
            beforeSubmit: function(jqXHR){
                $("#isajaxrequest").attr("value", 1);
                if(!started){
                    $('#ajax-content').append('<div class="overlay"><!--<div class="context-loader">Please wait</div>--></div>');
                    $('.overlay').css('width', $('#ajax-content').width()+10).css('height', $('#ajax-content').height()+10);
                    $('body').prepend('<div id="hello_bar"><div class="hello-container"><p><span class="loader">please wait</span></p></div></div>');
                }
                if($(document).scrollTop() - $('#ajax-content').offset().top > 0 || $(document).scrollTop() - $('#ajax-content').offset().top < 0){
                    $.scrollTo('#ajax-content', {duration:1000});
                }
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
                          initTinymce();
                          $('#ajax-content').animate({
                                //height: '100%',
                                opacity: 1
                              }, 400, 'linear', function() {
                              });
                      });
                    window.location.hash = '!' + h;
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
        }; 

        // bind form using 'ajaxForm' 
        $(this).closest('form').ajaxSubmit(options);
        return false;
    });
    
    //var newYear = new Date(); 
    var nntime;
    $('.timer_content').each(function(key, value) {
        nntime = new Date($(this).text());
        $(this).countdown({until: nntime});
    });

    $('#cart_qty').live('change', function(e){
        var qty = $(this).val();
        document.location.href = '/shopping-cart?ac=qty&i='+qty;
    })
    
    $('#cart_qty').live('change', function(e){
        var qty = $(this).val();
        alert($(this).find('.mda123').html());
        //document.location.href = '/shopping-cart?ac=qty&i='+qty;
    })
    
    $('#cart_op').live('change', function(e){
        var oid = $(this).val();
        var url = $('#fmm').text() + '&option_id='+oid;
        document.location.href = url;
    })
    
    /*
     *  Help messages
     *
     */
    $('.help-link').live('click', function(e) {
        e.preventDefault();

        $().modal({
            'boxType': 'infoBox',
            'width': 680,
            'modalTitle': '' + $(this).attr('title'),
            'modalContent': $(this).next().html()
        });
    });

});