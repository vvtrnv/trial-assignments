<?php
include_once 'path.php';
include_once 'app/controllers/categoryController.php';
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MYshop</title>

	<!-- INCLUDE CSS styles -->
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include 'app/include/header.php';
?>

<div class="layout">
  <div class="categories">
    <h3>Список категорий</h3>
    <ul class="categories__list">
      <?php getCategoriesAndCountProducts() ?>
    </ul>
  </div>

</div>

</body>