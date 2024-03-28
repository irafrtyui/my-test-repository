<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327194231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
        ALTER TABLE user 
        ADD COLUMN non_login_cnt INT UNSIGNED NOT NULL DEFAULT 0,
        ADD COLUMN non_login_at DATETIME
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
        ALTER TABLE user 
        DROP COLUMN non_login_cnt,
        DROP COLUMN non_login_at
        ');

    }
}
