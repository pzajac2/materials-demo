<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200127175827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creates relations between MaterialGroup entities';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE material_groups ADD parent_id INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE material_groups ADD CONSTRAINT FK_615FB24B727ACA70 FOREIGN KEY (parent_id) REFERENCES material_groups (id)');
        $this->addSql('CREATE INDEX IDX_615FB24B727ACA70 ON material_groups (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE material_groups DROP FOREIGN KEY FK_615FB24B727ACA70');
        $this->addSql('DROP INDEX IDX_615FB24B727ACA70 ON material_groups');
        $this->addSql('ALTER TABLE material_groups DROP parent_id');
    }
}
