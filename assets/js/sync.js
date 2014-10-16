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
    $.ajax({
        url: base_url + "sync/StartSync",
        type: "POST",
        data: {sync: id,type:'Manual'},
    }).done(function (msg) {

            var data=JSON.parse(msg);
            $('#et_subscribe').text(data.SubscribedCount);
            $('#et_unsubscribe').text(data.UnSubscribedCount);
            $('#et_lastsync').text(data.SyncTime);
            
            var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

            $('#et_startsync').removeClass('disabled');
            $('#et_stopsync').addClass('disabled');
    }).fail(function (jqXHR, textStatus) {
        $('#et_startsync').removeClass('disabled');
    });
}



