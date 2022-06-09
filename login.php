<?php

require 'includes/url.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['username'] === 'Davit' && $_POST['password'] === 'Davit') {

        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        redirect('/');
    } else {

        $error = 'incorrect login';
    }
}

?>



<?php require 'includes/header.php' ?>

<h2>Log In</h2>

<?php if (!empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif ?>
<form method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <button>Log In</button>
</form>

<?php require 'includes/footer.php' ?>