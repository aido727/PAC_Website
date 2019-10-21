/*	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time */

(function ($) {

    // Define the AHyoutube button
    $.cleditor.buttons.AHyoutube = {
        name: "AHyoutube",
        image: "youtube.gif",
        title: "Insert YouTube Video",
        command: "inserthtml",
        popupName: "AHyoutube",
        popupClass: "cleditorPrompt",
        popupContent:
            '<label>Enter YouTube Id:<br /><input type="text" style="width:200px"></label><br/>' +
			'<label>Height (px):<br /><input type="text" style="width:200px"></label><br/>' +
			'<label>Width (px):<br /><input type="text" style="width:200px"></label><br/>' +
            '<br /><input type="button" value="Submit">',
        buttonClick: youtubeButtonClick
    };

    // AHyoutube button click event handler
    function youtubeButtonClick(e, data) {

        // Wire up the submit button click event handler
        $(data.popup).children(":button")
            .unbind("click")
            .bind("click", function (e) {

                // Get the editor
                var editor = data.editor;

                // Get the input content
                var $text = $(data.popup).find(":text"),
                    id = $text[0].value,
					height = parseInt($text[1].value),
					width = parseInt($text[2].value);

                // Build the html
                var html;
                if (id != null && id != "") {
					html = '[youtube id="' + id + '"';
					
					if(height > 0) {
						html = html + ' height="' + height;
					}
					
					if(width > 0) {
						html = html + ' width="' + width;
					}
					html = html + '/]';
                }

                // Insert the html
                if (html)
                    editor.execCommand(data.command, html, null, data.button);

                // Reset the text, hide the popup and set focus
                $text.val("");
                editor.hidePopups();
                editor.focus();

          });

    }

})(jQuery);