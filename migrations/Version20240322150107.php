<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322150107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE science_tag1 (science_id INT NOT NULL, tag1_id INT NOT NULL, PRIMARY KEY(science_id, tag1_id))');
        $this->addSql('CREATE INDEX IDX_915EC787F4A44BFA ON science_tag1 (science_id)');
        $this->addSql('CREATE INDEX IDX_915EC787BC66DF02 ON science_tag1 (tag1_id)');
        $this->addSql('ALTER TABLE science_tag1 ADD CONSTRAINT FK_915EC787F4A44BFA FOREIGN KEY (science_id) REFERENCES science (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE science_tag1 ADD CONSTRAINT FK_915EC787BC66DF02 FOREIGN KEY (tag1_id) REFERENCES tag1 (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE science_tag1 DROP CONSTRAINT FK_915EC787F4A44BFA');
        $this->addSql('ALTER TABLE science_tag1 DROP CONSTRAINT FK_915EC787BC66DF02');
        $this->addSql('DROP TABLE science_tag1');
    }
}
