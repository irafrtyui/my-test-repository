<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124104526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('create table comments
    (
    id   int auto_increment,
    name varchar(100) not null,
    date date         not null,
    constraint comments_pk
        primary key (id)
)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table comments');

    }
}
