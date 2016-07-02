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
      /*Dropzone.options.commentFormDropzone = {
          dictDefaultMessage: 'To attach files drag & drop or click to select from computer',
          clickable: true,
          previewTemplate: document.getElementById('preview-template').innerHTML
          /*'<div class="dz-preview dz-file-preview">'
                          + '<div class="dz-details">'
                            + '<div class="dz-filename"><span data-dz-name></span></div>'
                            + '<div class="dz-size" data-dz-size></div>'
                            + '<img data-dz-thumbnail />'
                          + '</div>'
                          + '<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>'
                          + '<div class="dz-success-mark"><span>✔</span></div>'
                          + '<div class="dz-error-mark"><span>✘</span></div>'
                          + '<div class="dz-error-message"><span data-dz-errormessage></span></div>'
                        + '</div>'
          init: function() {
            this.on("success", function(file, responseText) {
              file.previewTemplate.html(responseText);
            });
          }
      };*/
      var self = this;
      $('#comment-file-uploader').dmUploader({
        url: self.options.fileUploadUrl, //'/demos/dnd/upload.php',
        dataType: 'json',
        allowedTypes: '*',
        /*extFilter: 'jpg;png;gif',*/
        onInit: function() {
          //$.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
        },
        onBeforeUpload: function(id) {
          //$.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);
          //$.danidemo.updateFileStatus(id, 'default', 'Uploading...');
          $('#attachment-preview-' + id).find('span.attachment-preview-status').html('Uploading...').addClass('attachment-preview-status-' + status);
        },
        onNewFile: function(id, file) {
          //$.danidemo.addFile('#demo-files', id, file);
          var i = id;
          var template = '<div id="attachment-preview-' + i + '" class="attachment">' +
                        '<input type="hidden" name="attachment-id" value="" /> '+
                        '<input type="hidden" name="attachment-filename" value="" /> ' +
                        '<input type="hidden" name="attachment-extension" value="" />' +
                        '<input type="hidden" name="attachment-content_type" value="" />' +
		                    //'<span class="attachment-preview-id">#' + i + '</span> - ' +
                        '<input type="text" name="attachment-label" value="" class="inline" />' +
                        '<span style="display:none" class="attachment-label-size"></span>'+
                        '<span class="extension"></span> ' +
                        ' <span class="attachment-preview-size">(' + self.humanizeSize(file.size) + ')</span>' +
                        '<span class="attachment-preview-status label label-info">Waiting to upload</span>'+
		                    '<div class="progress progress-striped active progress-sm">'+
		                       '<div class="progress-bar" role="progressbar" style="width: 0%;">'+
		                           '<span class="sr-only">0% Complete</span>'+
		                       '</div>'+
		                    '</div>'+
		                '</div>';
            var attachmentsCount = $("#attachments-preview").attr('file-counter');
         		if (!attachmentsCount) {
         			$("#attachments-preview").empty();
         			attachmentsCount = 0;
         		}
         		attachmentsCount++;

         		$("#attachments-preview").attr('file-counter', attachmentsCount);
            $("#attachments-preview").append(template);
        },
        onComplete: function() {
          //$.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');

        },
        onUploadProgress: function(id, percent) {
            var percentStr = percent + '%';
            var attachmentEl = $('#attachment-preview-' + id);
          //$.danidemo.updateFileProgress(id, percentStr);
            attachmentEl.find('div.progress-bar').width(percent);
		        attachmentEl.find('span.sr-only').html(percent + ' Complete');
        },
        onUploadSuccess: function(id, data) {
          var attachmentEl = $('#attachment-preview-' + id);
          attachmentEl.find('input[name="attachment-filename"]').val(data.attachment.filename);
          attachmentEl.find('input[name="attachment-extension"]').val(data.attachment.extension);
          attachmentEl.find('input[name="attachment-content_type"]').val(data.attachment.content_type);
          attachmentEl.find('input[name="attachment-label"]').val(data.attachment.label);
          attachmentEl.find('.attachment-label-size').text(data.attachment.label);
          attachmentEl.find('.extension').text('.'+data.attachment.extension);
          attachmentEl.find('span.attachment-preview-status').html('Upload Complete').addClass('attachment-preview-status-' + status).hide();
          var labelTxtBox = attachmentEl.find('input[name="attachment-label"]');
          labelTxtBox.width(attachmentEl.find('.attachment-label-size').width()); // resize the text box of label
          //$.danidemo.updateFileProgress(id, '100%');
          attachmentEl.find('div.progress-bar').width('100%').parent().hide();
	        attachmentEl.find('span.sr-only').html('100% Complete').hide();
          attachmentEl.addClass('attachment-success list-group-item');
        },
        onUploadError: function(id, message) {
          //$.danidemo.updateFileStatus(id, 'error', message);
          //console.log(message);
          $('#attachment-preview-' + id).find('span.attachment-preview-status').html(message).addClass('attachment-preview-status-' +'error');
          //$.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
        },
        onFileTypeError: function(file) {
          //$.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
        },
        onFileSizeError: function(file) {
          //$.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
        },
        /*onFileExtError: function(file){
          $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' has a Not Allowed Extension');
        },*/
        onFallbackMode: function(message) {
          //$.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
        }
      });
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

    CommentController.prototype.getAttachments = function () {
      var fileCounter = $("#attachments-preview").attr('file-counter');
      var attachments = [], h = 0;
      if(fileCounter != '' && fileCounter > 0) {
        for(var i = 0; i < fileCounter; i++) {
          var attachmentEl = $("#attachment-preview-" + i);
          var attachment = {
            filename: attachmentEl.find('input[name="attachment-filename"]').val(),
            extension: attachmentEl.find('input[name="attachment-extension"]').val(),
            label: attachmentEl.find('input[name="attachment-label"]').val(),
            content_type: attachmentEl.find('input[name="attachment-content_type"]').val(),
          }
          attachments[h++] = attachment;
        }
      }

      return attachments;
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
             ['color', ['color']],
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
            resourceId : $("#commentable-type-id").val(),
            attachments: self.getAttachments()
          };

          commentService.add(commentObj, function (data) {
            self.updateComments(data);
            $("#comment-editor").summernote('code', '');
            $("#attachments-preview").html('').attr('file-counter', '0');
            saveBtn.prop('disabled', false);
          });
        });
    };

    CommentController.prototype.humanizeSize = function(size) {
      var i = Math.floor( Math.log(size) / Math.log(1024) );
      return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    };

    window.CommentController = CommentController;
})(jQuery, window, AloFramework);
