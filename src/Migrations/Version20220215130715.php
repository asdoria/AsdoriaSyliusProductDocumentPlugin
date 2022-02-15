<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220215130715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create asdoria document type tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        if($schema->hasTable('asdoria_document_type')) return;
        $this->addSql('CREATE TABLE asdoria_document_type (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, position INT NOT NULL, UNIQUE INDEX UNIQ_B43A629D77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_document_type_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_7A45D8FA2C2AC5D3 (translatable_id), UNIQUE INDEX UNIQ_7A45D8FA4180C6985E237E06 (locale, name), UNIQUE INDEX asdoria_document_type_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asdoria_product_document (id INT AUTO_INCREMENT NOT NULL, document_type_id INT NOT NULL, product_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_70B7F41E61232A4F (document_type_id), INDEX IDX_70B7F41E4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asdoria_document_type_translation ADD CONSTRAINT FK_7A45D8FA2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES asdoria_document_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asdoria_product_document ADD CONSTRAINT FK_70B7F41E61232A4F FOREIGN KEY (document_type_id) REFERENCES asdoria_document_type (id)');
        $this->addSql('ALTER TABLE asdoria_product_document ADD CONSTRAINT FK_70B7F41E4584665A FOREIGN KEY (product_id) REFERENCES sylius_product (id) ON DELETE CASCADE');

    }

    public function down(Schema $schema): void
    {
        if(!$schema->hasTable('asdoria_document_type')) return;
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asdoria_document_type_translation DROP FOREIGN KEY FK_7A45D8FA2C2AC5D3');
        $this->addSql('ALTER TABLE asdoria_product_document DROP FOREIGN KEY FK_70B7F41E61232A4F');
        $this->addSql('DROP TABLE asdoria_document_type');
        $this->addSql('DROP TABLE asdoria_document_type_translation');
        $this->addSql('DROP TABLE asdoria_product_document');

    }
}
