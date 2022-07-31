<?php

include SITE_ROOT . '/app/database/requests.php';

$category = [];


/**
 * Вывод категорий и количества товара в них
 * @return void
 */
function getCategoriesAndCountProducts() {
	$res = selectCategoriesAndCountProducts();

	foreach ($res as $key => $category) {
		echo "<li class=\"categories_item\"><a href=\"category_detail.php?cat_id={$category['cat_id']}\">{$category['cat_name']} ({$category['count_product']})</a></li>";
	}
}


