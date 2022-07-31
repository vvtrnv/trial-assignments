<?php

require_once 'connect.php';

function test($value) {
	echo '<pre>';
	print_r($value);
	echo '</pre>';
	exit();
}

/**
 * Функция редиректа на 404 страницу (прерывает дальнейшую работу скрипта)
 * @return void
 */
function redirectNotFoundPage() {
	header('Location: ' . BASE_URL . '404.html');
	exit();
}


/**
 * При наличии параметров для select составляет строку запроса с переданными параметрами
 * @param string $sql
 * @param array-key $params
 * @return string
 */
function prepareParamsToString($sql, $params) {
	if(!empty($params)) {
		$i = 0;
		foreach ($params as $key => $value) {
			if(!is_numeric($value)) {
				$value = "'" . $value . "'";
			}
			if($i === 0) {
				$sql = $sql . " WHERE $key = $value";
			}
			else {
				$sql = $sql . " AND $key = $value";
			}
			$i++;
		}
	}

	return $sql;
}


/**
 * Возвращает кол-во строк, полученных предыдущим запросом
 * @return array-key
 */
function countFoundRowsOnLastQuery() {
	global $pdo;

	$sql = "SELECT FOUND_ROWS() as found_rows";

	$query = $pdo->prepare($sql);

	$query->execute();

	return $query->fetch();
}


/**
 * @param string $table
 * @param array-key $params
 * @return array|false
 */
function selectOne($table, $params = []) {
	global $pdo;

	$sql = "SELECT * FROM $table";

	// Обработка параметров (при наличии)
	$sql = prepareParamsToString($sql, $params);

	$sql = $sql . " LIMIT 1";

	$query = $pdo->prepare($sql);

	$query->execute();

	return $query->fetch();
}


/**
 * Посылает запрос к БД на получение списка категорий и кол-ва товаров в ней.
 * Опционально: при передаче параметра (id товара) получает категории только конкретного товара
 * @param int $productID
 * @return array|false
 */
function selectCategoriesAndCountProducts($productID = null) {
	global $pdo;

	$searchWithProductID = "";

	if($productID) {
		$searchWithProductID = " AND pc.product_id = $productID";
	}

	$sql = "SELECT c.category_id as cat_id, 
       			   c.name as cat_name, 
       			   COUNT(pc.product_id) as count_product 
				FROM product_categories pc 
			    JOIN category c ON pc.category_id = c.category_id
				JOIN product p ON pc.product_id = p.product_id
				WHERE p.is_active = true 
					 $searchWithProductID
				GROUP BY c.category_id, c.name
				ORDER BY count_product DESC";

	$query = $pdo->prepare($sql);

	$query->execute();

	return $query->fetchAll();
}


/**
 * Посылает запрос к БД на получение списка товаров из выбранной категории
 * @param int $catID
 * @return array|false
 */
function selectAllProductsByCatID($catID, $page, $countPerPage) {
	global $pdo;

	$sql = "SELECT 	SQL_CALC_FOUND_ROWS
       				pc.product_id as p_id,
       				p.name as p_name, 
					i.path,
       				i.alt,
					c.name as cat_name
				FROM product_categories pc
				JOIN product p ON pc.product_id = p.product_id
				JOIN category c ON p.main_category_id = c.category_id
				JOIN image i ON p.main_image_id = i.image_id
				WHERE pc.category_id = $catID
					  AND p.is_active = true
				LIMIT $page, $countPerPage";

	$query = $pdo->prepare($sql);

	$query->execute();

	return $query->fetchAll();
}


/**
 * Посылает запрос к БД на получение массива картинок товара по его id
 * @param int $productID
 * @return array|false
 */
function selectImagesOfProductByID($productID) {
	global $pdo;

	$sql = "SELECT 	i.path,
					i.alt
				FROM images
				JOIN product p ON images.product_id = p.product_id
				JOIN image i ON images.image_id = i.image_id
				WHERE images.product_id = $productID 
					  AND p.is_active = true";

	$query = $pdo->prepare($sql);

	$query->execute();

	return $query->fetchAll();
}


function selectProductWithMainImageByID($productID) {
	global $pdo;

	$sql = "SELECT	p.product_id as p_id,
       				p.name,
				 	i.path as main_image_path,
				 	i.alt as main_image_alt,
				 	p.description,
				 	p.price,
				 	p.price_with_sale,
				 	p.price_with_promo,
				 	p.is_active
				FROM product p
				JOIN image i ON p.main_image_id = i.image_id
				WHERE p.product_id=$productID
				LIMIT 1";

	$query = $pdo->prepare($sql);

	$query->execute();

	return $query->fetch();
}




///**
// * Посылает запрос к БД на получение массива c категориями товара
// * @param int $productID
// * @return array|false
// */
//function selectProductCategoriesByID($productID) {
//	global $pdo;
//
//	$sql = "SELECT	pc.category_id as cat_id,
//       				c.name as cat_name
//				FROM product_categories pc
//    			JOIN category c ON pc.category_id = c.category_id
//				JOIN product p ON pc.product_id = p.product_id
//    			WHERE pc.product_id = $productID";
//
//	$query = $pdo->prepare($sql);
//
//	$query->execute();
//
//	return $query->fetchAll();
//}