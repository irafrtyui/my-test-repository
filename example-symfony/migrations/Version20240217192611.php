<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240217192611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('create table mail
(
    id      int auto_increment,
    email   varchar(100) not null,
    name    varchar(100) not null,
    message text         not null,
    constraint mail_pk
        primary key (id)
);
');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table mail');

    }
}
