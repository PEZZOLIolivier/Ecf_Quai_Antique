<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309155812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_starter (menu_id INT NOT NULL, starter_id INT NOT NULL, INDEX IDX_C8993E35CCD7E912 (menu_id), INDEX IDX_C8993E35AD5A66CC (starter_id), PRIMARY KEY(menu_id, starter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_starter ADD CONSTRAINT FK_C8993E35CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_starter ADD CONSTRAINT FK_C8993E35AD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_photo DROP FOREIGN KEY FK_851BA77FCCD7E912');
        $this->addSql('ALTER TABLE menu_photo DROP FOREIGN KEY FK_851BA77F7E9E4C8C');
        $this->addSql('DROP TABLE menu_photo');
        $this->addSql('ALTER TABLE menu ADD photo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A937E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE INDEX IDX_7D053A937E9E4C8C ON menu (photo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_photo (menu_id INT NOT NULL, photo_id INT NOT NULL, INDEX IDX_851BA77F7E9E4C8C (photo_id), INDEX IDX_851BA77FCCD7E912 (menu_id), PRIMARY KEY(menu_id, photo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_photo ADD CONSTRAINT FK_851BA77FCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_photo ADD CONSTRAINT FK_851BA77F7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_starter DROP FOREIGN KEY FK_C8993E35CCD7E912');
        $this->addSql('ALTER TABLE menu_starter DROP FOREIGN KEY FK_C8993E35AD5A66CC');
        $this->addSql('DROP TABLE menu_starter');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A937E9E4C8C');
        $this->addSql('DROP INDEX IDX_7D053A937E9E4C8C ON menu');
        $this->addSql('ALTER TABLE menu DROP photo_id');
    }
}
