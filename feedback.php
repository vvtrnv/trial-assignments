<?php
include_once 'path.php';
include_once 'app/controllers/feedbackFormController.php'
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Обратная связь</title>

	<!-- INCLUDE CSS styles -->
	<link rel="stylesheet" href="css/main.css">
	<!-- INCLUDE jQuery 3.6.0 -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'app/include/header.php';?>

<div class="layout">

  <div class="container__btn-back">
    <form action="feedback.php" method="post">
      <button class="button button-back" name="btn-back"
              value="<?= isset($_SERVER['HTTP_REFERER']) ? stringHandling($_SERVER['HTTP_REFERER']) : ''; ?>">Назад</button>
    </form>
  </div>

  <form class="feedback-form" action="feedback.php" method="post">
    <h1>Обратная связь</h1>

    <div class="feedback-form_message">
		<?php foreach ($msgError as $idObj => $content): ?>
          <p><?=$content?></p>
		<?php endforeach; ?>
    </div>

    <div class="feedback-form__group">
      <label class="feedback-form__label" for="username">Логин</label>
      <input class="feedback-form__input" type="text" name="username" id="username" value="<?=$username?>" required>
    </div>

    <div class="feedback-form__group">
      <label class="feedback-form__label" for="email">Почта</label>
      <input class="feedback-form__input" type="text" name="email" id="email" value="<?=$email?>" required>
    </div>

    <div class="feedback-form__group">
      <label class="feedback-form__label" for="birthday">Дата рождения</label>
      <input class="feedback-form__input" type="date" name="birthday" id="birthday" value="<?=$birthday?>" required>
    </div>

    <div class="feedback-form__group">
      <label class="feedback-form__label" for="username">Пол</label>
      <input type="radio" name="gender" value="0" id="man" <?= $gender == 0 ? 'checked' : ''; ?> checked>
      <label for="man">Мужской</label>
      <input type="radio" name="gender" value="1" id="woman" <?= $gender == 1 ? 'checked' : ''; ?>>
      <label for="woman">Женский</label>
    </div>

    <div class="feedback-form__group">
      <label class="feedback-form__label" for="title">Тема обращения</label>
      <input class="feedback-form__input" type="text" name="title" id="title" required>
    </div>

    <div class="feedback-form__group">
      <label class="feedback-form__label" for="description">Суть вопроса</label>
      <textarea class="feedback-form__input" name="description" cols="30" rows="10" id="description" style="resize: none" required></textarea>
    </div>

    <div class="feedback-form__group">
      <input type="checkbox" id="agreement" name="agreement" value="agree" required>
      <label for="agreement">с контрактом ознакомлен</label>
    </div>

    <button type="submit" name="btn-submit" class="button button-success">Отправить</button>

  </form>
</div>

<?php include_once 'app/include/footer.php';?>

<?php

// Подсвечивание полей с ошибками
echo "<script>";
foreach ($msgError as $idObj => $content):
    echo "$('{$idObj}').css('border', '2px solid #c70000');\n";
endforeach;
echo "</script>";

?>

</body>
