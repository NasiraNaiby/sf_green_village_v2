<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250721130815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, nom_client VARCHAR(255) NOT NULL, type_client VARCHAR(50) DEFAULT NULL, password VARCHAR(255) NOT NULL, email_client VARCHAR(255) NOT NULL, condition_paiment VARCHAR(255) DEFAULT NULL, address_facturation VARCHAR(255) DEFAULT NULL, address_livrasion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, id_clients_id INT DEFAULT NULL, id_commande INT NOT NULL, quantité INT DEFAULT NULL, unit_prix NUMERIC(10, 2) DEFAULT NULL, total_prix NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_35D4282CE8BC6C5 (id_clients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes_produits (commandes_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_D58023F08BF5C2E6 (commandes_id), INDEX IDX_D58023F0CD11A2CF (produits_id), PRIMARY KEY(commandes_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT DEFAULT NULL, id_facture INT NOT NULL, date_facture DATE NOT NULL, montant_total NUMERIC(10, 2) DEFAULT NULL, paiment_statut NUMERIC(10, 2) DEFAULT NULL, UNIQUE INDEX UNIQ_647590B9AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseurs (id INT AUTO_INCREMENT NOT NULL, id_fournisseur INT NOT NULL, nom_fournisseur VARCHAR(255) NOT NULL, email_fou VARCHAR(255) NOT NULL, phone_fou INT NOT NULL, produit_exclusif VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison_note (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT DEFAULT NULL, id_liv_note INT NOT NULL, statut_liv VARCHAR(255) DEFAULT NULL, date_liv DATE DEFAULT NULL, note_liv VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_644C99A59AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, nom_produit VARCHAR(255) NOT NULL, desc_produit VARCHAR(255) NOT NULL, achat_prix NUMERIC(10, 2) NOT NULL, vent_prix NUMERIC(10, 2) NOT NULL, categorie VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeurs (id INT AUTO_INCREMENT NOT NULL, id_clients_id INT DEFAULT NULL, id_vendeur INT NOT NULL, nom_vend VARCHAR(255) NOT NULL, email_vend VARCHAR(255) DEFAULT NULL, phone_vend INT DEFAULT NULL, id_client INT DEFAULT NULL, INDEX IDX_2180DE3E8BC6C5 (id_clients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CE8BC6C5 FOREIGN KEY (id_clients_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE commandes_produits ADD CONSTRAINT FK_D58023F08BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes_produits ADD CONSTRAINT FK_D58023F0CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590B9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE livraison_note ADD CONSTRAINT FK_644C99A59AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE vendeurs ADD CONSTRAINT FK_2180DE3E8BC6C5 FOREIGN KEY (id_clients_id) REFERENCES clients (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CE8BC6C5');
        $this->addSql('ALTER TABLE commandes_produits DROP FOREIGN KEY FK_D58023F08BF5C2E6');
        $this->addSql('ALTER TABLE commandes_produits DROP FOREIGN KEY FK_D58023F0CD11A2CF');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590B9AF8E3A3');
        $this->addSql('ALTER TABLE livraison_note DROP FOREIGN KEY FK_644C99A59AF8E3A3');
        $this->addSql('ALTER TABLE vendeurs DROP FOREIGN KEY FK_2180DE3E8BC6C5');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE commandes_produits');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE fournisseurs');
        $this->addSql('DROP TABLE livraison_note');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE vendeurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
