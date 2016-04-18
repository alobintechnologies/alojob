; (function ($, window) {

    function AloFramework(options) {
        this.options = $.extend({}, this.options);
        $.extend(this.options, options);
        this._initialize();
        this._events();
    }

    AloFramework.prototype.options = {
    }

    AloFramework.prototype._initialize = function () {
    }

    AloFramework.prototype.getBaseURL = function () {
        return location.protocol + "//" + location.hostname +
            (location.port && ":" + location.port) + "/alojob/public";
        return "";
    }

    AloFramework.prototype.commonModal = function (modalTitle, modalBody, modalStatus) {
        var commonModalObj = $("#commonModal");
        if(commonModalObj !== undefined) {
            commonModalObj.find("#commonModalTitle").text(modalTitle);
            commonModalObj.find("#commonModalbody").html(modalBody);
            commonModalObj.modal(modalStatus);
        }
    };

    AloFramework.prototype._events = function () {
      $(".history-back-btn").click(function() {
        window.history.back();
      });
    };

    /**
     * Add the AloFramework to global namespace
     */
    window.AloFramework = new AloFramework({});
})(jQuery, window);
