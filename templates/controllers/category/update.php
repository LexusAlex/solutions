<div class="card border-success">
    <div class="card-header bg-transparent border-success">
        <div>
            <?php
            /**
             * @var string $title
             */
            echo $title;
            ?>
        </div>
    </div>
    <div class="card-body">

        <?php
        /**
         * @var array $errors
         */
        if (count($errors) > 0) {

            ?>
            <div >
                <ul class="alert alert-danger">
                    <?php
                    foreach ($errors as $key => $error) {
                        echo '<li>'.$error.'</li>';
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>
        <?php
        /**
         * @var object $category
         */
        ?>
        <form action="/category/update/<?php echo $category->id?>" method="post" enctype="application/x-www-form-urlencoded">
            <div class="form-group">
                <label for="CategoryTitle">Название категории</label>
                <input value="<?php echo $category->title;?>" name="Category[title]" type="text" class="form-control" id="CategoryTitle" aria-describedby="categoryHelp" placeholder="Введите название категории">
                <small id="categoryHelp" class="form-text text-muted">Название должно отражать суть категории.</small>
            </div>
            <div class="form-group">
                <label for="CategoryCreate">Родительский раздел</label>
                <select id="CategoryParentId" class="custom-select custom-select-sm" name="Category[parent_id]">
                    <?php
                    /**
                     * @var array $cat
                     */
                    foreach ($cat as $key => $category2) { ?>
                        <option <?php if($category->parent_id == $category2['id']) { echo 'selected';}?> value="<?php echo $category2['id']?>"><?php echo $category2['title'];?></option>
                    <?php } ?>
                </select>
                <small id="categoryHelp" class="form-text text-muted">Выберете родительский раздел</small>
            </div>
            <button type="submit" class="btn btn-success">Редактировать</button>
        </form>
    </div>
</div>
