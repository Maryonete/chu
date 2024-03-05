<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305110913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Patient (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, adlibelle LONGTEXT NOT NULL, adcp VARCHAR(10) NOT NULL, adcity VARCHAR(100) NOT NULL, adcountry VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_D567EE77A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, medecin_id INT NOT NULL, stay_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_6EA9A1464F31A84 (medecin_id), UNIQUE INDEX UNIQ_6EA9A146FB3AF7D6 (stay_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drugs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_1BDA53C6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin_speciality (medecin_id INT NOT NULL, speciality_id INT NOT NULL, INDEX IDX_2B5B6D544F31A84 (medecin_id), INDEX IDX_2B5B6D543B5A08D7 (speciality_id), PRIMARY KEY(medecin_id, speciality_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medication (id INT AUTO_INCREMENT NOT NULL, drug_id INT NOT NULL, prescription_id INT NOT NULL, dosage VARCHAR(255) NOT NULL, INDEX IDX_5AEE5B70AABCA765 (drug_id), INDEX IDX_5AEE5B7093DB413D (prescription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinions (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, medecin_id INT NOT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_BEAF78D06B899279 (patient_id), INDEX IDX_BEAF78D04F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, medecin_id INT NOT NULL, patient_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_1FBFB8D94F31A84 (medecin_id), INDEX IDX_1FBFB8D96B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speciality (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stay (id INT AUTO_INCREMENT NOT NULL, speciality_id INT NOT NULL, patient_id INT NOT NULL, medecin_id INT NOT NULL, reason VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, validate TINYINT(1) NOT NULL, INDEX IDX_5E09839C3B5A08D7 (speciality_id), INDEX IDX_5E09839C6B899279 (patient_id), INDEX IDX_5E09839C4F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(60) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Patient ADD CONSTRAINT FK_D567EE77A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1464F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146FB3AF7D6 FOREIGN KEY (stay_id) REFERENCES stay (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE medecin_speciality ADD CONSTRAINT FK_2B5B6D544F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin_speciality ADD CONSTRAINT FK_2B5B6D543B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medication ADD CONSTRAINT FK_5AEE5B70AABCA765 FOREIGN KEY (drug_id) REFERENCES drugs (id)');
        $this->addSql('ALTER TABLE medication ADD CONSTRAINT FK_5AEE5B7093DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id)');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D06B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D04F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D94F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D96B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
        $this->addSql('ALTER TABLE stay ADD CONSTRAINT FK_5E09839C3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE stay ADD CONSTRAINT FK_5E09839C6B899279 FOREIGN KEY (patient_id) REFERENCES Patient (id)');
        $this->addSql('ALTER TABLE stay ADD CONSTRAINT FK_5E09839C4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Patient DROP FOREIGN KEY FK_D567EE77A76ED395');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1464F31A84');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146FB3AF7D6');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6A76ED395');
        $this->addSql('ALTER TABLE medecin_speciality DROP FOREIGN KEY FK_2B5B6D544F31A84');
        $this->addSql('ALTER TABLE medecin_speciality DROP FOREIGN KEY FK_2B5B6D543B5A08D7');
        $this->addSql('ALTER TABLE medication DROP FOREIGN KEY FK_5AEE5B70AABCA765');
        $this->addSql('ALTER TABLE medication DROP FOREIGN KEY FK_5AEE5B7093DB413D');
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D06B899279');
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D04F31A84');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D94F31A84');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D96B899279');
        $this->addSql('ALTER TABLE stay DROP FOREIGN KEY FK_5E09839C3B5A08D7');
        $this->addSql('ALTER TABLE stay DROP FOREIGN KEY FK_5E09839C6B899279');
        $this->addSql('ALTER TABLE stay DROP FOREIGN KEY FK_5E09839C4F31A84');
        $this->addSql('DROP TABLE Patient');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE drugs');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medecin_speciality');
        $this->addSql('DROP TABLE medication');
        $this->addSql('DROP TABLE opinions');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE stay');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
