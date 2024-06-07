<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403123600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE science_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag1_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE science (id INT NOT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(500) DEFAULT NULL, body TEXT DEFAULT NULL, published BOOLEAN DEFAULT NULL, createdat TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE science_tag1 (science_id INT NOT NULL, tag1_id INT NOT NULL, PRIMARY KEY(science_id, tag1_id))');
        $this->addSql('CREATE INDEX IDX_915EC787F4A44BFA ON science_tag1 (science_id)');
        $this->addSql('CREATE INDEX IDX_915EC787BC66DF02 ON science_tag1 (tag1_id)');
        $this->addSql('CREATE TABLE tag1 (id INT NOT NULL, titret VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE science_tag1 ADD CONSTRAINT FK_915EC787F4A44BFA FOREIGN KEY (science_id) REFERENCES science (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE science_tag1 ADD CONSTRAINT FK_915EC787BC66DF02 FOREIGN KEY (tag1_id) REFERENCES tag1 (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE science_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag1_id_seq CASCADE');
        $this->addSql('ALTER TABLE science_tag1 DROP CONSTRAINT FK_915EC787F4A44BFA');
        $this->addSql('ALTER TABLE science_tag1 DROP CONSTRAINT FK_915EC787BC66DF02');
        $this->addSql('DROP TABLE science');
        $this->addSql('DROP TABLE science_tag1');
        $this->addSql('DROP TABLE tag1');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
