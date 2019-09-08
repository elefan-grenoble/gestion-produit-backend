<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190908200101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Adds the MissingBarcode entity';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE MISSING_BARCODE (id INT AUTO_INCREMENT NOT NULL, article_id BIGINT NOT NULL, date DATETIME NOT NULL, barcode BIGINT NOT NULL, INDEX IDX_DF686DBB7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MISSING_BARCODE ADD CONSTRAINT FK_DF686DBB7294869C FOREIGN KEY (article_id) REFERENCES ARTICLE (code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE MISSING_BARCODE');
    }
}
