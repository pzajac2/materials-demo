<?php

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20200129083141 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $sql = <<<SQL

/*!40000 ALTER TABLE `material_groups` DISABLE KEYS */;
INSERT INTO `material_groups` (`id`, `name`, `parent_id`) VALUES
	(1, 'Do samochodu', NULL),
	(2, 'Części samochodowe', 1),
	(3, 'Oleje silnikowe', 1),
	(4, 'Chemia samochodowa', 1),
	(5, 'Mineralne', 3),
	(6, 'Półsyntetyczne', 3),
	(7, 'Syntetyczne', 3),
	(8, 'Klocki hamulcowe', 2),
	(9, 'Oświetlenie', 1);
/*!40000 ALTER TABLE `material_groups` ENABLE KEYS */;
ó
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT IGNORE INTO `materials` (`id`, `unit_of_measure_id`, `material_group_id`, `code`, `name`) VALUES
	(1, 16, 7, '5W40', 'Olej 5W40'),
	(2, 16, 6, 'Olej 10W30', 'Olej 10W30'),
	(3, 2, 9, 'H4', 'Żarówka H4'),
	(4, 2, 9, 'H7', 'Żarówka H7'),
	(5, 1, 4, 'SZ03', 'Płyn do Szyb'),
	(6, 2, 8, 'F12', 'Klocki hamulcowe Fiat 500');
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;

SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException();
    }

}
