<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1> <a href="/udemy_php">My Blog</a></h1>
    </header>
    <nav>
        <?php if (Auth::isLoggedIn()) : ?>
            <a href="/udemy_php/admin/index.php">Administration</a>
            <a href="/udemy_php/admin/new-article.php">New Article</a>
        <?php endif ?>

        <?php if (Auth::isLoggedIn()) : ?>
            <p>You are logged in!</p> <a href="/udemy_php/logout.php">Log out</a>

        <?php else : ?>
            <p>You are not logged in! Please log in to add a new article.</p> <a href="/udemy_php/login.php">Log in</a>
        <?php endif; ?>
    </nav>
    <main>