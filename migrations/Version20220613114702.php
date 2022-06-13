<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613114702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, INDEX IDX_6EEAA67D9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_prestations (commande_id INT NOT NULL, prestations_id INT NOT NULL, INDEX IDX_FAC95DB082EA2E54 (commande_id), INDEX IDX_FAC95DB08BE96D0D (prestations_id), PRIMARY KEY(commande_id, prestations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestations (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande_prestations ADD CONSTRAINT FK_FAC95DB082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_prestations ADD CONSTRAINT FK_FAC95DB08BE96D0D FOREIGN KEY (prestations_id) REFERENCES prestations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_prestations DROP FOREIGN KEY FK_FAC95DB082EA2E54');
        $this->addSql('ALTER TABLE commande_prestations DROP FOREIGN KEY FK_FAC95DB08BE96D0D');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_prestations');
        $this->addSql('DROP TABLE prestations');
    }
}
