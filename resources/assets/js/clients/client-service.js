;(function ($, window, aloF) {
    function ClientService(options) {
      this.options = $.extend({}, options);
      this._initialize();
    }

    ClientService.prototype.options = {
      // add any default options in here...
    }

    ClientService.prototype._initialize = function () {

    };

    ClientService.prototype.all = function (term, successCallBack) {
      $.ajax({
        url: aloF.getBaseURL() + "/clients/filter",
        data: {
          term: term
        },
        success: function(data) {
          if(successCallBack != null)
            successCallBack(data);
        }
      });
    };

    window.ClientService = ClientService;
})(jQuery, window, AloFramework);
