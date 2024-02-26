<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226102509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opinions (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, medecin_id INT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', description LONGTEXT NOT NULL, INDEX IDX_BEAF78D06B899279 (patient_id), INDEX IDX_BEAF78D04F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D06B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D04F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D06B899279');
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D04F31A84');
        $this->addSql('DROP TABLE opinions');
    }
}
