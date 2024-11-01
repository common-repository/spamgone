<?php
	add_action('activity_box_end', 'comments_filter_dashboard_add');
	
	function comments_filter_dashboard_add()
	{
		$options = get_option('comments_filter_options');
		if (empty($options['comments_filter_blocked_count'])) {
			$options['comments_filter_blocked_count'] = 0;
		}
		$blocked_count = $options['comments_filter_blocked_count'];		
		
		print '<br/>';
		print '<div id="comments_filter_stats"><span class="cfstrong">SpamGone</span> has' .
				' blocked <span class="cfstrong">' . $blocked_count .'</span> spam comments. <a href="http://slothbrains.com/spamgone-plugin">Click here to Donate!</a></div>';
	}
?>