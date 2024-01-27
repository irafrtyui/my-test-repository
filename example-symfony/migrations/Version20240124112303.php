<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124112303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('alter table posts
    add comments_id int null;

    alter table posts
    add constraint posts_comments_id_fk
    foreign key (id) references comments (id)
    on update cascade on delete cascade');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('alter table posts drop column comments_id');
    }
}
