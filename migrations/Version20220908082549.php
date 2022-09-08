<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908082549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_role_play (character_id INT NOT NULL, role_play_id INT NOT NULL, INDEX IDX_67660E151136BE75 (character_id), INDEX IDX_67660E15999AC846 (role_play_id), PRIMARY KEY(character_id, role_play_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE character_role_play ADD CONSTRAINT FK_67660E151136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_role_play ADD CONSTRAINT FK_67660E15999AC846 FOREIGN KEY (role_play_id) REFERENCES role_play (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dialog ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE dialog ADD CONSTRAINT FK_4561D8624B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_4561D8624B89032C ON dialog (post_id)');
        $this->addSql('ALTER TABLE post ADD perso_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D1221E019 FOREIGN KEY (perso_id) REFERENCES `character` (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D1221E019 ON post (perso_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE character_role_play DROP FOREIGN KEY FK_67660E151136BE75');
        $this->addSql('ALTER TABLE character_role_play DROP FOREIGN KEY FK_67660E15999AC846');
        $this->addSql('DROP TABLE character_role_play');
        $this->addSql('ALTER TABLE dialog DROP FOREIGN KEY FK_4561D8624B89032C');
        $this->addSql('DROP INDEX IDX_4561D8624B89032C ON dialog');
        $this->addSql('ALTER TABLE dialog DROP post_id');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D1221E019');
        $this->addSql('DROP INDEX IDX_5A8A6C8D1221E019 ON post');
        $this->addSql('ALTER TABLE post DROP perso_id');
    }
}
