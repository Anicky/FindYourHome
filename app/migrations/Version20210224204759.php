<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224204759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estate (id INT AUTO_INCREMENT NOT NULL, estate_type_id INT NOT NULL, title VARCHAR(255) NOT NULL, publication_date DATETIME NOT NULL, price INT NOT NULL, surface_area INT NOT NULL, location VARCHAR(255) NOT NULL, number_of_pieces INT NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_8C4A1AAC559D2834 (estate_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estate_agency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estate_agency_estate (estate_agency_id INT NOT NULL, estate_id INT NOT NULL, INDEX IDX_B2D7A5E0FD170624 (estate_agency_id), INDEX IDX_B2D7A5E0900733ED (estate_id), PRIMARY KEY(estate_agency_id, estate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estate_listing_site (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estate_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estate ADD CONSTRAINT FK_8C4A1AAC559D2834 FOREIGN KEY (estate_type_id) REFERENCES estate_type (id)');
        $this->addSql('ALTER TABLE estate_agency_estate ADD CONSTRAINT FK_B2D7A5E0FD170624 FOREIGN KEY (estate_agency_id) REFERENCES estate_agency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estate_agency_estate ADD CONSTRAINT FK_B2D7A5E0900733ED FOREIGN KEY (estate_id) REFERENCES estate (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE estate_agency_estate DROP FOREIGN KEY FK_B2D7A5E0900733ED');
        $this->addSql('ALTER TABLE estate_agency_estate DROP FOREIGN KEY FK_B2D7A5E0FD170624');
        $this->addSql('ALTER TABLE estate DROP FOREIGN KEY FK_8C4A1AAC559D2834');
        $this->addSql('DROP TABLE estate');
        $this->addSql('DROP TABLE estate_agency');
        $this->addSql('DROP TABLE estate_agency_estate');
        $this->addSql('DROP TABLE estate_listing_site');
        $this->addSql('DROP TABLE estate_type');
    }
}
