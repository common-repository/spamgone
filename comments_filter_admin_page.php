<?php

$options = get_option('comments_filter_options');
$selection = $options['comments_filter_method'];
$selectors = $options['comments_filter_selectors'];
$checked = $options['comments_filter_block_content'];

if (empty($selection)) {
	$selection = 'filter';
}

?>

<div class='wrap'>

<style type="text/css">
a.tooltip {background:#ffffff;font-weight:bold;text-decoration:none;padding:2px 6px;}
a.tooltip:hover {background:#ffffff; text-decoration:none;} /*BG color is a must for IE6*/
a.tooltip span {display:none;font-weight:normal; padding:2px 3px; margin-left:8px; width:230px;}
a.tooltip:hover span{display:inline; position:absolute; background:#ffffff; border:1px solid #cccccc; color:#6c6c6c;}
#comments_filter_block_content{margin-right:10px;}
</style>

<div id="icon-options-general" class="icon32"></div><h2>SpamGone Options</h2>

<p>SpamGone will automatically hide the website field on your comment form whilst also blocking spambots that try to post a URL in your comments.  This is a futureproof method that blocks almost 100% of spam, no other plugins required!</p>

<p>In most cases SpamGone will be able to hide the URL field in your comments automatically using option 1 below. However some older themes will not support the automatic hide.  To check, logout and view a post with comments.  If the URL box is hidden no further action is required.  If however the URL box is still visible please select 'Option 2 : Hide via CSS' and enter the CSS selectors for the URL box and it's label separated by semicolons (;).  In most cases '#url;label[for=url]' will work.</p>

<p>If you have any trouble, visit our support <a href='http://slothbrains.com/spamgone-plugin'>page and leave a comment.</a></p>

<p><b>Happily SPAM Free?  Consider Donating :)</b></p>
<hr />
<h3>How Should SpamGone Hide the URL box?</h3>


    

<form method="POST" action="options.php">
<?php
settings_fields('comments_filter_options');
#do_settings_sections('comments_filter');
?>
<table class="form-table">
        <tr valign="top">
        <th scope="row"><b>Option 1 :</b> Automatic hide (default)</th>
        <td><input id="comments_filter_method1" type="radio" name="comments_filter_options[comments_filter_method]" value="filter" <?php if($selection == 'filter'){echo 'checked';} ?> /> <a href="#" class="tooltip">?<span>SpamGone will attempt to hide the website/URL field on your comments form automatically.<p>If this option doesn't work, use option 2</p></span></a></td>
		
		</tr>
         
        <tr valign="top">
        <th scope="row"><b>Option 2 :</b> Hide via CSS </th>
        <td><input id="comments_filter_method2" type="radio" name="comments_filter_options[comments_filter_method]" value="css" <?php if($selection == 'css'){echo 'checked';} ?>/> <a href="#" class="tooltip">?<span>If the automatic hide did not work for you, you can hide the URL field using CSS.  <p>Simply enter the CSS selectors for the url field and it's label seperated by a semicolon (;). SpamGone will apply 'display:none' to these elements.</p><p>In most cases entering '.comment#url; label[for=url]' works</p><p>If you have any problems, visit my support page :)</p></span></a></td>
        
		</tr>
        
        <tr valign="top">
        <th scope="row"></th>
        <td><input id="comments_filter_text_selectors" type="text" name="comments_filter_options[comments_filter_selectors]" value="<?php echo $selectors; ?>" class="regular-text"/>
		<span class="settings-description"><br/>Enter the selectors you wish to hide separated by (;) </span>
		</td>
		
        </tr>
    </table>

<br/><br/>
<h3>Should SpamGone block comments containing URL's in the comment box?</h3>

        <input id="comments_filter_block_content" name="comments_filter_options[comments_filter_block_content]" type="checkbox" <?php if($checked == 'on'){echo 'checked="checked"';}?>/>Yes! Please block all comments that contain a URL in the comment box.
<p class="submit">
<input name="Submit" type="submit" class="button-primary" value="<?php echo esc_attr_e('Save Changes');?>" />
</p>
</form>
</div>