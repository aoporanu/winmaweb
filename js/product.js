$(function() {
    var stime;
    var ntime
    $('.p_timer_content').each(function(key, value) {
        stime = new Date($('.p_timer_content span').last().text());
        ntime = new Date($('.p_timer_content span').first().text());
//        $(this).countdown({until: ntime, onTick: timerPbar, format: 'HMS'});
				$(this).countdown({until: ntime, onTick: timerPbar});
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
    
     $("#slides").slides({
            preload: true,
            preloadImage: '/images/loading.gif',
            play: 5000,
            pause: 2500,
            hoverPause: true,
            pagination: false,
            generatePagination: false
      });
      
      $("a[rel^='prettyPhoto']").prettyPhoto();
      
      $('.modal-pp').live('click', function(e) {
        e.preventDefault();
        
        var m = $(this);
        var url = m.attr('href');
        var title = m.text();
        $().modal({
            'boxType': 'ajaxBox',
            'width': 700,
            'modalTitle': title,
            'ajaxUrl': url,
            'onSuccess': function(){
            }
        });
    });
});