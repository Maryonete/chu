<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219083000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Patient (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, adlibelle LONGTEXT NOT NULL, adcp VARCHAR(10) NOT NULL, adcity VARCHAR(100) NOT NULL, adcountry VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_D567EE77A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Patient ADD CONSTRAINT FK_D567EE77A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Patient DROP FOREIGN KEY FK_D567EE77A76ED395');
        $this->addSql('DROP TABLE Patient');
    }
}
