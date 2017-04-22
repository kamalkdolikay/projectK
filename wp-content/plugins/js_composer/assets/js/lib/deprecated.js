if ( jQuery.fn.bxSlider !== undefined ) {
	jQuery( '.bxslider' ).each( function () {
		var $slider = jQuery( this );
		$slider.bxSlider( $slider.data( 'settings' ) );
	} );
}
if ( window.Swiper !== undefined ) {

	jQuery( '.swiper-container' ).each( function () {
		var $this = jQuery( this ),
			my_swiper,
			max_slide_size = 0,
			options = jQuery( this ).data( 'settings' );
		if ( options.mode === 'vertical' ) {
			$this.find( '.swiper-slide' ).each( function () {
				var height = jQuery( this ).outerHeight( true );
				if ( height > max_slide_size ) {
					max_slide_size = height;
				}
			} );
			$this.height( max_slide_size );
			$this.css( 'overflow', 'hidden' );
		}
		jQuery( window ).resize( function () {
			$this.find( '.swiper-slide' ).each( function () {
				var height = jQuery( this ).outerHeight( true );
				if ( height > max_slide_size ) {
					max_slide_size = height;
				}
			} );
			$this.height( max_slide_size );
		} );
		my_swiper = jQuery( this ).swiper( jQuery.extend( options, {
			onFirstInit: function ( swiper ) {
				if ( swiper.slides.length < 2 ) {
					$this.find( '.vc_arrow-left,.vc_arrow-right' ).hide();
				} else if ( swiper.activeIndex === 0 && swiper.params.loop !== true ) {
					$this.find( '.vc_arrow-left' ).hide();
				} else {
					$this.find( '.vc_arrow-left' ).show();
				}
			},
			onSlideChangeStart: function ( swiper ) {
				if ( swiper.slides.length > 1 && swiper.params.loop !== true ) {
					if ( swiper.activeIndex === 0 ) {
						$this.find( '.vc_arrow-left' ).hide();
					} else {
						$this.find( '.vc_arrow-left' ).show();
					}
					if ( swiper.slides.length - 1 === swiper.activeIndex ) {
						$this.find( '.vc_arrow-right' ).hide();
					} else {
						$this.find( '.vc_arrow-right' ).show();
					}
				}
			}
		} ) );
		$this.find( '.vc_arrow-left' ).click( function ( e ) {
			e.preventDefault();
			my_swiper.swipePrev();
		} );
		$this.find( '.vc_arrow-right' ).click( function ( e ) {
			e.preventDefault();
			my_swiper.swipeNext();
		} );
		my_swiper.reInit();
	} );

}
