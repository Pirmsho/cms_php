<nav>
    <ul>
        <li>
            <?php if ($paginator->previous) : ?>
                <a href="?page=<?= $paginator->previous; ?>">Previous Page</a>
            <?php else : ?>
                Previous Page
            <?php endif; ?>
        </li>

        <li>
            <?php if ($paginator->next) : ?>
                <a href="?page=<?= $paginator->next; ?>">Next Page</a>
            <?php else : ?>
                Next Page
            <?php endif ?>
        </li>
    </ul>
</nav>