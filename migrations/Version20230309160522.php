<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309160522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE starters_menus (menu_id INT NOT NULL, starter_id INT NOT NULL, INDEX IDX_BB6DCABCCCD7E912 (menu_id), INDEX IDX_BB6DCABCAD5A66CC (starter_id), PRIMARY KEY(menu_id, starter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dishes_menus (menu_id INT NOT NULL, dish_id INT NOT NULL, INDEX IDX_8DD9051BCCD7E912 (menu_id), INDEX IDX_8DD9051B148EB0CB (dish_id), PRIMARY KEY(menu_id, dish_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE starters_menus ADD CONSTRAINT FK_BB6DCABCCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE starters_menus ADD CONSTRAINT FK_BB6DCABCAD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_menus ADD CONSTRAINT FK_8DD9051BCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_menus ADD CONSTRAINT FK_8DD9051B148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_starter DROP FOREIGN KEY FK_C8993E35AD5A66CC');
        $this->addSql('ALTER TABLE menu_starter DROP FOREIGN KEY FK_C8993E35CCD7E912');
        $this->addSql('ALTER TABLE menu_dish DROP FOREIGN KEY FK_5D327CF6CCD7E912');
        $this->addSql('ALTER TABLE menu_dish DROP FOREIGN KEY FK_5D327CF6148EB0CB');
        $this->addSql('DROP TABLE menu_starter');
        $this->addSql('DROP TABLE menu_dish');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_starter (menu_id INT NOT NULL, starter_id INT NOT NULL, INDEX IDX_C8993E35CCD7E912 (menu_id), INDEX IDX_C8993E35AD5A66CC (starter_id), PRIMARY KEY(menu_id, starter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu_dish (menu_id INT NOT NULL, dish_id INT NOT NULL, INDEX IDX_5D327CF6148EB0CB (dish_id), INDEX IDX_5D327CF6CCD7E912 (menu_id), PRIMARY KEY(menu_id, dish_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_starter ADD CONSTRAINT FK_C8993E35AD5A66CC FOREIGN KEY (starter_id) REFERENCES starter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_starter ADD CONSTRAINT FK_C8993E35CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_dish ADD CONSTRAINT FK_5D327CF6CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_dish ADD CONSTRAINT FK_5D327CF6148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE starters_menus DROP FOREIGN KEY FK_BB6DCABCCCD7E912');
        $this->addSql('ALTER TABLE starters_menus DROP FOREIGN KEY FK_BB6DCABCAD5A66CC');
        $this->addSql('ALTER TABLE dishes_menus DROP FOREIGN KEY FK_8DD9051BCCD7E912');
        $this->addSql('ALTER TABLE dishes_menus DROP FOREIGN KEY FK_8DD9051B148EB0CB');
        $this->addSql('DROP TABLE starters_menus');
        $this->addSql('DROP TABLE dishes_menus');
    }
}
