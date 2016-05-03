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

    CommentService.prototype.all = function (data, successCallBack) {
      $.ajax({
        url: aloF.getBaseURL() + "/comments?resourceType=" + data.resourceType + "&resourceId=" + data.resourceId,
        success: function(data) {
          if(successCallBack != null)
            successCallBack(data);
        }
      });
    };

    CommentService.prototype.add = function (comment, successCallBack) {
      $.ajax({
        url: aloF.getBaseURL() + "/comments",
        type: 'POST',
        data: comment,
        success: function(data) {
          if(successCallBack != null)
            successCallBack(data);
        }
      });
    };

    CommentService.prototype.show = function (data, successCallBack) {
      $.ajax({
        url: aloF.getBaseURL() + "/comments/" + data.comment.id,
        success: function(data) {
          if(successCallBack != null)
            successCallBack(data);
        }
      });
    };

    window.CommentService = CommentService;
})(jQuery, window, AloFramework);
