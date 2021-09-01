/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $('#txtPostleitzahl').on('blur', function(){
        var value = $(this).val();
        if (value && value.length > 3) {
            $('#dispmsg').val('');
            var url = "index.php?eID=armdealer";
            $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    format: "json",
                    data: {
                            "arguments[zip]": value,
                            "pluginName":"Form",
                            "controllerName":"Dealer",
                            "actionName":"dlrmsg",
                            "formatName":"html"
                    }
            }).done(function( data ) {
                if (data.status == 'OK') {
                    $('#dispmsg').val(data.msg);
                } else {
                   $('#dispmsg').val(data.error);
                }
            });
        }
    });
});