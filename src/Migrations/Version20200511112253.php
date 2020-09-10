<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200511112253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE share_file (id INT AUTO_INCREMENT NOT NULL, membre_dest_id INT DEFAULT NULL, membre_up_id INT NOT NULL, cursus_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, date_upload DATETIME NOT NULL, intitule VARCHAR(255) NOT NULL, taille_file DOUBLE PRECISION NOT NULL, actif INT NOT NULL, INDEX IDX_31583B89CBA49A2A (membre_dest_id), INDEX IDX_31583B89B3092B9D (membre_up_id), INDEX IDX_31583B8940AEF4B9 (cursus_id), INDEX IDX_31583B898F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE share_file ADD CONSTRAINT FK_31583B89CBA49A2A FOREIGN KEY (membre_dest_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE share_file ADD CONSTRAINT FK_31583B89B3092B9D FOREIGN KEY (membre_up_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE share_file ADD CONSTRAINT FK_31583B8940AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
        $this->addSql('ALTER TABLE share_file ADD CONSTRAINT FK_31583B898F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE share_file');
    }
}
