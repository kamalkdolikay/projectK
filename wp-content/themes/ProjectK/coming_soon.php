<?php



/*

Template Name: Coming Soon

*/

if(isset($_POST['email'])){
	if(!empty($_POST['email'])){
	$email = $_POST['email'];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 

$to = $rd_data['rd_csp_mail_adress'];
$subject = $rd_data['rd_csp_mail_subject'];
	$message = $email;
	$headers = $subject;

    mail($to, $subject, $message, $headers); 
	echo 'sent';
	exit;
	}else{
	echo 'invalid';
	exit;
	}

 }}

get_header('blank');
global $rd_data;

$days = $rd_data['rd_csp_days'];
$days_c = $rd_data['rd_csp_days_color'];
$hours = $rd_data['rd_csp_hours'];
$hours_c = $rd_data['rd_csp_hours_color'];
$minutes = $rd_data['rd_csp_minutes'];
$minutes_c = $rd_data['rd_csp_minutes_color'];
$seconds = $rd_data['rd_csp_seconds'];
$seconds_c = $rd_data['rd_csp_seconds_color'];
$csp_text = $rd_data['rd_csp_text'];
$csp_date = $rd_data['rd_csp_date'];
$mail_form = $rd_data['rd_csp_mail'];
$mail_placeholder = $rd_data['rd_csp_mail_placeholder'];
$mail_invalid = __('Invalid Email, please provide an correct email.','thefoxwp');
$mail_sent = __('Your Email was sent!','thefoxwp');




wp_enqueue_script('timeCircles', get_template_directory_uri() . '/js/TimeCircles.js');

?>

<div class="section def_section">

<div class='thefox_bigloader'>

<div class='thefox_loader_line'>
<div class='loader_tophalf'></div>
<div class='loader_inner'></div>
<div class='loader_bottomhalf'></div>
<div class='loader_button'></div>
</div>

<div class='thefox_loader_logo'>
<?php if($rd_data['rd_csp_logo']['url'] !== ''){ ?>
<img  src="<?php echo esc_url($rd_data['rd_csp_logo']['url']); ?>"/>
<?php } ?>
</div> 

</div>

<div class="coming_soon_text"><?php echo !empty( $csp_text ) ? $csp_text : ''; ?></div>
<div class="coming_soon_ctn">
<div class="timing">
                                    <div id="count-down" data-date="<?php echo esc_attr($csp_date); ?> 00:00:00">
                                        
                                    </div>
                                </div>
                             </div>   
                               
<?php if($mail_form == 'yes'){ ?>
<form action="" method="post" id="coming_soon_form" >
<input type="email" name="email" id="email" placeholder="<?php echo esc_attr($mail_placeholder); ?>" /><br />
<input type="button" value="" id="submit" /><div id="success"></div>
</form>
<?php } ?>
</div>
<?php get_footer('blank'); ?>
<script>
jQuery.noConflict();
var $ = jQuery;
"use strict";

$(document).ready(function(){
	

$('#submit').click(function(){
	
$("#coming_soon_form").css('opacity','0.8');

$.ajax({type: "POST",data: $("#coming_soon_form").serialize(), success: function(data) {   

$("#coming_soon_form").css('opacity','1');
 if(data == 'sent'){$('#success').html('<?php echo esc_js($mail_sent); ?>');}else{$('#success').html('<?php echo esc_js($mail_invalid); ?>');}
 
}});
return false;


});	
	
      $("#count-down").TimeCircles(
       {   
	       <?php if($rd_data['rd_csp_style'] == 'white_csp'){ ?>
           circle_bg_color: "#ccd3d7",
		   <?php }else{?>
           circle_bg_color: "#222533",
		   <?php }?>
           use_background: true,
           bg_width: 1.0,
           fg_width: 0.02,
           time: {
                Days: { color: "<?php echo esc_js($days_c); ?>",text: "<?php echo esc_js($days); ?>" },
                Hours: { color: "<?php echo esc_js($hours_c); ?>",text: "<?php echo esc_js($hours); ?>"  },
                Minutes: { color: "<?php echo esc_js($minutes_c); ?>",text: "<?php echo esc_js($minutes); ?>"  },
                Seconds: { color: "<?php echo esc_js($seconds_c); ?>",text: "<?php echo esc_js($seconds); ?>"  }
            }
       }
    );
});
</script> 