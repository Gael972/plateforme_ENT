<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518082700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE note_devoir (id INT AUTO_INCREMENT NOT NULL, matiere_id INT NOT NULL, type_devoir_id INT DEFAULT NULL, classe_id INT NOT NULL, date DATETIME NOT NULL, nom VARCHAR(255) NOT NULL, coefficient INT NOT NULL, INDEX IDX_6C4CF0A5F46CD258 (matiere_id), INDEX IDX_6C4CF0A57145125E (type_devoir_id), INDEX IDX_6C4CF0A58F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_devoir ADD CONSTRAINT FK_6C4CF0A5F46CD258 FOREIGN KEY (matiere_id) REFERENCES note_matiere (id)');
        $this->addSql('ALTER TABLE note_devoir ADD CONSTRAINT FK_6C4CF0A57145125E FOREIGN KEY (type_devoir_id) REFERENCES note_type_devoir (id)');
        $this->addSql('ALTER TABLE note_devoir ADD CONSTRAINT FK_6C4CF0A58F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE note_devoir');
    }
}
