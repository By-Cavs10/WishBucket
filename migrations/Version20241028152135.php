<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241028152135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wish_category (wish_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_167D52BE42B83698 (wish_id), INDEX IDX_167D52BE12469DE2 (category_id), PRIMARY KEY(wish_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wish_category ADD CONSTRAINT FK_167D52BE42B83698 FOREIGN KEY (wish_id) REFERENCES wish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wish_category ADD CONSTRAINT FK_167D52BE12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C142B83698');
        $this->addSql('DROP INDEX IDX_64C19C142B83698 ON category');
        $this->addSql('ALTER TABLE category DROP wish_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wish_category DROP FOREIGN KEY FK_167D52BE42B83698');
        $this->addSql('ALTER TABLE wish_category DROP FOREIGN KEY FK_167D52BE12469DE2');
        $this->addSql('DROP TABLE wish_category');
        $this->addSql('ALTER TABLE category ADD wish_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C142B83698 FOREIGN KEY (wish_id) REFERENCES wish (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_64C19C142B83698 ON category (wish_id)');
    }
}
