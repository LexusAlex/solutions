<div class="row">
    <div class="col-6">
        <div>
            <h2>
                <?php
                /**
                 * @var string $title
                 * @var array $categories
                 */
                echo $title;
                ?>
            </h2>
            <ul>
                <?php
                foreach ($categories as $category) { ?>
                    <li><?php echo $category['title'];?></li>
                <?php } ?>
            </ul>
            <a class="btn btn-success" href="/category/create">Новая категория</a>
        </div>
    </div>
    <div class="col-6">

    </div>
</div>