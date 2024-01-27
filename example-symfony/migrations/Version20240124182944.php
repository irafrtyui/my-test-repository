<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124182944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('alter table comments
        add post_id int null;

        alter table comments
        add constraint comments_posts_id_fk
        foreign key (post_id) references posts (id)');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('alter table comments drop column post_id');

    }
}
