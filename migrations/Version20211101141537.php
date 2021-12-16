<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211101141537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livres (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, nom_livre VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, editeur VARCHAR(255) NOT NULL, parution VARCHAR(255) NOT NULL, code_bare VARCHAR(30) NOT NULL, format VARCHAR(50) NOT NULL, nbre_page INT NOT NULL, disponible TINYINT(1) NOT NULL, nbre_point INT DEFAULT NULL, INDEX IDX_927187A4BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livres ADD CONSTRAINT FK_927187A4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE livres');
    }
}
