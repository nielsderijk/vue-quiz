<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * @package Application\Migrations
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class Version20160905084119 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE guests (uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, consent_terms TINYINT(1) NOT NULL, over_eighteen TINYINT(1) NOT NULL, receive_updates TINYINT(1) NOT NULL, zip_code VARCHAR(255) DEFAULT NULL, status SMALLINT NOT NULL, phase SMALLINT NOT NULL, station SMALLINT DEFAULT NULL, artwork_data LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, vr_one_assign DATETIME DEFAULT NULL, vr_one_start DATETIME DEFAULT NULL, vr_one_finish DATETIME DEFAULT NULL, vr_two_assign DATETIME DEFAULT NULL, vr_two_start DATETIME DEFAULT NULL, vr_two_finish DATETIME DEFAULT NULL, INDEX status_index (status), INDEX phase_index (phase), INDEX station_index (station), INDEX created_at_index (created_at), INDEX updated_at_index (updated_at), INDEX vr_one_assign_index (vr_one_assign), INDEX vr_one_start_index (vr_one_start), INDEX vr_two_assign_index (vr_two_assign), INDEX vr_two_start_index (vr_two_start), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE guests');
    }
}
