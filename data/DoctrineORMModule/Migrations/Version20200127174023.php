<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200127174023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Fills `units_of_measure` table with sample data';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<SQL
            INSERT INTO `units_of_measure` (`id`, `name`, `short_name`)
            VALUES 
                (1, 'sztuki', 'szt.'),
                (2, 'opakowania', 'op.'),
                (3, 'milimetry', 'mm'),
                (4, 'centymetry', 'cm'),
                (5, 'metry', 'm'),
                (6, 'kilometry', 'km'),
                (7, 'miligramy', 'mg'),
                (8, 'gramy', 'g'),	
                (9, 'kilogramy', 'kg'),
                (10, 'tony', 't'),
                (11, 'milimetry kwadratowe', 'mm²'),
                (12, 'centymetry kwadratowe', 'cm²'),
                (13, 'metry kwadratowe', 'm²'),
                (14, 'milimetry sześcienne', 'mm³'),
                (15, 'centymetry sześcienne', 'cm³'),
                (16, 'litry', 'l'),	
                (17, 'metry sześcienne', 'm³')
            ;
SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $this->throwIrreversibleMigrationException();
    }
}
