<?php



require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) { // check if id is number and not null, for safety

    $article = Article::getSingleArticle($conn, $_GET['id']);

    if (!$article) {

        die('article not found');
    }
} else {

    die("id not supplied, article not found");
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    var_dump($_FILES);

    // switch case for upload errors
    try {

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No File Uploaded.');
                break;
            default:
                throw new Exception('Error Occured');
                break;
        }


        // check for file size
        if ($_FILES['file']['size'] > 128000000) {
            throw new Exception("file is too large");
        }

        // check to see if file type is image; if not, throw exception
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

        // get info about uploaded file type
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
        }


        // choose destination folder and move the file in it

        $pathinfo = pathinfo($_FILES['file']['name']);

        $base = $pathinfo['filename'];

        // trim file name to db acceptable length
        $base = mb_substr($base, 0, 200);

        // regex to filter name
        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        $filename = $base . "." . $pathinfo['extension'];

        $destination = "../uploads/$filename";

        $i = 1;

        // if file with same name exists, add -$i to it;
        while (file_exists($destination)) {

            $filename = $base . "-$i." . $pathinfo['extension'];
            $destination = "../uploads/$filename";
            $i++;
        }

        // move the files to root/uploads folder
        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

            $previous_image = $article->image_file;

            if ($article->setImageFile($conn, $filename)) {

                // if file is updated, delete previous;
                if ($previous_image) {
                    unlink("../uploads/$previous_image");
                }

                URL::redirect("/admin/article.php?id={$article->id}");
            }
        } else {

            throw new Exception("could not upload to directory");
        }

        // catch exceptions
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>

<?php require '../includes/header.php'  ?>

<h2>Edit Article image</h2>

<?php if ($article->image_file) : ?>
    <img src="../uploads/<?= $article->image_file ?>" alt="article image">
    <a href="delete-article-img.php?id=<?= $article->id ?>">Delete Article</a>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <div>
        <label for="file"></label>
        <input type="file" name="file" id="file">
    </div>
    <button>upload</button>
</form>

<?php require '../includes/footer.php'  ?>