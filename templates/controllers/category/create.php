<div class="row">
    <div class="col-12">
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
                <form action="/category/create" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="form-group">
                        <label for="CategoryTitle">Название категории</label>
                        <input name="Category[title]" type="text" class="form-control" id="CategoryTitle" aria-describedby="categoryHelp" placeholder="Введите название категории">
                        <small id="categoryHelp" class="form-text text-muted">Название должно отражать суть категории.</small>
                    </div>
                    <div class="form-group">
                        <label for="CategoryCreate">Родительский раздел</label>
                        <select id="CategoryParentId" class="custom-select custom-select-sm" name="Category[parent_id]">
                            <?php
                            /**
                             * @var array $categories
                             */
                                foreach ($categories as $key => $category) { ?>
                                    <option value="<?php echo $category['id']?>"><?php echo $category['title'];?></option>
                               <?php } ?>
                        </select>
                        <small id="categoryHelp" class="form-text text-muted">Выберете родительский раздел</small>
                    </div>
                    <button type="submit" class="btn btn-success">Создать</button>
                </form>
            </div>
        </div>
    </div>
</div>
