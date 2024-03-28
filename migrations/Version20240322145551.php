<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322145551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag1_science DROP CONSTRAINT fk_b1cff138bc66df02');
        $this->addSql('ALTER TABLE tag1_science DROP CONSTRAINT fk_b1cff138f4a44bfa');
        $this->addSql('DROP TABLE tag1_science');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE tag1_science (tag1_id INT NOT NULL, science_id INT NOT NULL, PRIMARY KEY(tag1_id, science_id))');
        $this->addSql('CREATE INDEX idx_b1cff138f4a44bfa ON tag1_science (science_id)');
        $this->addSql('CREATE INDEX idx_b1cff138bc66df02 ON tag1_science (tag1_id)');
        $this->addSql('ALTER TABLE tag1_science ADD CONSTRAINT fk_b1cff138bc66df02 FOREIGN KEY (tag1_id) REFERENCES tag1 (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag1_science ADD CONSTRAINT fk_b1cff138f4a44bfa FOREIGN KEY (science_id) REFERENCES science (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
