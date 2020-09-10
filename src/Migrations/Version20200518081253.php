<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518081253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE note_matiere (id INT AUTO_INCREMENT NOT NULL, formateur_id INT NOT NULL, classe_id INT DEFAULT NULL, nom_matiere VARCHAR(255) NOT NULL, INDEX IDX_11B293D0155D8F51 (formateur_id), INDEX IDX_11B293D08F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_matiere ADD CONSTRAINT FK_11B293D0155D8F51 FOREIGN KEY (formateur_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE note_matiere ADD CONSTRAINT FK_11B293D08F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE note_matiere');
    }
}
