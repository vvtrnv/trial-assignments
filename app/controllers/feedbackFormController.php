<?php

include SITE_ROOT . '/app/database/requests.php';


$msgError = [];
$username = '';
$email = '';
$birthday = '';
$gender = -1;

/**
 * Проверка даты (формат YYYY-MM-DD)
 * @param $value string
 * @return bool
 */
function checkDateBirth($value) {
	if (preg_match("/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/", $value)) {
		return true;
	}

	return false;
}


/**
 * Проверка email
 * @param $value string
 * @return bool
 */
function checkEmail($value) {
	if (preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $value)) {
		return true;
	}

	return false;
}


/**
 * Проверка логина
 * @param $value string
 * @return bool
 */
function checkUsername($value) {
	if (preg_match("/^[a-z0-9_-]{2,35}$/i", $value)) {
		return true;
	}

	return false;
}


/**
 * @param $username string
 * @param $email string
 * @param $birthday string
 * @param $title string
 * @param $description string
 * @return bool
 */
function checkFormParameters($username, $email, $birthday, $title, $description) {
	global $msgError;

	$flag = true;

	if(!checkUsername($username)) {
		$msgError['#username'] = "Логин должен состоять из латинских букв, цифр, -, _ и должен быть не короче 2-ух и не более 30-ти символов\n";
		$flag = false;
	}

	if(!checkEmail($email)) {
		$msgError['#email'] = "Проверьте корректность введённого email (пример: user@mail.ru)\n";
		$flag = false;
	}

	if(!checkDateBirth($birthday)) {
		$msgError['#birthday'] = "Проверьте корректность введённой даты рождения\n";
		$flag = false;
	}

	return $flag;
}


if(isset($_COOKIE['username']) && isset($_COOKIE['email']) && isset($_COOKIE['birthday']) && isset($_COOKIE['gender'])) {
	$username = stringHandling($_COOKIE['username']);
	$email = stringHandling($_COOKIE['email']);
	$birthday = stringHandling($_COOKIE['birthday']);
	$gender = intHandling($_COOKIE['gender']);
}

if(isset($_POST['btn-back'])) {
	header('Location:' . BASE_URL);
}

if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['btn-submit'])) {
	$username = stringHandling($_POST['username']);
	$email = stringHandling($_POST['email']);
	$birthday = stringHandling($_POST['birthday']);
	$gender = intHandling($_POST['gender']);
	$title = stringHandling($_POST['title']);
	$description = stringHandling($_POST['description']);

	$params = ['username' => $username,
		'email' => $email,
		'birthday' => $birthday,
		'gender' => $gender,
		'title' => $title,
		'description' => $description];

	if(checkFormParameters($username, $email, $birthday, $title, $description)) {
		insertInQuestions($params);
	}

	setcookie('username', $params['username'], time() + 3600);
	setcookie('email', $params['email'], time() + 3600);
	setcookie('birthday', $params['birthday'], time() + 3600);
	setcookie('gender', $params['gender'], time() + 3600);
}