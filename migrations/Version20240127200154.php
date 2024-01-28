<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127200154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, groupname_id INT NOT NULL, club_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, INDEX IDX_22B354295BA2A385 (groupname_id), INDEX IDX_22B3542961190A32 (club_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monitor (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, firstname VARCHAR(255) NOT NULL, INDEX IDX_E1159985C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, date_id INT NOT NULL, monitor_id INT NOT NULL, groupname_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D044D5D4B897366B (date_id), INDEX IDX_D044D5D44CE1C902 (monitor_id), INDEX IDX_D044D5D45BA2A385 (groupname_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_monitor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B354295BA2A385 FOREIGN KEY (groupname_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B3542961190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE monitor ADD CONSTRAINT FK_E1159985C54C8C93 FOREIGN KEY (type_id) REFERENCES type_monitor (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4B897366B FOREIGN KEY (date_id) REFERENCES date (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D44CE1C902 FOREIGN KEY (monitor_id) REFERENCES monitor (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D45BA2A385 FOREIGN KEY (groupname_id) REFERENCES `group` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B354295BA2A385');
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B3542961190A32');
        $this->addSql('ALTER TABLE monitor DROP FOREIGN KEY FK_E1159985C54C8C93');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4B897366B');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D44CE1C902');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D45BA2A385');
        $this->addSql('DROP TABLE child');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE date');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE monitor');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE type_monitor');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
