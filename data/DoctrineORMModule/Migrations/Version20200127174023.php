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
            INSERT INTO `units_of_measure` (`name`, `short_name`)
            VALUES 
                ('sztuki', 'szt.'),
                ('opakowania', 'op.'),
                
                ('milimetry', 'mm'),
                ('centymetry', 'cm'),
                ('metry', 'm'),
                ('kilometry', 'km'),
                
                ('miligramy', 'mg'),	
                ('gramy', 'g'),	
                ('kilogramy', 'kg'),	
                ('tony', 't'),	
                
                ('milimetry kwadratowe', 'mm²'),	
                ('centymetry kwadratowe', 'cm²'),	
                ('metry kwadratowe', 'm²'),	
            
                ('milimetry sześcienne', 'mm³'),	
                ('centymetry sześcienne', 'cm³'),	
                ('litry', 'l'),	
                ('metry sześcienne', 'm³')
            ;
SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $this->throwIrreversibleMigrationException();
    }
}
