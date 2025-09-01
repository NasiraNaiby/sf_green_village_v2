<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250901124020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_wishlist (user_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_7C6CCE31A76ED395 (user_id), INDEX IDX_7C6CCE31CD11A2CF (produits_id), PRIMARY KEY(user_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_wishlist ADD CONSTRAINT FK_7C6CCE31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_wishlist ADD CONSTRAINT FK_7C6CCE31CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits DROP achat_prix');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_identifier_email TO UNIQ_8D93D649E7927C74');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_wishlist DROP FOREIGN KEY FK_7C6CCE31A76ED395');
        $this->addSql('ALTER TABLE user_wishlist DROP FOREIGN KEY FK_7C6CCE31CD11A2CF');
        $this->addSql('DROP TABLE user_wishlist');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649e7927c74 TO UNIQ_IDENTIFIER_EMAIL');
        $this->addSql('ALTER TABLE produits ADD achat_prix NUMERIC(10, 2) NOT NULL');
    }
}
