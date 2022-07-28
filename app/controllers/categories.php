<?php

include SITE_ROOT . '/app/database/requests.php';

$products= [];
$category = [];
$catID = null;
$catName = '';
$catDescription = '';
$countPages = 1;
$currentPage = 1;
const NUM = 12;

/**
 * Вывод категорий и количества товара в них
 * @return void
 */
function getCategoriesAndCountProducts() {
	$res = selectCategoriesAndCountProducts();
	foreach ($res as $key => $category) {
		echo "<li class=\"categories_item\"><a href=\"category_detail.php?cat_id={$category['category_id']}\">{$category['name']} ({$category['count_product']})</a></li>";
	}
}


/**
 * Получает массив товаров выбранной категории
 * @param $cat_id
 * @return array|false
 */
function getAllProductsWithCatID($cat_id, $page) {
	return selectAllProductsWithCatID($cat_id, ($page - 1)* NUM, NUM);
}

//function getPageLinkBar($catID) {
//
//	// Получаем номер требуемой страницы,
//	// если пользователь только перешёл - устанавливаем 1
//	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
//
//	$countRows = countFoundRowsOnLastQuery();
//	$countPages = (int)$countRows['found_rows'] / NUM;
//	if((int)$countRows['found_rows'] % NUM !== 0) {
//		$countPages++;
//	}
//
////	// Формируем меню
////	$linkBar = '';
////	for($i = 1; $i <= $countPages; $i++) {
////		$linkBar = $linkBar . "<a href='?cat_id={$catID}&page={$i}'>{$i} </a>";
////	}
////	echo $linkBar;
//
////	return $page;
//}

// Получение информации о категории и запись в переменные, которые используются в category_detail.php
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cat_id'])) {
	$catID = (int)$_GET['cat_id'];

	$currentPage = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	$category = selectOne('category', ['category_id' => $catID]);
	$catID = $category['category_id'];
	$catName = $category['name'];
	$catDescription = $category['description'];
	$products = getAllProductsWithCatID($catID, $currentPage);
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cat_id']) || isset($_GET['page'])) {
	// Получаем номер требуемой страницы,
	// если пользователь только перешёл - устанавливаем 1
	$currentPage = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	$countRows = countFoundRowsOnLastQuery();
	$countPages = (int)$countRows['found_rows'] / NUM;
	if((int)$countRows['found_rows'] % NUM !== 0) {
		$countPages++;
	}
}
