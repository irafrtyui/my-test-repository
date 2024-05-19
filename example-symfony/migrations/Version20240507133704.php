<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507133704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('create table cart_product
(
    id         int auto_increment,
    cart_id    int not null,
    product_id int not null,
    qty        int not null,
    constraint cart_product_pk
        primary key (id),
    constraint cart_product___fk2
        foreign key (product_id) references product (id)
            on update cascade on delete cascade,
    constraint cart_product_fk1
        foreign key (cart_id) references cart (id)
            on update cascade on delete cascade
);
');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('drop table cart_product');

    }
}
