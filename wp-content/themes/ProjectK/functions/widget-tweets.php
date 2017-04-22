<?php
add_action('widgets_init', 'tweets_load_widgets');

function tweets_load_widgets()
{
	register_widget('Tweets_Widget');
}

class Tweets_Widget extends WP_Widget {
	
	function Tweets_Widget()
	{
		$widget_ops = array('classname' => 'tweets', 'description' => '');

		$control_ops = array('id_base' => 'tweets-widget');

		$this->WP_Widget('tweets-widget', 'Custom Twitter Widget', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];
		$twitter_id = $instance['twitter_id'];
		$count = $instance['count'];

		echo !empty( $before_widget ) ? $before_widget : '';
		
		if($title) {
					echo !empty( $before_title ) ? $before_title : '';
					echo !empty( $title ) ? $title : '';
					echo !empty( $after_title ) ? $after_title : '';
		}
		
		if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 
		$transName = 'list_tweets_'.$args['widget_id'];
		$cacheTime = 10;
		delete_transient($transName);
		if(false === ($twitterData = get_transient($transName))) {
		     // require the twitter auth class
		     @require_once 'twitteroauth/twitteroauth.php';
		     $twitterConnection = new TwitterOAuth(
							$consumer_key,	// Consumer Key
							$consumer_secret,   	// Consumer secret
							$access_token,       // Access token
							$access_token_secret    	// Access token secret
							);
		    $twitterData = $twitterConnection->get(
							  'statuses/user_timeline',
							  array(
							    'screen_name'     => $twitter_id,
							    'count'           => $count,
							    'exclude_replies' => false
							  )
							);
		     if($twitterConnection->http_code != 200)
		     {
		          $twitterData = get_transient($transName);
		     }

		     // Save our new transient.
		     set_transient($transName, $twitterData, 60 * $cacheTime);
		};
		$twitter = get_transient($transName);
		if($twitter && is_array($twitter)) {
			//var_dump($twitter);
		?>

					<div class="tweets-container" id="tweets_<?php echo esc_attr($args['widget_id']); ?>">
						<ul class="tweets">
							<?php foreach($twitter as $tweet): ?>
							<li>
								<p>
								<?php
								$latestTweet = $tweet->text;
								$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
								$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
								echo !empty( $latestTweet ) ? $latestTweet : '';
								?>
								</p>
								<?php
								$twitterTime = strtotime($tweet->created_at);
								$timeAgo = $this->ago($twitterTime);
								?>
								<span><a href="http://twitter.com/<?php echo esc_attr($tweet->user->screen_name); ?>/statuses/<?php echo esc_attr($tweet->id_str); ?>" ><?php echo !empty( $timeAgo ) ? $timeAgo : ''; ?></a></span>
							</li>
							<?php endforeach; ?>
						</ul>
		</div>
		<?php }}
		
		echo !empty( $after_widget ) ? $after_widget : '';
	}
	
	function ago($time)
	{
	   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();

	       $difference     = $now - $time;
	       $tense         = "ago";

	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] ago ";
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Tweets', 'twitter_id' => '', 'count' => 3);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p><a href="http://dev.twitter.com/apps">Find or Create your Twitter App</a></p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>">Consumer Key:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_key')); ?>" value="<?php echo esc_attr($instance['consumer_key']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>">Consumer Secret:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_secret')); ?>" value="<?php echo esc_attr($instance['consumer_secret']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('access_token')); ?>">Access Token:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('access_token')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token')); ?>" value="<?php echo esc_attr($instance['access_token']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>">Access Token Secret:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token_secret')); ?>" value="<?php echo esc_attr($instance['access_token_secret']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>">Twitter ID:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_id')); ?>" value="<?php echo esc_attr($instance['twitter_id']); ?>" />
		</p>

			<label for="<?php echo esc_attr($this->get_field_id('count')); ?>">Number of Tweets:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" value="<?php echo esc_attr($instance['count']); ?>" />
		<p></p>

	<?php
	}
}
?>