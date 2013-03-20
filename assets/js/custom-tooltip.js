	(function($){

	var methods = {
		init : function( options ) {
			// Default settings
			var defaults = {
				'text' : 'XXXXX',
				'type' : 'text',
				'position' : 'left',
				'disablePos' : false, 
				'css' : {}
			};

			// Extend settings
			var settings = $.extend(defaults, options);

			// Method to chain elements
			return this.each(function(i) {
				var _this = $(this);

				if(settings.text != 'XXXXX') {
					// Do Nothing
				} else {
					// Check if input element has data-error attribute
					settings.text = ( _this.data('error') ) ? _this.data('error') : settings.text;	
				}

				// Create HTML of Tooltip
				var tooltip = $("<div class='HCLtooltip'><span class='tooltip-arrow'></span><p>" + settings.text + "</p></div>")

				// Make parent div relative
				_this.parent().css('position', 'relative');

				// Get position of input element
				var pos = _this.position();

				// Set tooltip to be below input element
				if(!settings.disablePos) {
					tooltip.css({
						'left': pos.left
					});
				} else {
					if($.isEmptyObject(settings.css)){
						tooltip.css({
							'margin-left': pos.left,
							'margin-top' : '-4px'
						});
					} else {
						tooltip.css(settings.css);
					}
				}

				if(settings.type == 'checkbox') {
					tooltip.addClass('center');
					tooltip.css({
						'margin-top' : '0px',
						'margin-left' : '-72px',
						'left' : '50%'
					});
				} else if(settings.type == 'single') {
					tooltip.css({
						'margin-top' : '4px',
						'margin-left' : '-6px'
					});
				}

				// Check if tooltip exists
				if( !_this.next().hasClass('HCLtooltip') ) {
					// Append Tooltip
					_this.after(tooltip);	
				} 
			});
		},

		hide : function() {
			return this.each(function() {
				var _this = $(this);

				// Check if tooltip exists
				if( _this.next().hasClass('HCLtooltip') ) {
					_this.next().remove();
				}
			})
		}
	};

    $.fn.HCLTooltipValidation = function( method ) {
	    
	    // Method calling logic
	    if ( methods[method] ) {
	      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } else if ( typeof method === 'object' || ! method ) {
	      return methods.init.apply( this, arguments );
	    } else {
	      $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
	    }
    };
})( jQuery );