<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219092725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stay (id INT AUTO_INCREMENT NOT NULL, speciality_id INT NOT NULL, patient_id INT NOT NULL, medecin_id INT NOT NULL, reason VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, validate TINYINT(1) NOT NULL, INDEX IDX_5E09839C3B5A08D7 (speciality_id), INDEX IDX_5E09839C6B899279 (patient_id), INDEX IDX_5E09839C4F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stay ADD CONSTRAINT FK_5E09839C3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE stay ADD CONSTRAINT FK_5E09839C6B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
        $this->addSql('ALTER TABLE stay ADD CONSTRAINT FK_5E09839C4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stay DROP FOREIGN KEY FK_5E09839C3B5A08D7');
        $this->addSql('ALTER TABLE stay DROP FOREIGN KEY FK_5E09839C6B899279');
        $this->addSql('ALTER TABLE stay DROP FOREIGN KEY FK_5E09839C4F31A84');
        $this->addSql('DROP TABLE stay');
    }
}
