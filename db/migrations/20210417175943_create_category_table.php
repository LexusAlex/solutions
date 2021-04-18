<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCategoryTable extends AbstractMigration
{
    public function up()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `category` (
          `id` VARCHAR(255) NOT NULL,
          `title` VARCHAR(255) NOT NULL,
          `created_at` INT NOT NULL,
          PRIMARY KEY (`id`)
        ) CHARACTER SET utf8 COLLATE utf8_general_ci;';

        $this->execute($sql);
    }

    public function down()
    {
        $sql = 'DROP TABLE `category`';

        $this->execute($sql);
    }
}
