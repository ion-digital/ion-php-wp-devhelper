
$wp_helper_admin = (function() {

    this.initialized = false;

    this.initialize = function() {

        if(this.initialized === false) {



            this.initialized = true;
        }

    };
    
    this.showError = function(errorThrown) {
      
        alert('An error occurred:\n\n' + errorThrown);
    };

    this.ajax = function(callbackName, success, failure) {

        if(this.initialized === false)
            throw "[WP Devhelper] WP Devhelper has not been initialized.";

        if(!callbackName)
            throw "[WP Devhelper] 'callbackName' has not been specified.";

        if(!success)
            throw "[WP Devhelper] 'success' has not been defined.";

        if(success && !jQuery.isFunction(success))
            throw "[WP Devhelper] 'success' is not a function.";

        if(failure && !jQuery.isFunction(failure))
            throw "[WP Devhelper] 'failure' is not a function.";

        if(!ajaxurl)
            throw "[WP Devhelper] 'ajaxurl' has not been defined.";

        var url = ajaxurl + '?action=' + callbackName;


        console.groupCollapsed('[WP Devhelper Admin] AJAX call', url);
        console.log('[url]', url);

        jQuery.ajax(url, {

        }).success(function(/* anything */ data, /* string */ textStatus, /* jqXHR */ jqXhr) {

            console.log('[textStatus]', textStatus);
            console.dir('[jqXhr]', jqXhr);
            console.groupEnd();

            success(data, textStatus, jqXhr);
        }).error(function(/* jqXHR */ jqXhr, /* string */ textStatus, /* string */ errorThrown) {


            console.log('[errorThrown]', errorThrown);
            console.log('[textStatus]', textStatus);
            console.dir('[jqXhr]', jqXhr);

            console.groupEnd();

            if(failure)
                failure(jqXhr, textStatus, errorThrown);

        });

    };

    this.initialize();

    return this;
})();

