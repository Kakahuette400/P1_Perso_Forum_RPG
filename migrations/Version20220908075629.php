<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908075629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialog DROP FOREIGN KEY FK_4561D862EAB5DEB');
        $this->addSql('DROP INDEX IDX_4561D862EAB5DEB ON dialog');
        $this->addSql('ALTER TABLE dialog ADD post_id INT NOT NULL, DROP many_to_one_id');
        $this->addSql('ALTER TABLE dialog ADD CONSTRAINT FK_4561D8624B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_4561D8624B89032C ON dialog (post_id)');
        $this->addSql('ALTER TABLE message CHANGE post_id post_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialog DROP FOREIGN KEY FK_4561D8624B89032C');
        $this->addSql('DROP INDEX IDX_4561D8624B89032C ON dialog');
        $this->addSql('ALTER TABLE dialog ADD many_to_one_id INT DEFAULT NULL, DROP post_id');
        $this->addSql('ALTER TABLE dialog ADD CONSTRAINT FK_4561D862EAB5DEB FOREIGN KEY (many_to_one_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_4561D862EAB5DEB ON dialog (many_to_one_id)');
        $this->addSql('ALTER TABLE message CHANGE post_id post_id INT DEFAULT NULL');
    }
}
