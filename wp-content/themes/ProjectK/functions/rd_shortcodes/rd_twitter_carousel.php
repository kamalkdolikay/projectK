<?php 


/*-----------------------------------------------------------------------------------*/



/*  Twitter carousel shortcode



/*-----------------------------------------------------------------------------------*/

	function ago($time)
	{
		$periods = array( __( 'second', 'thefoxwp' ), __( 'minute', 'thefoxwp' ), __( 'hour', 'thefoxwp' ), __( 'day', 'thefoxwp' ), __( 'week', 'thefoxwp' ), __( 'month', 'thefoxwp' ), __( 'year', 'thefoxwp' ), __( 'decade', 'thefoxwp' ) );
		$periods_plural = array( __( 'seconds', 'thefoxwp' ), __( 'minutes', 'thefoxwp' ), __( 'hours', 'thefoxwp' ), __( 'days', 'thefoxwp' ), __( 'weeks', 'thefoxwp' ), __( 'months', 'thefoxwp' ), __( 'years', 'thefoxwp' ), __( 'decades', 'thefoxwp' ) );
		$lengths = array( '60', '60', '24', '7', '4.35', '12', '10' );
		$now = time();
		$difference = $now - $time;
		$tense = __( 'ago', 'thefoxwp' );

		for( $j = 0; $difference >= $lengths[$j] && $j < count( $lengths )-1; $j++ ) {
			$difference /= $lengths[$j];
		}

		$difference = round( $difference );

		if( $difference != 1 ) {
			$periods[$j] = $periods_plural[$j];
		}

	   return sprintf('%s %s %s', $difference, $periods[$j], $tense);
	}


function twitter_sc($atts, $content = null) {  





    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'style' => '',
			
		'heading' => '',

		'count' => '',
		
		'twitter_id' => '',
		
		'access_token_secret' => 'degkxfnE7I3Pgllq9q8dKDq7C5VqxNyQIlDwwxGWEng',
		
		'access_token' => '316276851-Nq7Ir2dy5SEOzTxtY2g60kKOQ3A8bCzEewd4SW3k',
		
		'consumer_secret' => 'xzkMRWiNCyZ2qGFiQmhD7msY9evM67iaIRH3lrSEaH4',
		
		'consumer_key' => '64YUfvpR7VlK8C0MG7GGEg',

		'heading_color' => '',
	
		'text_color' => '',
		
		'hl_color' => '',
		'hover_color' => '',
        'animation' => '',

				
    ), $atts));

	ob_start();
global $rd_data;


if($heading_color == '') {
$heading_color = $rd_data['rd_content_heading_color'];	
}
if($hl_color == '') {
$hl_color = $rd_data['rd_content_hl_color'];	
}
if($text_color == '') {
$text_color = $rd_data['rd_content_text_color'];	
}

if($hover_color == '') {
$hover_color = $rd_data['rd_content_hover_color'];	
}


$rd_twitter = RandomString(20);

		
if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) {
		$transName = 'list_tweets_'.$rd_twitter;
		$cacheTime = 10;
		if(false === ($twitterData = get_transient($transName))) {

			$token = get_option('cfTwitterToken_'.$rd_twitter);

			// get a new token anyways
			delete_option('cfTwitterToken_'.$rd_twitter);

			// getting new auth bearer only if we don't have one
			if(!$token) {
				// preparing credentials
				$credentials = $consumer_key . ':' . $consumer_secret;
				$toSend = base64_encode($credentials);

				// http post arguments
				$args = array(
					'method' => 'POST',
					'httpversion' => '1.1',
					'blocking' => true,
					'headers' => array(
						'Authorization' => 'Basic ' . $toSend,
						'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => array( 'grant_type' => 'client_credentials' )
				);

				add_filter('https_ssl_verify', '__return_false');
				$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

				$keys = json_decode(wp_remote_retrieve_body($response));

				if($keys) {
					// saving token to wp_options table
					update_option('cfTwitterToken_'.$rd_twitter, $keys->access_token);
					$token = $keys->access_token;
				}
			}
			// we have bearer token wether we obtained it from API or from options
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'Authorization' => "Bearer $token"
				)
			);

			add_filter('https_ssl_verify', '__return_false');
			$api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$twitter_id.'&count='.$count;
			$response = wp_remote_get($api_url, $args);

			set_transient($transName, wp_remote_retrieve_body($response), 60 * $cacheTime);
		}
		@$twitter = json_decode(get_transient($transName), true);
		if($twitter && is_array($twitter)) {
			//var_dump($twitter);

$t_style = '<style>';


$t_style .= '#rd_'.$rd_twitter.' .rd_twitter_icon,#rd_'.$rd_twitter.'.rd_tc_2 .rd_twitter_icon:after{color:'.$text_color.'; border-color:'.$text_color.';}#rd_'.$rd_twitter.'.rd_tc_2 .rd_twitter_icon{color:'.$hl_color.'; background:'.$text_color.'; border-color:'.$text_color.';}#rd_'.$rd_twitter.' .tweet_ctn{color:'.$text_color.';}#rd_'.$rd_twitter.' .tweet_ctn a{color:'.$hl_color.';}#rd_'.$rd_twitter.' .tweet_user a,#rd_'.$rd_twitter.' .tc_heading{color:'.$heading_color.';}#rd_'.$rd_twitter.' .tweet_date a{color:'.$text_color.';}#rd_'.$rd_twitter.' .tweet_user a:hover,#rd_'.$rd_twitter.' .tweet_date a:hover,#rd_'.$rd_twitter.' .tweet_ctn a:hover{color:'.$hover_color.';}#rd_'.$rd_twitter.' .tweet_left,#rd_'.$rd_twitter.' .tweet_right{color:'.$text_color.'; border-color:'.$text_color.';}#rd_'.$rd_twitter.' .tweet_left:hover,#rd_'.$rd_twitter.' .tweet_right:hover{background:'.$hover_color.';}';

$t_style .= '</style>';

echo !empty( $t_style ) ? $t_style : '';


		?>



			
		<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
	//setup up Carousel
	j$(window).load(function() {
		j$("#rd_<?php echo esc_js($rd_twitter); ?> ul").carouFredSel({
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: "#rd_<?php echo esc_js($rd_twitter); ?> .tweet_left",
					next: "#rd_<?php echo esc_js($rd_twitter); ?> .tweet_right",
					auto: false,
					items: {
						width: 330,
						height: null,
						visible: {
							min: 1,
							max: 1							
						}
					}
				});
				});
	</script>
	<div class="rd_twitter_carousel <?php echo esc_attr($style.' '.$animation); ?>" id="rd_<?php echo esc_attr($rd_twitter); ?>">

    <div class="rd_twitter_icon"></div>
                    <?php if($style == "rd_tc_2"){ 
					
					echo '<h2 class="tc_heading">'.$heading.'</h2>';
					
					}
					
					?>
						<ul class="rd_tc">
							<?php foreach($twitter as $tweet): ?>
							<li>
								<div class="tweet_ctn">
								<?php
								$latestTweet = $tweet['text'];
								$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
								$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
								echo !empty( $latestTweet ) ? $latestTweet : '';
								?>
								</div>
								<?php
								$twitterTime = strtotime($tweet['created_at']);
								$timeAgo = ago($twitterTime);
								?>
								<div class="tweet_user"><a href="http://twitter.com/<?php echo esc_attr($tweet['user']['screen_name']); ?>/statuses/<?php echo esc_attr($tweet['id_str']); ?>" >@<?php echo esc_html($twitter_id); ?></a></div>
								<div class="tweet_date"><a href="http://twitter.com/<?php echo esc_attr($tweet['user']['screen_name']); ?>/statuses/<?php echo esc_attr($tweet['id_str']); ?>" ><?php echo !empty( $timeAgo ) ? $timeAgo : ''; ?></a></div>
							</li>
							<?php endforeach; ?>
						</ul>
<div class="rd_twitter_nav">
  <p class="tweet_left"></p>
  <p class="tweet_right"></p>
</div>	
                        
		</div>
		<?php }}




$output_string = ob_get_contents();
ob_end_clean();


	return '<div class="clearfix" style="padding-top:'.$margin_top.'px"></div>'.$output_string.'<div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>';

}
add_shortcode( 'twitter_sc', 'twitter_sc' );

?>