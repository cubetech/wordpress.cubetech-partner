tinymce.create( 
	'tinymce.plugins.cubetech_partner', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_partner_button', 
				{
					cmd   : 'cubetech_partner_button_cmd',
					title : editor.getLang( 'cubetech_partner.buttonTitle', 'cubetech Partner' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_partner_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_partner_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_partner.popupTitle', 'cubetech Partner' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_partner', tinymce.plugins.cubetech_partner );