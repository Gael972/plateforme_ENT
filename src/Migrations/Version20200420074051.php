<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420074051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, type_id INT NOT NULL, domaine_id INT NOT NULL, intitule VARCHAR(255) NOT NULL, date_d DATETIME NOT NULL, date_f DATETIME DEFAULT NULL, photos VARCHAR(255) DEFAULT NULL, evaluation INT NOT NULL, INDEX IDX_B66FFE926A99F74A (membre_id), INDEX IDX_B66FFE92C54C8C93 (type_id), INDEX IDX_B66FFE924272FC9F (domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE926A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE924272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cv');
    }
}
