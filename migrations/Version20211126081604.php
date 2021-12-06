<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211126081604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD num_immo INT NOT NULL, ADD type_garantie VARCHAR(255) DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL, ADD piece_jointe VARCHAR(255) DEFAULT NULL, ADD caracteristique LONGTEXT DEFAULT NULL, ADD pack TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP num_immo, DROP type_garantie, DROP commentaire, DROP piece_jointe, DROP caracteristique, DROP pack');
    }
}
