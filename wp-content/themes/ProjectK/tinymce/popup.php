<?php



// loads the shortcodes class, wordpress is loaded with it



require_once( 'shortcodes.class.php' );



// get popup type



$popup = trim( $_GET['popup'] );



$shortcode = new rd_shortcodes( $popup );





?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/tinymce/js/options-custom.js"></script>

</head>



<body>

<div id="rd-popup">

  <div id="rd-shortcode-wrap">

    <div id="rd-sc-form-wrap">

      <div id="rd-sc-form-head"> <?php echo esc_html($shortcode->popup_title); ?> </div>

      

      <!-- /#rd-sc-form-head -->

      

      <form method="post" id="rd-sc-form">

        <table id="rd-sc-form-table">

          <?php echo ''.$shortcode->output; ?>

          <tbody>

            <tr class="form-row">

              <?php if( ! $shortcode->has_child ) : ?>

              <td class="label">&nbsp;</td>

              <?php endif; ?>

              <td class="field"><a href="#" class="button-primary rd-insert">Insert Shortcode</a></td>

            </tr>

          </tbody>

        </table>

        

        <!-- /#rd-sc-form-table -->

        

      </form>

      

      <!-- /#rd-sc-form --> 

      

    </div>

    

    <!-- /#rd-sc-form-wrap -->

    

    <div id="rd-sc-preview-wrap">

      <div id="rd-sc-preview-head"> Shortcode Preview </div>

      

      <!-- /#rd-sc-preview-head -->

      

      <?php if( $shortcode->no_preview ) : ?>

      <div id="rd-sc-nopreview">Shortcode has no preview</div>

      <?php else : ?>

      <iframe src="<?php echo RD_TINYMCE_URI; ?>/preview.php?sc=" width="249" frameborder="0" id="rd-sc-preview"></iframe>

      <?php endif; ?>

    </div>

    

    <!-- /#rd-sc-preview-wrap -->

    

    <div class="clear"></div>

  </div>

  

  <!-- /#rd-shortcode-wrap --> 

  

</div>



<!-- /#rd-popup -->



</body>

</html>