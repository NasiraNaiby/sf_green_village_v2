<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250901130004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD type_client VARCHAR(50) DEFAULT NULL, ADD condition_paiement VARCHAR(255) DEFAULT NULL, ADD adresse_facturation VARCHAR(255) DEFAULT NULL, ADD adresse_livraison VARCHAR(255) NOT NULL, ADD code_postal_facturation VARCHAR(10) NOT NULL, ADD code_postal_livraison VARCHAR(255) NOT NULL, ADD client_email VARCHAR(255) DEFAULT NULL, ADD client_phone VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP type_client, DROP condition_paiement, DROP adresse_facturation, DROP adresse_livraison, DROP code_postal_facturation, DROP code_postal_livraison, DROP client_email, DROP client_phone');
    }
}
