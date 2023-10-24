<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024193304 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // password: amateri_password
        $this->addSql("INSERT INTO \"user\" (id, username, roles, password)
            VALUES (1, 'amateri.user', '[\"ROLE_LOGGED_USER\"]', '$2y$10\$qBO4UpqVB3GOJKdowEApJOhh9QxSqTF7NU8KTQBNlbPo93IJPtuL6')");
        // password: test_password
        $this->addSql("INSERT INTO \"user\" (id, username, roles, password)
            VALUES (2, 'test.user', '[\"ROLE_LOGGED_USER\"]', '$2y$10\$oa1M4bUNdUpFwQojC1v1v.dBNnzJsQBjYaASmuhaqSTjq60sbaC/u')");
        // password: vendor_password
        $this->addSql("INSERT INTO \"user\" (id, username, roles, password)
            VALUES (3, 'vendor.user', '[\"ROLE_VENDOR_USER\"]', '$2y$10\$AI8g2zqgXRZo7sLsXKy4DuC5Axdn/rwD2VFG.kZT4MfHTB1sA.aGG')");
    }
}
