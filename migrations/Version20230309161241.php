<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309161241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE desserts_menus (menu_id INT NOT NULL, dessert_id INT NOT NULL, INDEX IDX_368C4305CCD7E912 (menu_id), INDEX IDX_368C4305745B52FD (dessert_id), PRIMARY KEY(menu_id, dessert_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE desserts_menus ADD CONSTRAINT FK_368C4305CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE desserts_menus ADD CONSTRAINT FK_368C4305745B52FD FOREIGN KEY (dessert_id) REFERENCES dessert (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE desserts_menus DROP FOREIGN KEY FK_368C4305CCD7E912');
        $this->addSql('ALTER TABLE desserts_menus DROP FOREIGN KEY FK_368C4305745B52FD');
        $this->addSql('DROP TABLE desserts_menus');
    }
}
