<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529173852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id CHAR(36) CHARACTER SET ascii NOT NULL, portfolio_id VARCHAR(36) NOT NULL, allocation_id VARCHAR(36) NOT NULL, type VARCHAR(12) NOT NULL, shares INT NOT NULL, completed TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allocation CHANGE id id CHAR(36) CHARACTER SET ascii NOT NULL, CHANGE portfolio_id portfolio_id CHAR(36) CHARACTER SET ascii NOT NULL');
        $this->addSql('ALTER TABLE portfolio CHANGE id id CHAR(36) CHARACTER SET ascii NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `order`');
        $this->addSql('ALTER TABLE allocation CHANGE id id CHAR(36) CHARACTER SET ascii NOT NULL COLLATE `ascii_general_ci`, CHANGE portfolio_id portfolio_id CHAR(36) CHARACTER SET ascii NOT NULL COLLATE `ascii_general_ci`');
        $this->addSql('ALTER TABLE portfolio CHANGE id id CHAR(36) CHARACTER SET ascii NOT NULL COLLATE `ascii_general_ci`');
    }
}
