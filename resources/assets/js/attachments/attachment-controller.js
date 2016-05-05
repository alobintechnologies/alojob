;(function ($, window, aloF) {

    var attachmentService = new AttachmentService();

    function AttachmentController(options) {
      this.options = $.extend({}, options);
      this._initialize();
      this._events();
    }

    AttachmentController.prototype.options = {
      // add any default options in here...
    }

    AttachmentController.prototype._initialize = function () {
      /*Dropzone.options.attachmentFormDropzone = {
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
        onInit: function(){
          $.danidemo.addLog('#demo-debug', 'default', 'Plugin initialized correctly');
        },
        onBeforeUpload: function(id){
          $.danidemo.addLog('#demo-debug', 'default', 'Starting the upload of #' + id);
          $.danidemo.updateFileStatus(id, 'default', 'Uploading...');
        },
        onNewFile: function(id, file){
          $.danidemo.addFile('#demo-files', id, file);

        },
        onComplete: function(){
          $.danidemo.addLog('#demo-debug', 'default', 'All pending tranfers completed');
        },
        onUploadProgress: function(id, percent){
          var percentStr = percent + '%';
          $.danidemo.updateFileProgress(id, percentStr);
        },
        onUploadSuccess: function(id, data){
          $.danidemo.addLog('#demo-debug', 'success', 'Upload of file #' + id + ' completed');
          $.danidemo.addLog('#demo-debug', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
          $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
          $.danidemo.updateFileProgress(id, '100%');
        },
        onUploadError: function(id, message){
          $.danidemo.updateFileStatus(id, 'error', message);
          $.danidemo.addLog('#demo-debug', 'error', 'Failed to Upload file #' + id + ': ' + message);
        },
        onFileTypeError: function(file){
          $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
        },
        onFileSizeError: function(file){
          $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
        },
        /*onFileExtError: function(file){
          $.danidemo.addLog('#demo-debug', 'error', 'File \'' + file.name + '\' has a Not Allowed Extension');
        },*/
        onFallbackMode: function(message){
          $.danidemo.addLog('#demo-debug', 'info', 'Browser not supported(do something else here!): ' + message);
        }
      });
    };

    AttachmentController.prototype.client = function (id, name) {
        $("#client_id-field").val(name);
        $("input[name='client_id']").val(id);
    };

    AttachmentController.prototype.updateAttachments = function (data) {
        var resourceData = {
          'resourceType' : 'Ticket',
          'resourceId' : this.options.ticketId,
          'attachment' : data.attachment
        };
        attachmentService.show(resourceData, function(html) {
          $("#attachments-holder").append(html);
        });
    };

    AttachmentController.prototype.showAttachments = function () {
        var resourceData = {
          'resourceType' : 'Ticket',
          'resourceId' : this.options.ticketId
        };
        $("#attachments-holder").html('<p>Loading attachments...</p>');

        attachmentService.all(resourceData, function(data) {
          $("#attachments-holder").html(data);
        });
    };

    AttachmentController.prototype._events = function () {
        var self = this;
        self.showAttachments();

        $("#attachment-editor").summernote({
          minHeight: 100,
          maxHeight: null,
          focus: false,
          placeholder: 'Add attachment or upload file here...',
          toolbar: [
             ['style', ['bold', 'italic', 'underline', 'clear']],
             ['para', ['ul', 'ol']]
          ],
          callbacks: {
            onInit: function() {
              $("#attachment-editor-group").find('.note-editor .note-toolbar .note-btn').attr('tabindex', '-1');
           }
          }
        });

        $("#save-attachment").click(function() {
          var saveBtn = $(this);
          saveBtn.prop('disabled', true);
          var attachmentObj = {
            attachment : $("#attachment-editor").summernote('code'),
            resourceType : $("#attachmentable-type").val(),
            resourceId : $("#attachmentable-type-id").val()
          };

          attachmentService.add(attachmentObj, function (data) {
            self.updateAttachments(data);
            $("#comment-editor").summernote('code', '');
            saveBtn.prop('disabled', false);
          });
        });
    };

    window.AttachmentController = AttachmentController;
})(jQuery, window, AloFramework);
