<?php

include SITE_ROOT . '/app/database/requests.php';

$products= [];
$catID = null;
$catName = '';
$catDescription = '';
$countPages = 1;
$currentPage = 1;
const NUM = 12;


/**
 * Проверка переменной на пустоту
 * @param $value
 * @return void
 */
function checkVar(&$value) {
	if(empty($value)) {
		redirectNotFoundPage();
	}
}


/**
 * Получает массив товаров выбранной категории
 * @param $cat_id
 * @return array|false
 */
function getAllProductsWithCatID($cat_id, $page) {
	return selectAllProductsByCatID($cat_id, ($page - 1)* NUM, NUM);
}



if(isset($_POST['btn-back'])) {
	header('Location:' . BASE_URL);
}

/**
 * Если не указана категория в GET параметре
 */
if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['cat_id'])) {
	redirectNotFoundPage();
}


/**
 * Получение данных о категории и запись в переменные, которые используются в category_detail.php
 */
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cat_id'])) {
	$catID = intHandling($_GET['cat_id']);

	$currentPage = !empty($_GET['page']) ? intHandling($_GET['page']) : 1;

	$category = selectOne('category', ['category_id' => $catID]);
	if(empty($category)) {
		redirectNotFoundPage();
	}

	$catID = $category['category_id'];
	$catName = $category['name'];
	$catDescription = $category['description'];

	$products = getAllProductsWithCatID($catID, $currentPage);
	if(empty($products)) {
		redirectNotFoundPage();
	}
	$countRows = countFoundRowsOnLastQuery();
}


/**
 * Получаем информацию о количестве товаров и устанавливаем переменные currentPage и countPages
 */
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cat_id']) || isset($_GET['page'])) {
	// Получаем номер требуемой страницы,
	// если пользователь только перешёл - устанавливаем 1
	$currentPage = !empty($_GET['page']) ? intHandling($_GET['page']) : 1;

	$countPages = (int)$countRows['found_rows'] / NUM;
	if((int)$countRows['found_rows'] % NUM !== 0) {
		$countPages++;
	}
}