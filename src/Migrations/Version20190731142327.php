<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190731142327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code_bank INT NOT NULL, num_comp VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, bic VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, id_compte_id INT NOT NULL, reg_com VARCHAR(255) NOT NULL, ninea DOUBLE PRECISION NOT NULL, localisation VARCHAR(255) NOT NULL, domaine VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32FFA373C678AEBE (ninea), UNIQUE INDEX UNIQ_32FFA37372F0DA07 (id_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, id_partenaire_id INT NOT NULL, id_compte_id INT NOT NULL, datedepot DATE NOT NULL, montant_depot DOUBLE PRECISION NOT NULL, INDEX IDX_47948BBC26F6C2C9 (id_partenaire_id), INDEX IDX_47948BBC72F0DA07 (id_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, id_parte_id INT DEFAULT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel DOUBLE PRECISION NOT NULL, profil VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3AA08CB10 (login), INDEX IDX_1D1C63B36B2814EB (id_parte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA37372F0DA07 FOREIGN KEY (id_compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC26F6C2C9 FOREIGN KEY (id_partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC72F0DA07 FOREIGN KEY (id_compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B36B2814EB FOREIGN KEY (id_parte_id) REFERENCES partenaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA37372F0DA07');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBC72F0DA07');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBC26F6C2C9');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B36B2814EB');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE utilisateur');
    }
}
