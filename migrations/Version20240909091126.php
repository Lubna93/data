<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909091126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE data (id INT NOT NULL, type_id INT DEFAULT NULL, licence_id INT DEFAULT NULL, titre VARCHAR(400) NOT NULL, createdat TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, published BOOLEAN NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ADF3F363C54C8C93 ON data (type_id)');
        $this->addSql('CREATE INDEX IDX_ADF3F36326EF07C9 ON data (licence_id)');
        $this->addSql('ALTER TABLE data ADD CONSTRAINT FK_ADF3F363C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE data ADD CONSTRAINT FK_ADF3F36326EF07C9 FOREIGN KEY (licence_id) REFERENCES licence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE data_id_seq CASCADE');
        $this->addSql('ALTER TABLE data DROP CONSTRAINT FK_ADF3F363C54C8C93');
        $this->addSql('ALTER TABLE data DROP CONSTRAINT FK_ADF3F36326EF07C9');
        $this->addSql('DROP TABLE data');
    }
}
