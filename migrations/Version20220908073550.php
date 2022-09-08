<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908073550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE act (id INT AUTO_INCREMENT NOT NULL, script_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_AFECF544A1C01850 (script_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, age INT NOT NULL, job VARCHAR(255) DEFAULT NULL, body VARCHAR(255) DEFAULT NULL, mind LONGTEXT DEFAULT NULL, story LONGTEXT DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dialog (id INT AUTO_INCREMENT NOT NULL, many_to_one_id INT DEFAULT NULL, character_id INT DEFAULT NULL, text LONGTEXT NOT NULL, pnj TINYINT(1) NOT NULL, INDEX IDX_4561D862EAB5DEB (many_to_one_id), UNIQUE INDEX UNIQ_4561D8621136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_B6BD307F4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, rp_id INT NOT NULL, INDEX IDX_5A8A6C8DB70FF80C (rp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_play (id INT AUTO_INCREMENT NOT NULL, act_id INT NOT NULL, title VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL, location VARCHAR(255) NOT NULL, summarize LONGTEXT DEFAULT NULL, status TINYINT(1) NOT NULL, INDEX IDX_E036AC2ED1A55B28 (act_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE script (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE act ADD CONSTRAINT FK_AFECF544A1C01850 FOREIGN KEY (script_id) REFERENCES script (id)');
        $this->addSql('ALTER TABLE dialog ADD CONSTRAINT FK_4561D862EAB5DEB FOREIGN KEY (many_to_one_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE dialog ADD CONSTRAINT FK_4561D8621136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DB70FF80C FOREIGN KEY (rp_id) REFERENCES role_play (id)');
        $this->addSql('ALTER TABLE role_play ADD CONSTRAINT FK_E036AC2ED1A55B28 FOREIGN KEY (act_id) REFERENCES act (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE act DROP FOREIGN KEY FK_AFECF544A1C01850');
        $this->addSql('ALTER TABLE dialog DROP FOREIGN KEY FK_4561D862EAB5DEB');
        $this->addSql('ALTER TABLE dialog DROP FOREIGN KEY FK_4561D8621136BE75');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4B89032C');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DB70FF80C');
        $this->addSql('ALTER TABLE role_play DROP FOREIGN KEY FK_E036AC2ED1A55B28');
        $this->addSql('DROP TABLE act');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE dialog');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE role_play');
        $this->addSql('DROP TABLE script');
        $this->addSql('DROP TABLE `user`');
    }
}
