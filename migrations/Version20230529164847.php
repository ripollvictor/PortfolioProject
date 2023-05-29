<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529164847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allocation (id CHAR(36) CHARACTER SET ascii NOT NULL, portfolio_id CHAR(36) CHARACTER SET ascii NOT NULL, shares INT NOT NULL, INDEX IDX_5C44232AB96B5643 (portfolio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio (id CHAR(36) CHARACTER SET ascii NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allocation ADD CONSTRAINT FK_5C44232AB96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allocation DROP FOREIGN KEY FK_5C44232AB96B5643');
        $this->addSql('DROP TABLE allocation');
        $this->addSql('DROP TABLE portfolio');
    }
}
