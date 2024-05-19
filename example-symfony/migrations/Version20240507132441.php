<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507132441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('create table cart
(
    id         int auto_increment,
    name       varchar(255)  not null,
    email      varchar(100)  not null,
    price      int default 0 not null,
    created_at datetime      not null,
    constraint cart_pk
        primary key (id)
);
');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table cart');

    }
}
