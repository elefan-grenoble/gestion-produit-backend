<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190811195955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE SUPPLYING (id INT AUTO_INCREMENT NOT NULL, article_code BIGINT DEFAULT NULL, quantity INT DEFAULT NULL, creation_date DATE NOT NULL, supply_date DATE DEFAULT NULL, out_of_stock TINYINT(1) DEFAULT NULL, INDEX IDX_4D448068C757B799 (article_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE SUPPLYING ADD CONSTRAINT FK_4D448068C757B799 FOREIGN KEY (article_code) REFERENCES ARTICLE (code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE SUPPLYING');
    }
}
