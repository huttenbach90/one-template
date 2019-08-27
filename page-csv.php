<?php /* Template Name: CSV */ ?>

<?php 
$prenos = "60";
$my_query = new WP_Query( 
				array( 
					'posts_per_page' => -1, 
					'category__and' => array( $prenos ),
					'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash') 
				) 
			); 
$i = 1; 

while ($my_query->have_posts()) : $my_query->the_post(); 

	echo $i;
	echo ";";

	the_title();

	echo ";";
	
	$childs = array(); 
	foreach (get_the_category($post_id) as $a) { 
		if (cat_is_ancestor_of($prenos, $a)) {
			$cat_a = get_category($a); 
			array_push($childs, $cat_a->name); 
		}
	} 
	if (sizeOf($childs) > 0) { 
		$post_childs = implode(',', $childs); 
		echo $post_childs;
		echo ";";
	}  else {
		echo ";";
	}

	$categories = array(); 
	foreach (get_the_category($post_id) as $b) { 
		if (!cat_is_ancestor_of($prenos, $b)) {
			$cat_b = get_category($b); 
			array_push($categories, $cat_b->name); 
		}
	} 
	if (sizeOf($categories) > 0) { 
		$post_cats = implode(',', $categories); 
		echo $post_cats;
	} 
	

	
	?>
	<br> 
<?php
$i++; 
endwhile; ?>
			  

            