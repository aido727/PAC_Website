/*	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time */

(function ($) {

    // Define the AHimage button
    $.cleditor.buttons.AHimage = {
        name: "AHimage",
        image: "image.gif",
        title: "Insert Image",
        command: "inserthtml",
        popupName: "AHimage",
        popupClass: "cleditorPrompt",
        popupContent:
            '<label>Enter URL:<br /><input type="text" style="width:200px"></label><br/>' +
            '<label>Caption:<br /><input type="text" style="width:200px"></label><br/>' +
			'<label>Height (px):<br /><input type="text" style="width:200px"></label><br/>' +
			'<label>Width (px):<br /><input type="text" style="width:200px"></label><br/>' +
            '<br /><input type="button" value="Submit">',
        buttonClick: imageButtonClick
    };

    // AHimage button click event handler
    function imageButtonClick(e, data) {

        // Wire up the submit button click event handler
        $(data.popup).children(":button")
            .unbind("click")
            .bind("click", function (e) {

                // Get the editor
                var editor = data.editor;

                // Get the input content
                var $text = $(data.popup).find(":text"),
                    url = $text[0].value,
                    caption = $text[1].value,
					height = parseInt($text[2].value),
					width = parseInt($text[3].value);

                // Build the html
                var html;
                if (url != null && url != "") {
					html = '<img src="' + url + '"';
					
					if(caption != null) {
						html = html + ' alt="' + caption + '"';
					}
					
					if(height > 0) {
						html = html + ' height="' + height + 'px"';
					}
					
					if(width > 0) {
						html = html + ' width="' + width + 'px"';
					}
					html = html + '/>';
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