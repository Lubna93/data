<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322132207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tag1_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag1 (id INT NOT NULL, titret VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag1_science (tag1_id INT NOT NULL, science_id INT NOT NULL, PRIMARY KEY(tag1_id, science_id))');
        $this->addSql('CREATE INDEX IDX_B1CFF138BC66DF02 ON tag1_science (tag1_id)');
        $this->addSql('CREATE INDEX IDX_B1CFF138F4A44BFA ON tag1_science (science_id)');
        $this->addSql('ALTER TABLE tag1_science ADD CONSTRAINT FK_B1CFF138BC66DF02 FOREIGN KEY (tag1_id) REFERENCES tag1 (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag1_science ADD CONSTRAINT FK_B1CFF138F4A44BFA FOREIGN KEY (science_id) REFERENCES science (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tag1_id_seq CASCADE');
        $this->addSql('ALTER TABLE tag1_science DROP CONSTRAINT FK_B1CFF138BC66DF02');
        $this->addSql('ALTER TABLE tag1_science DROP CONSTRAINT FK_B1CFF138F4A44BFA');
        $this->addSql('DROP TABLE tag1');
        $this->addSql('DROP TABLE tag1_science');
    }
}
