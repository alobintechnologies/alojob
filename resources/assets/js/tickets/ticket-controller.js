;(function ($, window, aloF) {
    var clientService = new ClientService();
    var projectService = new ProjectService();

    function TicketController(options) {
      this.options = $.extend({}, options);
      this._initialize();
      this._events();
    }

    TicketController.prototype.options = {
      // add any default options in here...
    }

    TicketController.prototype._initialize = function () {
    };

    TicketController.prototype.client = function (id, name) {
        $("#client_id-field").val(name);
        $("input[name='client_id']").val(id);
    };

    TicketController.prototype.project = function (id, name) {
        $("#project_id-field").val(name);
        $("input[name='project_id']").val(id);
    };

    TicketController.prototype._events = function () {
        $("#created_at-field").datepicker();

        /*$("#project-add-btn").click(function() {

            aloF.commonModal('Project Add', '', 'show');
        });*/

        $("#description-field").summernote({
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          placeholder: 'Post your discussion here...',
          toolbar: [
             //[groupname, [button list]]
             ['style', ['bold', 'italic', 'underline', 'clear']],
             ['color', ['color']],
             ['para', ['ul', 'ol', 'paragraph']]
         ]
        });

        $("#client_id-field").autocomplete({
          source: function (request, response) {
            clientService.all(request.term, function(data) {
              response(data);
            });
          },
          select: function(event, ui) {
            $("input[name='client_id']").val(ui.item.id);
            $("#client_id-field").val(ui.item.title + " " + ui.item.first_name + " " + ui.item.last_name);
            return false;
          }
        }).autocomplete('instance')._renderItem = function(ul, item) {
          return $("<li>")
              .append("<a>" + item.title + " " + item.first_name + " " + item.last_name + "</a>")
              .appendTo( ul );
        };

        $("#project_id-field").autocomplete({
          source: function (request, response) {
            projectService.all(request.term, function(data) {
              response(data);
            });
          },
          select: function(event, ui) {
            $("input[name='project_id']").val(ui.item.id);
            $("#project_id-field").val(ui.item.title);
            return false;
          }
        }).autocomplete('instance')._renderItem = function(ul, item) {
          return $("<li>")
              .append("<a>" + item.title + "</a>")
              .appendTo( ul );
        };
    };

    window.TicketController = TicketController;
})(jQuery, window, AloFramework);
