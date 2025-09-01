<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250901125128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients_favoris (clients_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_B758643DAB014612 (clients_id), INDEX IDX_B758643DCD11A2CF (produits_id), PRIMARY KEY(clients_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients_favoris ADD CONSTRAINT FK_B758643DAB014612 FOREIGN KEY (clients_id) REFERENCES clients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clients_favoris ADD CONSTRAINT FK_B758643DCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clients DROP type_client, DROP code_postal_facturation, DROP condition_paiement, DROP adresse_facturation, DROP adresse_livraison, DROP code_postal_livraison, DROP client_email, DROP client_phone');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients_favoris DROP FOREIGN KEY FK_B758643DAB014612');
        $this->addSql('ALTER TABLE clients_favoris DROP FOREIGN KEY FK_B758643DCD11A2CF');
        $this->addSql('DROP TABLE clients_favoris');
        $this->addSql('ALTER TABLE clients ADD type_client VARCHAR(50) DEFAULT NULL, ADD code_postal_facturation VARCHAR(10) NOT NULL, ADD condition_paiement VARCHAR(255) DEFAULT NULL, ADD adresse_facturation VARCHAR(255) DEFAULT NULL, ADD adresse_livraison VARCHAR(255) NOT NULL, ADD code_postal_livraison VARCHAR(255) NOT NULL, ADD client_email VARCHAR(255) DEFAULT NULL, ADD client_phone VARCHAR(255) DEFAULT NULL');
    }
}
