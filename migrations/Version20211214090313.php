<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214090313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, tabs_id INT NOT NULL, designation VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, reference INT NOT NULL, id_tabs INT NOT NULL, prix_ttc DOUBLE PRECISION DEFAULT NULL, quantite INT NOT NULL, garantie TINYINT(1) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, num_immo INT NOT NULL, type_garantie VARCHAR(255) DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, piece_jointe VARCHAR(255) DEFAULT NULL, caracteristique LONGTEXT DEFAULT NULL, pack TINYINT(1) DEFAULT NULL, INDEX IDX_29A5EC27459BC0C4 (tabs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tabs (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, id_user_create VARCHAR(255) DEFAULT NULL, type_tabs VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taches (id INT AUTO_INCREMENT NOT NULL, nom_tache VARCHAR(255) NOT NULL, avancement_tache VARCHAR(255) NOT NULL, description_tache LONGTEXT NOT NULL, limite_date_tache DATE DEFAULT NULL, attribution_tache VARCHAR(255) DEFAULT NULL, id_tabs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27459BC0C4 FOREIGN KEY (tabs_id) REFERENCES tabs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27459BC0C4');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE tabs');
        $this->addSql('DROP TABLE taches');
        $this->addSql('DROP TABLE user');
    }
}
