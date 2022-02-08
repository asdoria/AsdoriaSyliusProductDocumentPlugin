<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505141327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create asdoria_product_document';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE asdoria_product_document (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_70B7F41E4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asdoria_product_document ADD CONSTRAINT FK_70B7F41E4584665A FOREIGN KEY (product_id) REFERENCES sylius_product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE asdoria_product_document');
    }
}
