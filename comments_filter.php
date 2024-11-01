<?php

/**
 * Plugin Name: SpamGone
 * Description: Fed up of Spam Comments? SpamGone is one simple plugin that stops spam dead in it tracks, once and for all.  It removes the author URL field on your comment form and blocks any automatic spam posts that contain a URL either in the author URL box or within the comment text itself.
 * Version: 1.0
 * Author: Svetoslav Nedkov
 * Plugin URI: http://slothbrains.com/spamgone-plugin
 */

add_filter('preprocess_comment', 'comments_filter');
add_filter('comment_form_default_fields', 'post_data_filter');
add_filter('wp_head', 'stylesheet_filter');


if (is_admin())
    require_once dirname( __FILE__ ) . '/comments_filter_admin.php';
    
require_once dirname( __FILE__ ) . '/comments_filter_dashboard.php';

$cssurl = plugins_url('/comments_filter.css', __FILE__);
wp_register_style('comments_filter.css', $cssurl);
wp_enqueue_style('comments_filter.css');


function comments_filter($commentdata)
{
	if(!empty($commentdata['comment_author_url'])) {
		comment_filter_block();
	}
	
	$options = get_option('comments_filter_options');
	$checked_block_content = $options['comments_filter_block_content'];

	if ($checked_block_content === 'on') {
		if (filter_var($commentdata['comment_content'], FILTER_VALIDATE_URL)) {
			comment_filter_block();
		}
	}

	return $commentdata;
}

function post_data_filter($fields)
{
	$options = get_option('comments_filter_options');
	$method = $options['comments_filter_method'];
	
	if ($method == 'filter') {	
	    if(isset($fields['url'])) {
    	    unset($fields['url']);
	    }
	}

    return $fields;
}


function stylesheet_filter()
{
	$options = get_option('comments_filter_options');
	$method = $options['comments_filter_method'];
	
	if ($method == 'css') {
		$selectorstr = $options['comments_filter_selectors'];
		$selectors = explode(';', $selectorstr);
		$code = 'display:none !important;';
	
		print '<style type="text/css">';
		foreach ($selectors as $selector) {
			print $selector . '{';
			print $code;
			print '}';
		}
		print '</style>';
	}
}

function comment_filter_block()
{
	increment_blocked_count();				
	wp_die('Website URL forbidden in comments.');
}

function increment_blocked_count()
{
	$options = get_option('comments_filter_options');
	if (!isset($options['comments_filter_blocked_count'])) {
		$options['comments_filter_blocked_count'] = 0;
	}
	$options['comments_filter_blocked_count']++;
	
	update_option('comments_filter_options', $options);
}

?>
