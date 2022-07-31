<?php
include_once 'path.php';
include_once 'app/controllers/productController.php';
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $productInfo['name']?></title>

  <!-- INCLUDE FONTAWESOME -->
  <script src="https://kit.fontawesome.com/b6912d0d45.js" crossorigin="anonymous"></script>
  <!-- INCLUDE CSS styles -->
  <link rel="stylesheet" href="css/main.css">
  <!-- INCLUDE jQuery 3.6.0 -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <!-- INCLUDE Notify.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
</head>
<body>

<?php include 'app/include/header.php';?>

<div class="layout">

  <div class="container__btn-back">
    <form action="product.php" method="post">
      <input type="hidden" name="p_id" value="<?=$productID;?>">
      <button class="button button-back" name="btn-back"
              value="<?= isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : ''; ?>">Назад</button>
    </form>
  </div>

  <div class="product">

    <!-- Gallery -->
    <div class="product__gallery">
      <div class="product__preview">
        <?php foreach ($images as $key => $image): ?>
          <img src="<?=$image['path']?>" alt="<?= $image['alt'];?>" class="product__preview--photo">
        <?php endforeach; ?>
        <div class="product__preview--next-image col-12">
          <a href="#"><img src="img/icons/next.svg" alt=""></a>
        </div>
      </div>

      <div class="product__main">
        <img src="<?=$productInfo['main_image_path'];?>" alt="<?=$productInfo['main_image_alt'];?>" class="product__main--photo">
      </div>

    </div>

    <!--  Description  -->
    <div class="product__description">
      <h1 class="product__title"><?= $productInfo['name'];?></h1>

      <div class="product__categories">
        <?php foreach ($productCategories as $key => $category): ?>
          <a href="category_detail.php?cat_id=<?= $category['cat_id']; ?>" class=""><?= $category['cat_name']; ?></a>
        <?php endforeach; ?>
      </div>

      <div class="product__price">
        <div class="product__price-actual">
          <span class="product__price-old"><?= number_format($productInfo['price'], 2, '.', ' '); ?></span>
          <span class="product__price-current price"><?= number_format($productInfo['price_with_sale'], 2, '.', ' '); ?></span>
        </div>
        <div class="product__price-discount">
          <span class="price"><?= number_format($productInfo['price_with_promo'], 2, '.', ' '); ?></span>
          <span class="sale">— с промокодом</span>
        </div>
      </div>

      <div class="product__info">
        <div class="product__info--existence">
          <i class="fa-solid fa-check"></i> В наличии в магазине <a href="#">Lamoda</a>
        </div>
        <div class="product__info--delivery">
          <i class="fa-solid fa-truck"></i> Бесплатная доставка
        </div>
      </div>

      <div class="product__quantity">
        <button class="button-minus" type="button" name="minus">
          <img src="img/icons/minus_disable.svg" alt="минус">
        </button>
        <input type="text" name="quantity" value="1">
        <button class="button-plus" type="button" name="plus">
          <img src="img/icons/plus.svg" alt="плюс">
        </button>
      </div>

      <div class="product__actions">
        <button onclick="test()" type="submit" name="toshop" class="button button-buy">Купить</button>
        <button type="submit" name="tofavorites" class="button button-to-favorites">В избранное</button>
      </div>

      <div class="product__about">
        <p><?= $productInfo['description']; ?></p>
      </div>

      <div class="product__share">
        <span>Поделиться:</span>
        <a href="#"><img src="img/icons/vk.svg" alt="vk" class="product__share--icon"></a>
        <a href="#"><img src="img/icons/google.svg" alt="google plus" class="product__share--icon"></a>
        <a href="#"><img src="img/icons/face.svg" alt="facebook" width="5" height="12" class="product__share--icon"></a>
        <a href="#"><img src="img/icons/twitter.svg" alt="twitter" class="product__share--icon"></a>

        <div class="count-twits">
          <div id="#triangle-left"></div>
          <div class="count">123</div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include_once 'app/include/footer.php';?>

<!-- INCLUDE SCRIPT IMAGE LOOP -->
<script src="js/image-loop.js"></script>
<script src="js/counter.js"></script>
</body>
</html>

