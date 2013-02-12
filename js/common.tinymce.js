 function initTinymce() {
    $('textarea.tinymce').tinymce({
            // Location of TinyMCE script
            script_url : '/tiny_mce/tiny_mce_gzip.php',

            // General options
            theme : "advanced",
            plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4 : "visualchars,nonbreaking",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            content_css : "/css/style_tinymce.css",

            // Drop lists for link/image/media/template dialogs
            file_browser_callback : "ajaxfilemanager",
            paste_use_dialog : false,
            theme_advanced_resizing : true,
            theme_advanced_resize_horizontal : true,
            apply_source_formatting : true,
            force_br_newlines : true,
            force_p_newlines : false,	
            relative_urls : true
    });
    
}

function ajaxfilemanager(field_name, url, type, win) {
            var ajaxfilemanagerurl = "/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php";
            var view = 'detail';
            switch (type) {
                    case "image":
                    view = 'thumbnail';
                            break;
                    case "media":
                            break;
                    case "flash": 
                            break;
                    case "file":
                            break;
                    default:
                            return false;
            }
tinyMCE.activeEditor.windowManager.open({
    url: "/ajaxfilemanager/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
    width: 782,
    height: 440,
    inline : "yes",
    close_previous : "no"
    },{
    window : win,
    input : field_name
    });

    /*            return false;			
            var fileBrowserWindow = new Array();
            fileBrowserWindow["file"] = ajaxfilemanagerurl;
            fileBrowserWindow["title"] = "Ajax File Manager";
            fileBrowserWindow["width"] = "782";
            fileBrowserWindow["height"] = "440";
            fileBrowserWindow["close_previous"] = "no";
            tinyMCE.openWindow(fileBrowserWindow, {
              window : win,
              input : field_name,
              resizable : "yes",
              inline : "yes",
              editor_id : tinyMCE.getWindowArg("editor_id")
            });

            return false;*/
    }