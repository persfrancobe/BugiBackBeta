<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109144535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE block (id INT AUTO_INCREMENT NOT NULL, template_id INT DEFAULT NULL, page_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, creat_at DATETIME NOT NULL, update_at DATETIME NOT NULL, visible TINYINT(1) NOT NULL, ordby INT NOT NULL, UNIQUE INDEX UNIQ_831B97225DA0FB8 (template_id), INDEX IDX_831B9722C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(55) NOT NULL, creat_at DATETIME NOT NULL, update_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, template_id INT DEFAULT NULL, father_page_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, ordby INT NOT NULL, visible TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, creat_at DATETIME NOT NULL, update_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_140AB6205DA0FB8 (template_id), INDEX IDX_140AB6204F2D0AE2 (father_page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, template LONGTEXT NOT NULL, creat_at DATETIME NOT NULL, update_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE txt_content (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, block_id INT DEFAULT NULL, page_id INT DEFAULT NULL, content LONGTEXT NOT NULL, creat_at DATETIME NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_8202C99582F1BAF4 (language_id), INDEX IDX_8202C995E9ED820C (block_id), INDEX IDX_8202C995C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE block ADD CONSTRAINT FK_831B97225DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('ALTER TABLE block ADD CONSTRAINT FK_831B9722C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6205DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6204F2D0AE2 FOREIGN KEY (father_page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE txt_content ADD CONSTRAINT FK_8202C99582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE txt_content ADD CONSTRAINT FK_8202C995E9ED820C FOREIGN KEY (block_id) REFERENCES block (id)');
        $this->addSql('ALTER TABLE txt_content ADD CONSTRAINT FK_8202C995C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE txt_content DROP FOREIGN KEY FK_8202C995E9ED820C');
        $this->addSql('ALTER TABLE txt_content DROP FOREIGN KEY FK_8202C99582F1BAF4');
        $this->addSql('ALTER TABLE block DROP FOREIGN KEY FK_831B9722C4663E4');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6204F2D0AE2');
        $this->addSql('ALTER TABLE txt_content DROP FOREIGN KEY FK_8202C995C4663E4');
        $this->addSql('ALTER TABLE block DROP FOREIGN KEY FK_831B97225DA0FB8');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6205DA0FB8');
        $this->addSql('DROP TABLE block');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE txt_content');
        $this->addSql('DROP TABLE user');
    }
}
