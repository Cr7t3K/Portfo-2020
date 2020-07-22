<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200722114318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_skill (page_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_38BC1BA1C4663E4 (page_id), INDEX IDX_38BC1BA15585C142 (skill_id), PRIMARY KEY(page_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, domain VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, github VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, concept LONGTEXT DEFAULT NULL, stats LONGTEXT DEFAULT NULL, number VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_project (skill_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_35464EC75585C142 (skill_id), INDEX IDX_35464EC7166D1F9C (project_id), PRIMARY KEY(skill_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, linkedin VARCHAR(255) DEFAULT NULL, github VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_project (team_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_D0CAA1D9296CD8AE (team_id), INDEX IDX_D0CAA1D9166D1F9C (project_id), PRIMARY KEY(team_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_skill ADD CONSTRAINT FK_38BC1BA1C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_skill ADD CONSTRAINT FK_38BC1BA15585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_project ADD CONSTRAINT FK_35464EC75585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_project ADD CONSTRAINT FK_35464EC7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_project ADD CONSTRAINT FK_D0CAA1D9296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_project ADD CONSTRAINT FK_D0CAA1D9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_skill DROP FOREIGN KEY FK_38BC1BA1C4663E4');
        $this->addSql('ALTER TABLE skill_project DROP FOREIGN KEY FK_35464EC7166D1F9C');
        $this->addSql('ALTER TABLE team_project DROP FOREIGN KEY FK_D0CAA1D9166D1F9C');
        $this->addSql('ALTER TABLE page_skill DROP FOREIGN KEY FK_38BC1BA15585C142');
        $this->addSql('ALTER TABLE skill_project DROP FOREIGN KEY FK_35464EC75585C142');
        $this->addSql('ALTER TABLE team_project DROP FOREIGN KEY FK_D0CAA1D9296CD8AE');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_skill');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_project');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_project');
    }
}
