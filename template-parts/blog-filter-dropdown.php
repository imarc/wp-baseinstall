<?php
/**
 * Template part for displaying post category filter
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseinstall
 */

?>

<div class="blogSection-sorting">
    <?php // category dropdown menu, automatically directs browser on change 

    if ( 'resources' == get_post_type() || is_page( 'resources' ) ) {
    	// if we're looking at Resources, we need some trickery to make the category dropdown work
    	$categories = get_categories('taxonomy=resource-types'); // get CPT taxonomy 
    	$select = "<select name='cat' id='cat' class='postform choices'>n"; // replicate the dropdown select
    	$select.= "<option value='-1'>Select category</option>n"; // add default 'nothing selected yet' option
    	foreach($categories as $category){ // populate the select options using the CPT terms 
    		if($category->count > 0){
    			// check if category slug matches url to show current selection in dropdown
    			$url = $_SERVER["REQUEST_URI"];
				$selectedItem = ((strpos($url, $category->slug) === false) ? '' : 'selected');
    			$select.= "<option value='" .$category->slug. "' $selectedItem>".$category->name. "</option>";
    		}
    	}
    	$select.= "</select>"; // close the select dropdown 
    	echo $select; ?> 
		<script type="text/javascript">
			var dropdown = document.getElementById("cat");
			function onCatChange() {
				if ( dropdown.options[dropdown.selectedIndex].value != -1 ) {
					// This line is important - this is the URL for the relevant category/taxonomy 
					location.href = "<?php echo home_url();?>/resource-types/"+dropdown.options[dropdown.selectedIndex].value+"/";
				}
			}
			dropdown.onchange = onCatChange;
		</script> <?php 

    } else {
    	// for regular blog posts, we can just use the cat dropdown 
    	$args = array(
    		'show_option_none' => __( 'Select category' ),
    		'class'            => 'choices'
    	);

    	wp_dropdown_categories( $args ); ?>
		<script>
			document.getElementById('cat').onchange = function(){
				if( this.value !== '-1' ){
					window.location='/?cat='+this.value
				}
			}
		</script> <?php 
    } ?>
</div>
