<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211216085649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE porduit (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27459BC0C4');
        $this->addSql('DROP INDEX IDX_29A5EC27459BC0C4 ON produit');
        $this->addSql('ALTER TABLE produit DROP tabs_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE porduit');
        $this->addSql('ALTER TABLE produit ADD tabs_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27459BC0C4 FOREIGN KEY (tabs_id) REFERENCES tabs (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27459BC0C4 ON produit (tabs_id)');
    }
}
