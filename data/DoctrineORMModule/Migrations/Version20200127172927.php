<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200127172927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creates base tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE materials (id INT UNSIGNED AUTO_INCREMENT NOT NULL, unit_of_measure_id INT UNSIGNED NOT NULL, material_group_id INT UNSIGNED NOT NULL, code VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9B1716B5DA4E2C90 (unit_of_measure_id), INDEX IDX_9B1716B5B88CFDE5 (material_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE units_of_measure (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material_groups (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE materials ADD CONSTRAINT FK_9B1716B5DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES units_of_measure (id)');
        $this->addSql('ALTER TABLE materials ADD CONSTRAINT FK_9B1716B5B88CFDE5 FOREIGN KEY (material_group_id) REFERENCES material_groups (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE materials DROP FOREIGN KEY FK_9B1716B5DA4E2C90');
        $this->addSql('ALTER TABLE materials DROP FOREIGN KEY FK_9B1716B5B88CFDE5');
        $this->addSql('DROP TABLE materials');
        $this->addSql('DROP TABLE units_of_measure');
        $this->addSql('DROP TABLE material_groups');
    }
}
