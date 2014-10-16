function stratsync() {

    var base_url = $('#base_url').val();

    $.ajax({
        url: base_url + "sync/StartAutoSync",
        type: "POST"
    }).done(function (msg) {
//            alert(msg);
        if (msg == 'yes') {
            var n = noty({layout: 'topCenter', type: 'information', text: 'Auto Sync Started Successfully', timeout: 2000});
            $('#syncstrat').addClass('disabled');
            $('#syncstop').removeClass('disabled');
        }
    }).fail(function (jqXHR, textStatus) {

    });

}
function stopsync() {

    var base_url = $('#base_url').val();

    $.ajax({
        url: base_url + "sync/StopAutoSyc",
        type: "POST"
    }).done(function (msg) {
//            alert(msg);
        if (msg == 'yes') {
            var n = noty({layout: 'topCenter', type: 'error', text: 'Auto Sync Stopped Successfully', timeout: 2000});
            $(document).find('#syncstop').addClass('disabled');
            $(document).find('#syncstrat').removeClass('disabled');
        }
    }).fail(function (jqXHR, textStatus) {
        alert(textStatus);
    });

}

function startsync(id) {

    var base_url = $('#base_url').val();
    $('#et_startsync').addClass('disabled');
    $('#et_stopsync').removeClass('disabled');
    var percentVal = 0;
    var stopper;
    $.ajax({
        url: base_url + "sync/StartSync",
        type: "POST",
        data: {sync: id,type:'Manual'},
        beforeSend: function() {
            $("#exact_progessbar").parent('.progress-stat').removeClass('hide');
            console.log("test");
            stopper = setInterval(function(){
                percentVal += 1;
                if(percentVal <= 90)
                {
                    $(document).find("#exact_progessbar .progress-bar").attr("style","width:"+percentVal+'%').siblings('.progress-stat-value').html(percentVal+'%');
                    $("#exact_progessbar").siblings('.progress-stat-value').html(percentVal+'%');
                    $("#exact_progessbar span").html(percentVal+'%');
                }else{
                    clearInterval(stopper);
                }
            },2000);
               
        }
    }).done(function (msg) {

            var data=JSON.parse(msg);
            $('#et_subscribe').text(data.SubscribedCount);
            $('#et_unsubscribe').text(data.UnSubscribedCount);
            $('#et_lastsync').text(data.SyncTime);
            
            var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

            $('#et_startsync').removeClass('disabled');
            $('#et_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#exact_progessbar .progress-bar").attr("style","width: 100%");
            $("#exact_progessbar").siblings('.progress-stat-value').html('100%');
            $("#exact_progessbar span").html('100%');
            $("#exact_progessbar").parent('.progress-stat').addClass('hide');
    }).fail(function (jqXHR, textStatus) {
        $('#et_startsync').removeClass('disabled');
    });
}
//##############################
//function startsync(formId)
//{
//      console.log(formId);
////    var bar = $('#'+barId).find('.progress-bar');
////    var percent = $('#'+barId).find('span');
// var base_url = $('#base_url').val();
//    $(document).find("#"+formId).ajaxSubmit({
////        url:base_url + "sync/StartAutoSync",
//        beforeSend: function() {
//            console.log("test");
//            var percentVal = '0%';
//               $(document).find("#exact_progessbar").attr("style","width:"+percentVal);
////            bar.width(percentVal);
//           $("#exact_progessbar span").html(percentVal);
//        },
//        uploadProgress: function(event, position, total, percentComplete) {
//            var percentVal = percentComplete + '%';
//            console.log(percentComplete);
//            $(document).find("#exact_progessbar").attr("style","width:"+percentVal);
//             $("#exact_progessbar span").html(percentVal);
//        },
//        success: function(msg){
//            var percentVal = '100%';
//            $("#exact_progessbar").attr("style","width:"+percentVal);
////            bar.width(percentVal);
//            $("#exact_progessbar span").html(percentVal);
//            setTimeout(function(){$(document).find("#exact_progessbar").attr("style","width:"+percentVal);},2000);
//            if (msg == 'yes') {
//            var n = noty({layout: 'topCenter', type: 'information', text: 'Auto Sync Started Successfully', timeout: 2000});
//            $('#syncstrat').addClass('disabled');
//            $('#syncstop').removeClass('disabled');
//        }
////            responseText=responseText.split(',');
////            var attachResponse = '<li><a class="downloadFile" href="javascript:downloadFile("uploads/taskFiles/'+responseText[0]+'")"><i class="fa fa-download">&nbsp;&nbsp;&nbsp;</i>'+responseText[0]+' </a><a class="viewFile" href="javascript:viewFile("'+path+'uploads/taskFiles/'+responseText[0]+'")"><i class="fa fa-eye">&nbsp;&nbsp;&nbsp;</i></a></li>';
////            $(document).find("#"+formId).parent().prev('.attach').addClass('in').removeClass('hide').children('ul').prepend(attachResponse);
//        },
//        error:function(data){
//            alert(data);
//        }
//
//    });
//}


