<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddColumnParentIdOnCategoryTable extends AbstractMigration
{
    public function up()
    {
        $sql  = 'ALTER TABLE category ADD parent_id varchar(255) DEFAULT 0';
        $sql2 = 'ALTER TABLE category ADD CONSTRAINT fk_parent_id
                  FOREIGN KEY (parent_id) REFERENCES category (id)
            ON UPDATE CASCADE
            ON DELETE CASCADE';

        $this->execute($sql);
        $this->execute($sql2);
    }

    public function down()
    {
        $sql = 'ALTER TABLE category DROP CONSTRAINT fk_parent_id';
        $sql2  = 'ALTER TABLE category DROP COLUMN parent_id';

        $this->execute($sql);
        $this->execute($sql2);
    }
}
