jQuery(function() {

    //
    // if(jQuery('.display-name')){
    //     lp.username = jQuery('.display-name').text();
    // }

    if(jQuery('#aaww_active').is(":checked")) {
        jQuery(".config-options :input").attr("disabled", false);
    } else {
        jQuery(".config-options :input").attr("disabled", true);
        jQuery('#aaww_downloadtypes').attr("disabled", true);
    }

    //
    if(jQuery('#aaww_adimpressions').is(":checked")) {
        jQuery("#aaww_adsparam").attr("disabled", false);
    }
    else{
        jQuery("#aaww_adsparam").attr("disabled", true);
    }

    //
    if(jQuery('#aaww_download').is(":checked")) {
        jQuery("#aaww_downloadtypes").attr("disabled", false);
    }
    else{
        jQuery("#aaww_downloadtypes").attr("disabled", true);
    }

    //
    jQuery('#aaww_active').change(function(){
        if(jQuery(this).is(":checked")) {
            jQuery('.config-options').removeClass("disabled");
            jQuery('.config-options').addClass("enabled");
            jQuery(".config-options :input").attr("disabled", false);
        } else {
            jQuery('.config-options').removeClass("enabled");
            jQuery('.config-options').addClass("disabled");
            jQuery(".config-options :input").attr("disabled", true);
        }
    });

    //
    jQuery('form').bind('submit', function () {
        jQuery(this).find(':input').prop('disabled', false);
    });

    //
    jQuery('#aaww_time_zone').change(function(){
         jQuery('#aaww_time_zone_name').val(jQuery('#aaww_time_zone option:selected' ).text());
    });

    //
     jQuery('#aaww_adimpressions').change(function(){
        if(jQuery(this).is(":checked")) {
            jQuery("#aaww_adsparam").attr("disabled", false);
        }
        else{
            jQuery("#aaww_adsparam").attr("disabled", true);
        }
    });

     //
     jQuery('#aaww_download').change(function(){
        if(jQuery(this).is(":checked")) {
            jQuery("#aaww_downloadtypes").attr("disabled", false);
        }
        else{
            jQuery("#aaww_downloadtypes").attr("disabled", true);
        }
    });
});