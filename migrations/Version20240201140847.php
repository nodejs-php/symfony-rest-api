<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201140847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ability_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pokemon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ability (id INT NOT NULL, name VARCHAR(50) NOT NULL, lang VARCHAR(10) NOT NULL, image VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pokemon (id INT NOT NULL, ability_id INT DEFAULT NULL, name VARCHAR(20) NOT NULL, image VARCHAR(30) DEFAULT NULL, sort INT DEFAULT NULL, shape INT NOT NULL, location VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62DC90F38016D8B2 ON pokemon (ability_id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F38016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ability_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pokemon_id_seq CASCADE');
        $this->addSql('ALTER TABLE pokemon DROP CONSTRAINT FK_62DC90F38016D8B2');
        $this->addSql('DROP TABLE ability');
        $this->addSql('DROP TABLE pokemon');
    }
}
