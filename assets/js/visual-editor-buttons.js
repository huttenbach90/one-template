(function() {
    tinymce.create("tinymce.plugins.icon_button_plugin", {

        init : function(ed, url) {

            ed.addButton("icon", {
                title : "FontAwesome",
                cmd : "icon_command",
                icon: " dashicons-before dashicons-star-filled",
            });

            ed.addCommand("icon_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = "<i class='fa fa-" + selected_text + "'></i>";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Visual FontAwesome",
                author : "Medard Hüttenbach",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("icon_button_plugin", tinymce.plugins.icon_button_plugin);
})();