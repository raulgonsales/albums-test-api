<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022210046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP CONSTRAINT fk_39986e43b03a8386');
        $this->addSql('DROP INDEX idx_39986e43b03a8386');
        $this->addSql('ALTER TABLE album RENAME COLUMN created_by_id TO owner_id_id');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E438FDDAB70 FOREIGN KEY (owner_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_39986E438FDDAB70 ON album (owner_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE album DROP CONSTRAINT FK_39986E438FDDAB70');
        $this->addSql('DROP INDEX IDX_39986E438FDDAB70');
        $this->addSql('ALTER TABLE album RENAME COLUMN owner_id_id TO created_by_id');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT fk_39986e43b03a8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_39986e43b03a8386 ON album (created_by_id)');
    }
}
