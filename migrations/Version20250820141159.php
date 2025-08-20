<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250820141159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP id_client');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CE8BC6C5');
        $this->addSql('DROP INDEX IDX_35D4282CE8BC6C5 ON commandes');
        $this->addSql('ALTER TABLE commandes ADD client_id INT NOT NULL, DROP id_clients_id');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C19EB6921 ON commandes (client_id)');
        $this->addSql('ALTER TABLE vendeurs DROP FOREIGN KEY FK_2180DE3E8BC6C5');
        $this->addSql('DROP INDEX IDX_2180DE3E8BC6C5 ON vendeurs');
        $this->addSql('ALTER TABLE vendeurs ADD client_id INT NOT NULL, DROP id_clients_id, DROP id_client');
        $this->addSql('ALTER TABLE vendeurs ADD CONSTRAINT FK_2180DE319EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_2180DE319EB6921 ON vendeurs (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C19EB6921');
        $this->addSql('DROP INDEX IDX_35D4282C19EB6921 ON commandes');
        $this->addSql('ALTER TABLE commandes ADD id_clients_id INT DEFAULT NULL, DROP client_id');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CE8BC6C5 FOREIGN KEY (id_clients_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_35D4282CE8BC6C5 ON commandes (id_clients_id)');
        $this->addSql('ALTER TABLE clients ADD id_client INT NOT NULL');
        $this->addSql('ALTER TABLE vendeurs DROP FOREIGN KEY FK_2180DE319EB6921');
        $this->addSql('DROP INDEX IDX_2180DE319EB6921 ON vendeurs');
        $this->addSql('ALTER TABLE vendeurs ADD id_clients_id INT DEFAULT NULL, ADD id_client INT DEFAULT NULL, DROP client_id');
        $this->addSql('ALTER TABLE vendeurs ADD CONSTRAINT FK_2180DE3E8BC6C5 FOREIGN KEY (id_clients_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_2180DE3E8BC6C5 ON vendeurs (id_clients_id)');
    }
}
