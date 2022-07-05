<?php if (!empty($article->errors)) : ?>
    <ul>
        <?php foreach ($article->errors as $error) :  ?>
            <li>
                <?= $error  ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<form method="POST">
    <div>
        <label for="title">Article Title</label>
        <input type="text" id="title" name="title" placeholder="Article Title" value="<?= htmlspecialchars($article->title) ?>">
    </div>

    <div>
        <label for="content">Article Content</label>
        <textarea name="content" id="content" cols="40" rows="4" placeholder="Article Content"><?= htmlspecialchars($article->content); ?></textarea>
    </div>

    <div>
        <label for="published_at">Date</label>
        <input type="datetime-local" id="published_at" name="published_at" value="<?= htmlspecialchars($article->published_at) ?>">
    </div>

    <fieldset>
        <legend>Categories</legend>

        <?php foreach ($categories as $category) : ?>
            <div>
                <input type="checkbox" name="category[]" value="<?= $category['id']; ?>" id="<?= $category['id'] ?>" <?php if (in_array($category['id'], $category_ids)) : ?> checked<?php endif; ?>>
                <label for="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
            </div>
        <?php endforeach; ?>
    </fieldset>
    <button>Save</button>
</form>