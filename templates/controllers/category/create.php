<div class="row">
    <div class="col-4"></div>
    <div class="col-8">
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
                    <div class="alert alert-danger" role="alert">
                        <ul>
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
                            <option selected value="0">Корневой элемент</option>
                        </select>
                        <small id="categoryHelp" class="form-text text-muted">Выберете родительский раздел</small>
                    </div>
                    <button type="submit" class="btn btn-success">Создать</button>
                </form>
            </div>
        </div>


    </div>
</div>
