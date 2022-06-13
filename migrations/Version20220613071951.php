<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220613071951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_client DROP FOREIGN KEY FK_C510FF8082EA2E54');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, INDEX IDX_24CC0DF2ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2ED5CA9E6 FOREIGN KEY (service_id) REFERENCES commande (id)');
        $this->addSql('DROP TABLE commande_client');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_client (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, nomclient VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, relation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C510FF8082EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_client ADD CONSTRAINT FK_C510FF8082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande_client (id)');
        $this->addSql('DROP TABLE panier');
    }
}
