<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922145453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialog DROP FOREIGN KEY FK_4561D8621221E019');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1221E019');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D1221E019');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, age INT NOT NULL, job VARCHAR(255) DEFAULT NULL, body VARCHAR(255) DEFAULT NULL, mind LONGTEXT DEFAULT NULL, story LONGTEXT DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, color VARCHAR(255) NOT NULL, INDEX IDX_937AB034A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_role_play (character_id INT NOT NULL, role_play_id INT NOT NULL, INDEX IDX_67660E151136BE75 (character_id), INDEX IDX_67660E15999AC846 (role_play_id), PRIMARY KEY(character_id, role_play_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE character_role_play ADD CONSTRAINT FK_67660E151136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE character_role_play ADD CONSTRAINT FK_67660E15999AC846 FOREIGN KEY (role_play_id) REFERENCES role_play (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE perso DROP FOREIGN KEY FK_BD62FA21A76ED395');
        $this->addSql('ALTER TABLE perso_role_play DROP FOREIGN KEY FK_DD81A57F1221E019');
        $this->addSql('ALTER TABLE perso_role_play DROP FOREIGN KEY FK_DD81A57F999AC846');
        $this->addSql('DROP TABLE perso');
        $this->addSql('DROP TABLE perso_role_play');
        $this->addSql('DROP INDEX IDX_4561D8621221E019 ON dialog');
        $this->addSql('ALTER TABLE dialog CHANGE perso_id character_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dialog ADD CONSTRAINT FK_4561D8621136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4561D8621136BE75 ON dialog (character_id)');
        $this->addSql('DROP INDEX IDX_B6BD307F1221E019 ON message');
        $this->addSql('ALTER TABLE message DROP perso_id');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D1221E019');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D1221E019 FOREIGN KEY (perso_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE script ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP email, DROP is_verified');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dialog DROP FOREIGN KEY FK_4561D8621136BE75');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D1221E019');
        $this->addSql('CREATE TABLE perso (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, age INT DEFAULT NULL, job VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, body LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, mind LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, story LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, avatar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BD62FA21A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE perso_role_play (perso_id INT NOT NULL, role_play_id INT NOT NULL, INDEX IDX_DD81A57F999AC846 (role_play_id), INDEX IDX_DD81A57F1221E019 (perso_id), PRIMARY KEY(perso_id, role_play_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE perso ADD CONSTRAINT FK_BD62FA21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE perso_role_play ADD CONSTRAINT FK_DD81A57F1221E019 FOREIGN KEY (perso_id) REFERENCES perso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE perso_role_play ADD CONSTRAINT FK_DD81A57F999AC846 FOREIGN KEY (role_play_id) REFERENCES role_play (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A76ED395');
        $this->addSql('ALTER TABLE character_role_play DROP FOREIGN KEY FK_67660E151136BE75');
        $this->addSql('ALTER TABLE character_role_play DROP FOREIGN KEY FK_67660E15999AC846');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_role_play');
        $this->addSql('DROP INDEX UNIQ_4561D8621136BE75 ON dialog');
        $this->addSql('ALTER TABLE dialog CHANGE character_id perso_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dialog ADD CONSTRAINT FK_4561D8621221E019 FOREIGN KEY (perso_id) REFERENCES perso (id)');
        $this->addSql('CREATE INDEX IDX_4561D8621221E019 ON dialog (perso_id)');
        $this->addSql('ALTER TABLE message ADD perso_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1221E019 FOREIGN KEY (perso_id) REFERENCES perso (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F1221E019 ON message (perso_id)');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D1221E019');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D1221E019 FOREIGN KEY (perso_id) REFERENCES perso (id)');
        $this->addSql('ALTER TABLE script DROP description');
        $this->addSql('ALTER TABLE `user` ADD email VARCHAR(255) NOT NULL, ADD is_verified TINYINT(1) NOT NULL');
    }
}
