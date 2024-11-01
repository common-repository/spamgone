jQuery(document).ready(function() {
	jQuery("#comments_filter_method1").on("click", function(event) {
		jQuery("#comments_filter_text_selectors").attr("readonly", true);		
	});
	
	jQuery("#comments_filter_method2").on("click", function(event) {
		jQuery("#comments_filter_text_selectors").attr("readonly", false);		
	});
	
	jQuery("#comments_filter_text_selectors").attr("readonly", jQuery("#comments_filter_method1").attr("checked"));
});