var FusionPageBuilder = FusionPageBuilder || {};

( function() {

	jQuery( document ).ready( function() {

		// Highlight Element View.
		FusionPageBuilder.fusion_highlight = FusionPageBuilder.ElementView.extend( {

			/**
			 * Modify template attributes.
			 *
			 * @since 2.0
			 * @param {Object} atts - The attributes.
			 * @return {Object}
			 */
			filterTemplateAtts: function( atts ) {
				var attributes = {};

				// Create attribute objects
				attributes.attr   = this.buildAttr( atts.values );

				// Any extras that need passed on.
				attributes.output = atts.values.element_content;

				return attributes;
			},

			/**
			 * Builds attributes.
			 *
			 * @since 2.0
			 * @param {Object} values - The values.
			 * @return {Object}
			 */
			buildAttr: function( values ) {
				var highlightShortcode = {
					class: 'fusion-highlight'
				};

				var brightnessLevel = jQuery.Color( values.color ).lightness() * 100;
				highlightShortcode[ 'class' ] += ( 50 < brightnessLevel ) ? ' light' : ' dark';

				if ( '' !== values[ 'class' ] ) {
					highlightShortcode[ 'class' ] += ' ' + values[ 'class' ];
				}

				if ( 'yes' === values.rounded ) {
					highlightShortcode[ 'class' ] += ' rounded';
				}

				if ( '' !== values.id ) {
					highlightShortcode.id = values.id;
				}

				if ( 'black' === values.color ) {
					highlightShortcode[ 'class' ] += ' highlight2';
				} else {
					highlightShortcode[ 'class' ] += ' highlight1';
				}

				highlightShortcode.style = 'background-color:' + values.color + ';';

				return highlightShortcode;
			}
		} );
	} );
}( jQuery ) );
