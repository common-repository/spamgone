<?php

function comments_filter_options_page()
{
	include('comments_filter_admin_page.php');
}
function comments_filter_admin_add_page()
{
	add_options_page('SpamGone Options', 'SpamGone Options', 'manage_options', 'spamgone-options',
					'comments_filter_options_page');
}
function comments_filter_admin_init()
{
	register_setting( 'comments_filter_options', 'comments_filter_options', 'comments_filter_options_validate' );
	add_settings_section('comments_filter_main', '', 'comments_filter_section_text', 'comments_filter');
	add_settings_field('comments_filter_method', 'Please specify how you would like to hide the website field.',
						'comments_filter_setting_method', 'comments_filter', 'comments_filter_main');
	add_settings_field('comments_filter_text_selectors',
						'Supply selectors for elements to filter out, separate with ";".',
						'comments_filter_setting_selectors', 'comments_filter','comments_filter_main');
	add_settings_field('comments_filter_block_content_url',
						'Block comments with URL in comment\'s body.',
						'comments_filter_setting_block_content', 'comments_filter','comments_filter_main');
}
function comments_filter_settings_link($links, $file)
{
	if ($file == plugin_basename( dirname(__FILE__).'/comments_filter.php')) {
		$settings_link = '<a href="admin.php?page=spamgone-options">'.__("Settings", "Comments Filter Settings").'</a>';
		$donate_link = '<a href="http://slothbrains.com/spamgone-plugin">Donate</a>';
		$links[] = $settings_link;
		$links[] = $donate_link;
	}

	return $links;
}

function comments_filter_enqueue_scripts()
{
	$jsurl = plugins_url('/comments_filter_admin.js', __FILE__);
	wp_enqueue_script('jquery');
	wp_enqueue_script('comments_filter_admin', $jsurl);
}

function comments_filter_options_validate($input)
{
	$newinput['comments_filter_selectors'] = trim($input['comments_filter_selectors']);
	if(!preg_match('/^[^{}]*$/i', $newinput['comments_filter_selectors'])) {
		$newinput['comments_filter_selectors'] = '';
	}
	$newinput['comments_filter_method'] = trim($input['comments_filter_method']);
	$newinput['comments_filter_block_content'] = trim($input['comments_filter_block_content']);

	$options = get_option('comments_filter_options');
	$blocked_count = $options['comments_filter_blocked_count'];
	$newinput['comments_filter_blocked_count'] = $blocked_count;

	return $newinput;
}



add_action('admin_menu', 'comments_filter_admin_add_page');
add_action('admin_init', 'comments_filter_admin_init');
add_filter('plugin_action_links', 'comments_filter_settings_link', 10, 2);
add_action('admin_enqueue_scripts', 'comments_filter_enqueue_scripts');


?>
