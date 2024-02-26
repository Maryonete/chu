<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226095238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, medecin_id INT NOT NULL, patient_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_1FBFB8D94F31A84 (medecin_id), INDEX IDX_1FBFB8D96B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription_drugs (prescription_id INT NOT NULL, drugs_id INT NOT NULL, INDEX IDX_17F961F593DB413D (prescription_id), INDEX IDX_17F961F5DA039455 (drugs_id), PRIMARY KEY(prescription_id, drugs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D94F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D96B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
        $this->addSql('ALTER TABLE prescription_drugs ADD CONSTRAINT FK_17F961F593DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescription_drugs ADD CONSTRAINT FK_17F961F5DA039455 FOREIGN KEY (drugs_id) REFERENCES drugs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE drugs ADD dosage VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D94F31A84');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D96B899279');
        $this->addSql('ALTER TABLE prescription_drugs DROP FOREIGN KEY FK_17F961F593DB413D');
        $this->addSql('ALTER TABLE prescription_drugs DROP FOREIGN KEY FK_17F961F5DA039455');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE prescription_drugs');
        $this->addSql('ALTER TABLE drugs DROP dosage');
    }
}
