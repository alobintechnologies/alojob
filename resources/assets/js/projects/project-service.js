;(function ($, window, aloF) {
    function ProjectService(options) {
      this.options = $.extend({}, options);
      this._initialize();
    }

    ProjectService.prototype.options = {
      // add any default options in here...
    }

    ProjectService.prototype._initialize = function () {

    };

    ProjectService.prototype.all = function (term, successCallBack) {
      $.ajax({
        url: aloF.getBaseURL() + "/projects/filter",
        data: {
          term: term
        },
        success: function(data) {
          if(successCallBack != null)
            successCallBack(data);
        }
      });
    };

    window.ProjectService = ProjectService;
})(jQuery, window, AloFramework);
