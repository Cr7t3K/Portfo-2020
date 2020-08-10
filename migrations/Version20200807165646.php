<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200807165646 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD sentence1 VARCHAR(255) DEFAULT NULL, ADD sentence2 VARCHAR(255) DEFAULT NULL, ADD sentence3 VARCHAR(255) DEFAULT NULL, ADD sentence4 VARCHAR(255) DEFAULT NULL, CHANGE title main_sentence VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page DROP sentence1, DROP sentence2, DROP sentence3, DROP sentence4, CHANGE main_sentence title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
