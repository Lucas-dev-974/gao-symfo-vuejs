<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201224132002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assignements DROP FOREIGN KEY FK_B68E15FEA426D518');
        $this->addSql('ALTER TABLE assignements DROP FOREIGN KEY FK_B68E15FEAB014612');
        $this->addSql('DROP INDEX IDX_B68E15FEA426D518 ON assignements');
        $this->addSql('DROP INDEX IDX_B68E15FEAB014612 ON assignements');
        $this->addSql('ALTER TABLE assignements ADD id_client INT NOT NULL, ADD id_computer INT NOT NULL, DROP computer_id, DROP clients_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assignements ADD computer_id INT DEFAULT NULL, ADD clients_id INT DEFAULT NULL, DROP id_client, DROP id_computer');
        $this->addSql('ALTER TABLE assignements ADD CONSTRAINT FK_B68E15FEA426D518 FOREIGN KEY (computer_id) REFERENCES computers (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE assignements ADD CONSTRAINT FK_B68E15FEAB014612 FOREIGN KEY (clients_id) REFERENCES clients (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B68E15FEA426D518 ON assignements (computer_id)');
        $this->addSql('CREATE INDEX IDX_B68E15FEAB014612 ON assignements (clients_id)');
    }
}
