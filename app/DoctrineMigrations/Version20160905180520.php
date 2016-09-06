<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160905180520 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tb_source ADD id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE cx cx INT NOT NULL, CHANGE rx rx INT NOT NULL, CHANGE title title CHAR(100) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE tb_rel ADD id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE cx cx INT NOT NULL, CHANGE ndc ndc CHAR(20) NOT NULL, ADD PRIMARY KEY (id)');

        $this->addSql('CREATE INDEX idx_cx ON tb_rel (cx)');
        $this->addSql('CREATE INDEX idx_ndc ON tb_rel (ndc)');

        $this->addSql('CREATE INDEX idx_cx ON tb_source (cx)');
        $this->addSql('CREATE INDEX idx_rx ON tb_source (rx)');
        $this->addSql('CREATE INDEX idx_title ON tb_source (title)');

        $this->addSql('CREATE TABLE `tb_source_rel`( `source_id` INT(11) UNSIGNED NOT NULL, `rel_id` INT(11) UNSIGNED NOT NULL, PRIMARY KEY (`source_id`, `rel_id`) ) ENGINE=INNODB CHARSET=utf8');
        $this->addSql('INSERT INTO `tb_source_rel` (source_id, rel_id) SELECT s.id, r.id FROM `tb_source` s JOIN `tb_rel` r USING (cx)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE `tb_source_rel`');

        $this->addSql('DROP INDEX idx_cx ON tb_rel');
        $this->addSql('DROP INDEX idx_ndc ON tb_rel');

        $this->addSql('DROP INDEX idx_cx ON tb_source');
        $this->addSql('DROP INDEX idx_rx ON tb_source');
        $this->addSql('DROP INDEX idx_title ON tb_source');

        $this->addSql('ALTER TABLE `tb_rel` DROP COLUMN `id`, DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE `tb_source` DROP COLUMN `id`, DROP PRIMARY KEY');

        $this->addSql('ALTER TABLE tb_source CHANGE cx cx VARCHAR(10) DEFAULT NULL COLLATE utf8_general_ci, CHANGE rx rx VARCHAR(10) DEFAULT NULL COLLATE utf8_general_ci, CHANGE title title VARCHAR(100) DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE tb_rel CHANGE cx cx VARCHAR(10) DEFAULT NULL COLLATE utf8_general_ci, CHANGE ndc ndc VARCHAR(20) DEFAULT NULL COLLATE utf8_general_ci');
    }
}
