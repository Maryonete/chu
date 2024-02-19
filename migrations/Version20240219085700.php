<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219085700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_1BDA53C6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin_speciality (medecin_id INT NOT NULL, speciality_id INT NOT NULL, INDEX IDX_2B5B6D544F31A84 (medecin_id), INDEX IDX_2B5B6D543B5A08D7 (speciality_id), PRIMARY KEY(medecin_id, speciality_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE medecin_speciality ADD CONSTRAINT FK_2B5B6D544F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin_speciality ADD CONSTRAINT FK_2B5B6D543B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6A76ED395');
        $this->addSql('ALTER TABLE medecin_speciality DROP FOREIGN KEY FK_2B5B6D544F31A84');
        $this->addSql('ALTER TABLE medecin_speciality DROP FOREIGN KEY FK_2B5B6D543B5A08D7');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medecin_speciality');
    }
}
