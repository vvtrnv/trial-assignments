<?php
include_once 'path.php';
include_once 'app/controllers/categories.php';
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trial assignments</title>

	<!-- INCLUDE CSS styles -->
	<link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php include 'app/include/header.php';?>

<div class="layout">
  <div class="categories">
    <div class="categories__detail">
      <h2><?=$catName?></h2>
      <p><?=$catDescription?></p>
    </div>

    <div class="categories__product_list">
      <?php foreach ($products as $key => $product): ?>
        <div class="categories__product-card">
          <div class="categories__container-image">
            <img src="<?=$product['path']?>" alt="<?=$product['alt']?>">
          </div>
          <div class="categories__product-info">
            <div class="categories__product-category">
                <?=$product['cat_name']?>
            </div>
            <div class="categories__product-title">
              <a href="#"><?=$product['p_name']?></a>
            </div>
          </div>
        </div>
	  <?php endforeach; ?>
    </div>
  </div>
  <div class="pages">
    <?php for($numPage = 1; $numPage <= $countPages; $numPage++): ?>
      <a class="page" href="?cat_id=<?=$catID?>&page=<?=$numPage?>"><?=$numPage?> </a>
    <?php endfor;?>
  </div>
</div>

<?php include_once 'app/include/footer.php';?>
</body>