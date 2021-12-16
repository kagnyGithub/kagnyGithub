<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211101151425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commander (id INT AUTO_INCREMENT NOT NULL, user_commander_id INT DEFAULT NULL, livre_cmmande_id INT DEFAULT NULL, INDEX IDX_42D318BAB385D981 (user_commander_id), INDEX IDX_42D318BAEF41CB5F (livre_cmmande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT FK_42D318BAB385D981 FOREIGN KEY (user_commander_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT FK_42D318BAEF41CB5F FOREIGN KEY (livre_cmmande_id) REFERENCES livres (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commander');
    }
}
