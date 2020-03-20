<?php
require_once("config.php");
if (!empty($_SESSION['user_id'])) {
    header("location: /index.php");
}
$errors = [];
if (!empty($_POST)){
    if(empty($_POST['user_name'])){
        $errors[] = 'Пожалуйста введите имя пользователя';
    }
    if(empty($_POST['email'])){
        $errors[] = 'Пожалуйста введите email';
    }
    if(empty($_POST['first_name'])){
        $errors[] = 'Пожалуйста введите Имя';
    }
    if(empty($_POST['last_name'])){
        $errors[] = 'Пожалуйста введите фамилию';
    }
    if(empty($_POST['country'])){
        $errors[] = 'Пожалуйста введите Cтрану';
    }
    if(empty($_POST['city'])){
        $errors[] = 'Пожалуйста введите Город';
    }
    if(empty($_POST['gender'])){
        $errors[] = 'Пожалуйста введите Пол';
    }
    if(empty($_POST['password'])){
        $errors[] = 'Пожалуйста введите Пароль';
    }
    if(empty($_POST['confirm_password'])){
        $errors[] = 'Пожалуйста Подтвердите Пароль';
    }
    if (strlen($_POST['user_name']) > 100){
        $errors[] = 'Слишком днинный логин';
    }
    if (strlen($_POST['email']) > 150){
        $errors[] = 'Слишком днинное email';
    }
    if (strlen($_POST['first_name']) > 80){
        $errors[] = 'Слишком днинное имя';
    }
    if (strlen($_POST['last_name']) > 80){
        $errors[] = 'Слишком много символов';
    }
    if (strlen($_POST['country']) > 100){
        $errors[] = 'Слишком днинное название';
    }
    if (strlen($_POST['city']) > 100){
        $errors[] = 'Слишком днинное имя';
    }
    if (strlen($_POST['gender']) > 50){
        $errors[] = 'Слишком много символов';
    }
    if (strlen($_POST['password']) < 6){
        $errors[] = 'Введите более 6 символов';
    }
    if ($_POST['password'] !== $_POST['confirm_password']){
        $errors[] = 'Подтвердите пароль';
    }

    if (empty($errors)){
        $stmt = $dbConn->prepare("INSERT INTO users(username, email, first_name, last_name, country, city, gender, password) VALUES(:username, :email, :first_name, :last_name, :country, :city, :gender, :password)");
        $stmt->execute(array('username' => $_POST['user_name'], 'email' => $_POST['email'], 'first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 'country' => $_POST['country'], 'city' => $_POST['city'], 'gender' => $_POST['gender'], 'password' => sha1($_POST['password'].SALT)));
    }



    header("location: /login.php");

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Guest Book</title>
    <meta charset="UTF-8">
    <link href="css/style.css" media="screen" rel="stylesheet">
</head>
<body>
<header>
    <ul>
        <li><a href="index.php">Комментарии</a></li>
        <li><a href="registration.php">Регистрация</a></li>
        <li><a href="login.php">Авторизация</a></li>
    </ul>
</header>
<div class="body-content container mlogin">
<h1>Страница регистрации</h1>
<div>
    <form method="POST">
        <div style="color: red;">
            <?php foreach ($errors as $error) :?>
                <p><?php echo $error;?></p>
            <?php endforeach; ?>
        </div>
        <div>
            <label>Логин:</label>
            <div>
                <input type="text" name="user_name" id="username" required="" value="<?php echo (!empty($_POST['user_name']) ? $_POST['user_name'] : '');?>"/>
                <span id="username_error" style="color: red;"></span>
            </div>
        </div>
        <div>
            <label>Email:</label>
            <div>
                <input type="email" name="email" id="email" required="" value="<?php echo (!empty($_POST['email']) ? $_POST['email'] : '');?>"/>
                <span id="email_error" style="color: red;"></span>
            </div>
        </div>
        <div>
            <label>Имя:</label>
            <div>
                <input type="text" name="first_name" required="" value="<?php echo (!empty($_POST['first_name']) ? $_POST['first_name'] : '');?>"/>
            </div>
        </div>
        <div>
            <label>Фамилия:</label>
            <div>
                <input type="text" name="last_name" required="" value="<?php echo (!empty($_POST['last_name']) ? $_POST['last_name'] : '');?>"/>
            </div>
        </div>
        <div>
            <label>Страна:</label>
            <div>
                <select class="select" name="country" >
                    <option value="Укажите страну">Укажите страну</option>
                    <option value="Украина">Украина</option>
                    <option value="Англия">Англия</option>
                    <option value="Беларусь">Беларусь</option>
                </select>
            </div>
        </div>
        <div>
            <label>Город:</label>
            <div>
                <select class="select" name="city">
                    <option value="Укажите город">Укажите город</option>
                    <option value="Киев">Киев</option>
                    <option value="Львов">Львов</option>
                    <option value="Ливерпуль">Ливерпуль</option>
                    <option value="Манчестер">Манчестер</option>
                    <option value="Минск">Минск</option>
                </select>
            </div>
        </div>
        <div>
            <label>Пол:</label>
            <div>
                <select class="select" name="gender">
                    <option value="Укажите пол">Укажите пол</option>
                    <option value="Мужской">Мужской</option>
                    <option value="Женский">Женский</option>
                    <option value="Всякое бывает">Всякое бывает</option>
                </select>
            </div>
        </div>
        <div>
            <label>Пароль:</label>
            <div>
                <input type="password" name="password" required="" value=""/>
            </div>
        </div>
        <div>
            <label>Подтвердите пароль:</label>
            <div>
                <input type="password" name="confirm_password" required="" value=""/>
            </div>
        </div>
        <div>
            <br/>
            <input class="button" type="submit" name="submit" id="submit" value="Зарегистрироваться">
        </div>
    </form>
</div>
</div>

</body>
</html>
