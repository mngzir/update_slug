<?php

function create_locations_slugs() {

    $regions_without_slug = Region::newInstance()->listAll();

    foreach ($regions_without_slug as $location) {
        Region::newInstance()->updateByPrimaryKey(array('s_slug' => osc_sanitize_string($location['s_name'])), $location['pk_i_id']);
    }

    $cities_without_slug = City::newInstance()->listAll();

    foreach ($cities_without_slug as $location) {
        City::newInstance()->updateByPrimaryKey(array('s_slug' => osc_sanitize_string($location['s_name'])), $location['pk_i_id']);
    }
 
    $category_without_slug = Category::newInstance()->listAll();
    var_dump($category_without_slug) ;
    foreach ($category_without_slug as $category) {
        $conn = getConnection();
	      $conn->osc_dbExec("UPDATE %st_category_description SET s_slug = '%s' WHERE fk_i_category_id = '%d'", DB_TABLE_PREFIX, osc_sanitize_string($category['s_name']),$category['pk_i_id']);
    }
}

osc_add_hook('admin_footer', 'create_locations_slugs');
?>
