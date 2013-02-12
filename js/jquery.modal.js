(function($){
    
    var methods = {
        init : function( options ) {
                var defaults = {  
                width: 300,  
                marginTop: 40,
                boxType: 'infoBox',
                contentType: 'normal',
                
                modalTitle: 'Title',
                modalContent: 'content',
                onClose: function(){},
                onConfirm: function(){}
            };
            
            options = $.extend( defaults, options );
            
            if(methods[options.boxType]) {
               if(options.boxType == 'searchBox') {
                   return methods[options.boxType](options);
               }
               if(options.boxType !== 'getOptions') {
                    methods.create(options);
               } 
                return methods[options.boxType](options);
            }
        },
        boxNo: 0,
        normalBox : function(options) {
            //methods.create(options);
        },
        infoBox : function(options) {
            var i = 0;
            var html = '<div class="modal-title">'
			+'<h3>' + options.modalTitle + '</h3>'
                        +'</div>'
                        +'<div class="modal-content">' + options.modalContent + '</div>'
                        +'<div class="modal-bottom"><a href="#" class="g-button g-button-white modal-close">Close</a></div>';
            $('#modal-popup-' + methods.boxNo + ' .modal-bg').html(html);
            $('#modal-popup-' + methods.boxNo + ' .modal-close').live('click', function(e) {
                e.preventDefault();
                if(i == 0) {
                    methods.close(options);
                }
                i = 1
            }).delay(2000);
        },
        confirmationBox : function(options) {
            var i = 0;
            var html = '<div class="modal-title">'
			+'<h3>' + options.modalTitle + '</h3>'
                        +'</div>'
                        +'<div class="modal-content">' + options.modalContent + '</div>'
                        +'<div class="modal-bottom"><a href="#" class="g-button g-button-submit modal-close-confirm">Yes</a> <a href="#" class="g-button g-button-white modal-close">No</a></div>';
            $('#modal-popup-' + methods.boxNo + ' .modal-bg').html(html);
            $('#modal-popup-' + methods.boxNo + ' .modal-close').live('click', function(e) {
                e.preventDefault();
                methods.close(options);
            }).delay(2000);
            $('#modal-popup-' + methods.boxNo + ' .modal-close-confirm').live('click', function(e) {
                e.preventDefault();
                 if(i == 0) {
                    methods.closeConfirm(options);
                }
                i = 1
                
            }).delay(2000);
        },
        close : function(options) {
            $('#modal-popup-' + methods.boxNo).remove();
            if(methods.boxNo > 0) {
                methods.boxNo--;
            }
            if($.isFunction(options.onClose)){
                options.onClose();
            }
        },
        closeConfirm : function(options) {
            $('#modal-popup-' + methods.boxNo).remove();
            if(methods.boxNo > 0) {
                methods.boxNo--;
            }
            if($.isFunction(options.onConfirm)){
                options.onConfirm();
            }
        },
        create : function(options) {
            methods.boxNo++;
            //Get the modal box
            //Clone modal
            $('#modal-popup').clone().appendTo('body').attr({
                'id': 'modal-popup-' + methods.boxNo
            });

            //if (methods.boxNo == 1) {
                //set overlay bg
                $('#modal-popup-' + methods.boxNo).css({
                    'display': 'block',
                    'z-index': 600+methods.boxNo,
                    'width': $(window).width(),
                    'height': $(document).height()
                })
                $('#modal-popup-' + methods.boxNo + ' .modal-overlay').css({'z-index' : 500+methods.boxNo})
                //set box to middle
                
                $('#modal-popup-' + methods.boxNo + ' .modal-fix').css({
                    'padding-top' : $(window).height()/2 - 300 + $(document).scrollTop()
                    //'position' : options.width
                });
                
                $('#modal-popup-' + methods.boxNo + ' .modal-container').css({
                    'margin-left' : (($(window).width()/2) - (options.width/2)),
                    
                    'width' : options.width
                });
                
            //}
        },
        ajaxBox: function(options) {
            var a = this;
            var i = 0;
            var html = '<div class="modal-title">'
			+'<div class="left"><h3>' + options.modalTitle + '</h3></div><div class="right"><a href="#" class="modal-close">X</a></div><div style="clear: both;"></div>'
                        +'</div>'
                        +'<div class="modal-content"><br /><br /><div class="context-loader">Please wait</div></div>';
            $('#modal-popup-' + methods.boxNo + ' .modal-bg').html(html);
            $('#modal-popup-' + methods.boxNo + ' .modal-close').live('click', function(e) {
                e.preventDefault();
                if(i == 0) {
                    methods.close(options);
                }
                i = 1
            }).delay(2000);
            $.ajax({
                url: options.ajaxUrl,
                beforeSend: function(){
                    
                },
                success: function(data){
                    if(data.ajaxRedir) {
                        document.location.href = data.ajaxRedir;
                    }
                    $('#modal-popup-' + methods.boxNo + ' .modal-content').html(data);
                    
                    if($.isFunction(options.onSuccess)){
                        options.onSuccess();
                    }
                    
                    if ($().tinymce) {
                        initTinymce();
                    }
                    if ($().tagsInput) {
                        $('#tags').tagsInput({
                            autocomplete_url: '/get-tags',
                            autocomplete: {selectFirst:true,width:'100px',autoFill:true}
                        });
                    }
                    
                },
                error: function(){
                //alert(1);
                },
                statusCode: {
                    404: function() {
                      $('#modal-popup-' + methods.boxNo + ' .modal-content').html('This page do not exist!');
                    },
                    403: function() {
                      $('#modal-popup-' + methods.boxNo + ' .modal-content').html('You dont not have access to this page!');
                    }
                  }
            });
        },
        searchBox: function(options) {
            $('#modal-popup').clone().appendTo('body').attr({
                'id': 'modal-popup-search'
            });

            //if (methods.boxNo == 1) {
                //set overlay bg
               $('#modal-popup-search').css({
                    'display': 'block',
                    'z-index': 600,
                    'background': 'none'
                })
               
               //$('#modal-popup-search .modal-overlay').remove();
               
               $('#modal-popup-search').css({
                    'top' : $(options.obj).position().top-13
                });
                
                $('#modal-popup-search .modal-container').css({
                    'background' : 'none'
                });
                
                $('#modal-popup-search .modal-bg').css({
                    'background' : '#909754'
                });
                
                
                $('#modal-popup-search').css({
                    'left' : $(options.obj).position().left + 170,
                    'width' : options.width
                });
                
                var html = '<div class="modal-content">Please wait...</div>';
                $('#modal-popup-search .modal-bg').html(html);
                
                $.ajax({
                url: options.ajaxUrl,
                beforeSend: function(){
                    
                },
                success: function(data){
                    $('#modal-popup-search .modal-content').html(data);
                    
                    if($.isFunction(options.onSuccess)){
                        options.onSuccess();
                    }
                },
                error: function(){
                //alert(1);
                }
            });
        },
        getOptions: function(options) {
            return this.boxNo;
        }
    };
  
    $.fn.modal = function(method) {
        
        if ( methods[method] ) {
          return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
          return methods.init.apply( this, arguments );
        } else {
          $.error( 'Method ' +  method + ' does not exist on jQuery.modal' );
        }
    }
})(jQuery); 