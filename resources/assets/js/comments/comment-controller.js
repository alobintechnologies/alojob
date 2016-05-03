;(function ($, window, aloF) {

    var commentService = new CommentService();

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

    CommentController.prototype.updateComments = function (data) {
        var resourceData = {
          'resourceType' : 'Ticket',
          'resourceId' : this.options.ticketId,
          'comment' : data.comment
        };
        commentService.show(resourceData, function(html) {
          $("#comments-holder").append(html);
        });
    };

    CommentController.prototype.showComments = function () {
        var resourceData = {
          'resourceType' : 'Ticket',
          'resourceId' : this.options.ticketId
        };
        $("#comments-holder").html('<p>Loading comments...</p>');

        commentService.all(resourceData, function(data) {
          $("#comments-holder").html(data);
        });
    };

    CommentController.prototype._events = function () {
        var self = this;
        self.showComments();

        $("#comment-editor").summernote({
          minHeight: 100,
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

        $("#save-comment").click(function() {
          var saveBtn = $(this);
          saveBtn.prop('disabled', true);
          var commentObj = {
            comment : $("#comment-editor").summernote('code'),
            resourceType : $("#commentable-type").val(),
            resourceId : $("#commentable-type-id").val()
          };

          commentService.add(commentObj, function (data) {
            self.updateComments(data);
            $("#comment-editor").summernote('code', '');
            saveBtn.prop('disabled', false);
          });
        });
    };

    window.CommentController = CommentController;
})(jQuery, window, AloFramework);
