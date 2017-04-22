/* =========================================================
 * custom_views.js v1.1
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Visual composer Frontend modals & collections
 * ========================================================= */

(function ( $ ) {
	if ( _.isUndefined( window.vc ) ) {
		window.vc = {};
	}
	/**
	 * Shortcode model
	 * @type {*}
	 */
	var Shortcode = Backbone.Model.extend( {
		defaults: function () {
			var id = vc_guid();
			return {
				id: id,
				shortcode: 'vc_text_block',
				order: vc.shortcodes.nextOrder(),
				params: {},
				parent_id: false
			};
		},
		settings: false,
		getParam: function ( key ) {
			return _.isObject( this.get( 'params' ) ) && ! _.isUndefined( this.get( 'params' )[ key ] ) ? this.get( 'params' )[ key ] : '';
		},
		sync: function () {
			return false;
		},
		setting: function ( name ) {
			if ( this.settings === false ) {
				this.settings = vc.getMapped( this.get( 'shortcode' ) ) || {};
			}
			return this.settings[ name ];
		},
		view: false
	} );
	/**
	 * Collection of all shortcodes.
	 * @type {*}
	 */
	var Shortcodes = Backbone.Collection.extend( {
		model: Shortcode,
		sync: function () {
			return false;
		},
		nextOrder: function () {
			if ( ! this.length ) {
				return 1;
			}
			return this.last().get( 'order' ) + 1;
		},
		initialize: function () {
			this.bind( 'remove', this.removeChildren, this );
			this.bind( 'remove', vc.builder.checkNoContent );
			this.bind( 'remove', this.removeEvents, this );
		},
		comparator: function ( model ) {
			return model.get( 'order' );
		},
		removeEvents: function ( model ) {
			//Triggering shortcodes destroy in frontend
			vc.events.triggerShortcodeEvents( 'destroy', model );
		},
		/**
		 * Remove all children of the model from storage.
		 * Will remove children of children models too.
		 * @param parent - model which is parent
		 */
		removeChildren: function ( parent ) {
			var models = vc.shortcodes.where( { parent_id: parent.id } );
			_.each( models, function ( model ) {
				model.destroy(); // calls itself recursively removeChildren
			}, this );
		},
		stringify: function ( state ) {
			return this.modelsToString( vc.shortcodes.where( { parent_id: false } ), state );
		},
		modelsToString: function ( models, state ) {
			var string = '';
			_.each( models, function ( model ) {
				var tag = model.get( 'shortcode' ),
					params = model.get( 'params' ),
					content = _.isString( params.content ) ? params.content : '';
				content += this.modelsToString( vc.shortcodes.where( { parent_id: model.get( 'id' ) } ), state );
				var data = {
					tag: tag,
					attrs: _.omit( params, 'content' ),
					content: content,
					type: _.isUndefined( vc.getParamSettings( tag,
						'content' ) ) && ! vc.getMapped( tag ).is_container ? 'single' : ''
				};
				if ( _.isUndefined( state ) ) {
					model.trigger( 'stringify', model, data );
				} else {
					model.trigger( 'stringify:' + state, model, data );
				}
				string += wp.shortcode.string( data );
			}, this );
			return string;
		},
		create: function ( model, options ) {
			model = Shortcodes.__super__.create.call( this, model, options );
			if ( model.get( 'cloned' ) ) {
				vc.events.triggerShortcodeEvents( 'clone', model );
			}
			vc.events.triggerShortcodeEvents( 'add', model );

			return model;
		}
	} );
	vc.shortcodes = new Shortcodes;
})( window.jQuery );