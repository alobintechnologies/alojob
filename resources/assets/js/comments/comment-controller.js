;(function ($, window, aloF) {

    function CommentController(options) {
      this.options = $.extend({}, options);
      this._initialize();
      this._events();
    }

    CommentController.prototype.options = {
      // add any default options in here...
    }

    CommentController.prototype._initialize = function () {
    };

    CommentController.prototype.client = function (id, name) {
        $("#client_id-field").val(name);
        $("input[name='client_id']").val(id);
    };

    CommentController.prototype._events = function () {
        $("#comment-editor").summernote({
          minHeight: 200,
          maxHeight: null,
          focus: false,
          placeholder: 'Add comment or upload file here...',
          toolbar: [
             ['style', ['bold', 'italic', 'underline', 'clear']],
             ['para', ['ul', 'ol']]
          ],
          callbacks: {
            onInit: function() {
              $("#comment-editor-group").find('.note-editor .note-toolbar .note-btn').attr('tabindex', '-1');
           }
          }
        });
    };

    window.CommentController = CommentController;
})(jQuery, window, AloFramework);
