<?php

include SITE_ROOT . '/app/database/requests.php';

$images = [];
$productInfo = [];
$productCategories = [];
$productID = -1;

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
 * Если не указан параметр GET['id'] то редиректим на страницу 404
 */
if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['id'])) {
	redirectNotFoundPage();
}


/**
 * Получение данных о товаре
 */
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
	$productID = (int)$_GET['id'];

	$images = selectImagesOfProductByID($productID);
	checkVar($images);

	$productCategories = selectCategoriesAndCountProducts($productID);
	checkVar($productCategories);

	$productInfo = selectProductWithMainImageByID($productID);
	checkVar($productInfo);
}


/**
 * Обработка нажатия кнопки "Назад"
 */
if(isset($_POST['btn-back']) && isset($_POST['p_id'])) {
	$urlBack = htmlspecialchars($_POST['btn-back']);
	$productID = (int)$_POST['p_id'];

	if(empty($urlBack)) {
		$product = selectOne('product', ['product_id' => $productID]);
		checkVar($product);

		header('Location: ' . BASE_URL . 'category_detail.php?cat_id=' . $product['main_category_id']);
	}
	else {
		echo $urlBack;
		$categoryBack = 1;
	}
}