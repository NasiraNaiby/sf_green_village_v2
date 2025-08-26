<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250826095848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD condition_paiement VARCHAR(255) DEFAULT NULL, ADD adresse_facturation VARCHAR(255) DEFAULT NULL, ADD adresse_livraison VARCHAR(255) NOT NULL, ADD code_postal_livraison VARCHAR(255) NOT NULL, DROP condition_paiment, DROP address_facturation, DROP address_livrasion, DROP livrasion_cp, CHANGE client_cp code_postal_facturation VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD prix_unitaire NUMERIC(10, 2) DEFAULT NULL, ADD prix_total NUMERIC(10, 2) DEFAULT NULL, DROP id_commande, DROP unit_prix, DROP total_prix, CHANGE quantité quantite INT DEFAULT NULL');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590B9AF8E3A3');
        $this->addSql('DROP INDEX UNIQ_647590B9AF8E3A3 ON factures');
        $this->addSql('ALTER TABLE factures DROP id_commande_id, CHANGE id_facture commande_id INT NOT NULL, CHANGE paiment_statut statut_paiement NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_647590B82EA2E54 ON factures (commande_id)');
        $this->addSql('ALTER TABLE livraison_note DROP FOREIGN KEY FK_644C99A59AF8E3A3');
        $this->addSql('DROP INDEX UNIQ_644C99A59AF8E3A3 ON livraison_note');
        $this->addSql('ALTER TABLE livraison_note DROP id_commande_id, CHANGE id_liv_note commande_id INT NOT NULL, CHANGE statut_liv statut_livraison VARCHAR(255) DEFAULT NULL, CHANGE date_liv date_livraison DATE DEFAULT NULL, CHANGE note_liv note_livraison VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livraison_note ADD CONSTRAINT FK_644C99A582EA2E54 FOREIGN KEY (commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_644C99A582EA2E54 ON livraison_note (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes ADD id_commande INT NOT NULL, ADD unit_prix NUMERIC(10, 2) DEFAULT NULL, ADD total_prix NUMERIC(10, 2) DEFAULT NULL, DROP prix_unitaire, DROP prix_total, CHANGE quantite quantité INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clients ADD condition_paiment VARCHAR(255) DEFAULT NULL, ADD address_facturation VARCHAR(255) DEFAULT NULL, ADD address_livrasion VARCHAR(255) NOT NULL, ADD livrasion_cp VARCHAR(255) NOT NULL, DROP condition_paiement, DROP adresse_facturation, DROP adresse_livraison, DROP code_postal_livraison, CHANGE code_postal_facturation client_cp VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE livraison_note DROP FOREIGN KEY FK_644C99A582EA2E54');
        $this->addSql('DROP INDEX UNIQ_644C99A582EA2E54 ON livraison_note');
        $this->addSql('ALTER TABLE livraison_note ADD id_commande_id INT DEFAULT NULL, CHANGE commande_id id_liv_note INT NOT NULL, CHANGE statut_livraison statut_liv VARCHAR(255) DEFAULT NULL, CHANGE date_livraison date_liv DATE DEFAULT NULL, CHANGE note_livraison note_liv VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livraison_note ADD CONSTRAINT FK_644C99A59AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_644C99A59AF8E3A3 ON livraison_note (id_commande_id)');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590B82EA2E54');
        $this->addSql('DROP INDEX UNIQ_647590B82EA2E54 ON factures');
        $this->addSql('ALTER TABLE factures ADD id_commande_id INT DEFAULT NULL, CHANGE commande_id id_facture INT NOT NULL, CHANGE statut_paiement paiment_statut NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590B9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_647590B9AF8E3A3 ON factures (id_commande_id)');
    }
}
