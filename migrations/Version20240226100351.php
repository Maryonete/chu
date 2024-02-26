<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226100351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medication (id INT AUTO_INCREMENT NOT NULL, dosage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medication_drugs (medication_id INT NOT NULL, drugs_id INT NOT NULL, INDEX IDX_437EBB302C4DE6DA (medication_id), INDEX IDX_437EBB30DA039455 (drugs_id), PRIMARY KEY(medication_id, drugs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medication_prescription (medication_id INT NOT NULL, prescription_id INT NOT NULL, INDEX IDX_698CC6D62C4DE6DA (medication_id), INDEX IDX_698CC6D693DB413D (prescription_id), PRIMARY KEY(medication_id, prescription_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medication_drugs ADD CONSTRAINT FK_437EBB302C4DE6DA FOREIGN KEY (medication_id) REFERENCES medication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medication_drugs ADD CONSTRAINT FK_437EBB30DA039455 FOREIGN KEY (drugs_id) REFERENCES drugs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medication_prescription ADD CONSTRAINT FK_698CC6D62C4DE6DA FOREIGN KEY (medication_id) REFERENCES medication (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medication_prescription ADD CONSTRAINT FK_698CC6D693DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescription_drugs DROP FOREIGN KEY FK_17F961F593DB413D');
        $this->addSql('ALTER TABLE prescription_drugs DROP FOREIGN KEY FK_17F961F5DA039455');
        $this->addSql('DROP TABLE prescription_drugs');
        $this->addSql('ALTER TABLE drugs DROP dosage');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prescription_drugs (prescription_id INT NOT NULL, drugs_id INT NOT NULL, INDEX IDX_17F961F593DB413D (prescription_id), INDEX IDX_17F961F5DA039455 (drugs_id), PRIMARY KEY(prescription_id, drugs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prescription_drugs ADD CONSTRAINT FK_17F961F593DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescription_drugs ADD CONSTRAINT FK_17F961F5DA039455 FOREIGN KEY (drugs_id) REFERENCES drugs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medication_drugs DROP FOREIGN KEY FK_437EBB302C4DE6DA');
        $this->addSql('ALTER TABLE medication_drugs DROP FOREIGN KEY FK_437EBB30DA039455');
        $this->addSql('ALTER TABLE medication_prescription DROP FOREIGN KEY FK_698CC6D62C4DE6DA');
        $this->addSql('ALTER TABLE medication_prescription DROP FOREIGN KEY FK_698CC6D693DB413D');
        $this->addSql('DROP TABLE medication');
        $this->addSql('DROP TABLE medication_drugs');
        $this->addSql('DROP TABLE medication_prescription');
        $this->addSql('ALTER TABLE drugs ADD dosage VARCHAR(255) NOT NULL');
    }
}
