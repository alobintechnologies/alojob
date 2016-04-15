;(function ($, window, aloF) {
    var clientService = new ClientService();

    function ProjectController(options) {
      this.options = $.extend({}, options);
      this._initialize();
      this._events();
    }

    ProjectController.prototype.options = {
      // add any default options in here...
    }

    ProjectController.prototype._initialize = function () {
    };

    ProjectController.prototype.client = function (id, name) {
        $("#client_id-field").val(name);
        $("input[name='client_id']").val(id);
    };

    ProjectController.prototype._events = function () {
        //$("#created_at-field").datepicker();

        /*$("#project-add-btn").click(function() {

            aloF.commonModal('Project Add', '', 'show');
        });*/
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
    };

    window.ProjectController = ProjectController;
})(jQuery, window, AloFramework);
