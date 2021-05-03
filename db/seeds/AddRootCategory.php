<?php


use Phinx\Seed\AbstractSeed;

class AddRootCategory extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $date = new DateTimeImmutable();
        $current_date = $date->format('Y-m-d H:i:s');

        //2021-05-03 01:33:37
        $sql = "INSERT INTO category (id, title, created_at, parent_id) VALUES (0, 'Корневой элемент', "."'".$current_date."'".", 0)";
        $this->execute($sql);
    }
}
