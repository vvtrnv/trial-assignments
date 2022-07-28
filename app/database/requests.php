<?php

require_once 'connect.php';

function test($value) {
	echo '<pre>';
	print_r($value);
	echo '</pre>';
	exit();
}


/**
 * Проверка выполнения запроса к БД
 * @param $query
 * @return bool|void
 */
function checkError($query) {
	$errInfo = $query->errorInfo();
	if ($errInfo[0] !== PDO::ERR_NONE) {
		echo $errInfo[2];
		exit();
	}
	return true;
}


/**
 * При наличии параметров для select составляет строку запроса с переданными параметрами
 * @param string $sql
 * @param array-key $params
 * @return string
 */
function checkParameters($sql, $params) {
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
 * @param string $table
 * @param array-key $params
 * @return array|false
 */
function selectOne($table, $params = []) {
	global $pdo;

	$sql = "SELECT * FROM $table";

	// Обработка параметров (при наличии)
	$sql = checkParameters($sql, $params);

	$sql = $sql . " LIMIT 1";

	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetch();
}

/**
 * Посылает запрос к БД на получение списка категорий и кол-ва товаров в ней
 * @return array|false
 */
function selectCategoriesAndCountProducts() {
	global $pdo;

	$sql = "SELECT c.category_id, 
       			   c.name, 
       			   COUNT(pc.product_id) as count_product 
				FROM product_categories pc 
			    JOIN category c ON pc.category_id = c.category_id
				JOIN product p ON pc.product_id = p.product_id
				WHERE p.is_active = true
				GROUP BY c.category_id, c.name
				ORDER BY count_product DESC";

	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetchAll();
}

/**
 * Посылает запрос к БД на получение списка товаров из выбранной категории
 * @param int $cat_id
 * @return array|false
 */
function selectAllProductsWithCatID($cat_id, $page, $countPerPage) {
	global $pdo;

	$cat_id = (int)$cat_id;
	$page = (int)$page;
	$countPerPage = (int)$countPerPage;

	$sql = "SELECT 	SQL_CALC_FOUND_ROWS
       				p.name as p_name, 
					i.path,
       				i.alt,
					c.name as cat_name
				FROM product_categories pc
				JOIN product p ON pc.product_id = p.product_id
				JOIN category c ON p.main_category_id = c.category_id
				JOIN image i ON p.main_image_id = i.image_id
				WHERE pc.category_id = $cat_id
					  AND p.is_active = true
				LIMIT $page, $countPerPage";

	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetchAll();
}

/**
 * Возвращает кол-во строк, найденных предыдущим запросом
 * @return array-key
 */
function countFoundRowsOnLastQuery() {
	global $pdo;

	$sql = "SELECT FOUND_ROWS() as found_rows";

	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetch();
}


