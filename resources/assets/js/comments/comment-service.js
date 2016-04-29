;(function ($, window, aloF) {
    function CommentService(options) {
      this.options = $.extend({}, options);
      this._initialize();
    }

    CommentService.prototype.options = {
      // add any default options in here...
    }

    CommentService.prototype._initialize = function () {

    };

    CommentService.prototype.all = function (term, successCallBack) {
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

    window.CommentService = CommentService;
})(jQuery, window, AloFramework);
