<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241124203941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE expense_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE income_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE outcome_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payment_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE expense_type (id INT NOT NULL, description VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, created DATE NOT NULL, modified DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN expense_type.created IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN expense_type.modified IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE income (id INT NOT NULL, description VARCHAR(255) NOT NULL, value NUMERIC(7, 2) NOT NULL, created DATE NOT NULL, modified DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN income.created IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN income.modified IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE outcome (id INT NOT NULL, expense_type_id INT DEFAULT NULL, payment_type_id INT NOT NULL, description VARCHAR(255) NOT NULL, value NUMERIC(7, 2) NOT NULL, created DATE NOT NULL, modified DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_30BC6DC2A857C7A9 ON outcome (expense_type_id)');
        $this->addSql('CREATE INDEX IDX_30BC6DC2DC058279 ON outcome (payment_type_id)');
        $this->addSql('COMMENT ON COLUMN outcome.created IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN outcome.modified IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE payment_type (id INT NOT NULL, description VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, created DATE NOT NULL, modified DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN payment_type.created IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN payment_type.modified IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE outcome ADD CONSTRAINT FK_30BC6DC2A857C7A9 FOREIGN KEY (expense_type_id) REFERENCES expense_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE outcome ADD CONSTRAINT FK_30BC6DC2DC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE expense_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE income_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE outcome_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payment_type_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE outcome DROP CONSTRAINT FK_30BC6DC2A857C7A9');
        $this->addSql('ALTER TABLE outcome DROP CONSTRAINT FK_30BC6DC2DC058279');
        $this->addSql('DROP TABLE expense_type');
        $this->addSql('DROP TABLE income');
        $this->addSql('DROP TABLE outcome');
        $this->addSql('DROP TABLE payment_type');
    }
}
