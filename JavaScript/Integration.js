function getParameterByName(name) {
    var name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function setCookie(name, value, options) {
    options = options || {};
    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

jQuery( document ).ready(function() {
    var utm = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];
    var $ = jQuery;
    utm.forEach(function(item) {
        if (getParameterByName(item) != '') {
            setCookie('comf5_' + item, getParameterByName(item), {expires: 7 * 24 * 60 * 60, path: '/' });
        }
    });

    jQuery(document).on(
        'click', 'button, input[type="submit"], .amoforms__fields__row__submit, .amoforms_submit_button', function(event) {
        var nameForm = $(this).parents('.amoforms').find('div[data-type="heading"] .amoforms__heading h1').text();
        var data = $(this).parents('form').serializeArray();
        var utmData = {};
        utm.forEach(function(item) {
            utmData[item] = getCookie('comf5_' + item);
        });
        
        utmData['_gid'] = getCookie('_gid');
        utmData['_ym_uid'] = getCookie('_ym_uid');
        utmData['roistat_visit'] = getCookie('roistat_visit');
        
        jQuery.ajax({
            url: "https://host.ru",
            type: "POST",
            dataType: "json",
            data: {name: nameForm, utm: utmData, data: data},
        }).done(function(data){
        }).fail(function (error) {
        });
        return true;
    });

});

