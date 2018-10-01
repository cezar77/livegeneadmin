<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181001125659 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE staff_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, person_id INTEGER NOT NULL, percent INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_B55FFCE5166D1F9C ON staff_role (project_id)');
        $this->addSql('CREATE INDEX IDX_B55FFCE5217BBB47 ON staff_role (person_id)');
        $this->addSql('CREATE TABLE partnership (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partner_id INTEGER NOT NULL, contact_id INTEGER DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_8619D6AE166D1F9C ON partnership (project_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AE9393F8FE ON partnership (partner_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AEE7A1254A ON partnership (contact_id)');
        $this->addSql('CREATE TABLE country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country VARCHAR(2) NOT NULL)');
        $this->addSql('CREATE TABLE partnership_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(30) NOT NULL)');
        $this->addSql('CREATE TABLE country_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, country_id INTEGER NOT NULL, percent INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D05A018E166D1F9C ON country_role (project_id)');
        $this->addSql('CREATE INDEX IDX_D05A018EF92F3E70 ON country_role (country_id)');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, principal_investigator_id INTEGER NOT NULL, ilri_code VARCHAR(20) NOT NULL, full_name VARCHAR(200) NOT NULL, short_name VARCHAR(50) NOT NULL, projects_group VARCHAR(20) NOT NULL, donor_reference VARCHAR(50) DEFAULT NULL, donor_project_name VARCHAR(200) DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status INTEGER NOT NULL, capacity_development INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE5BD1A144 ON project (principal_investigator_id)');
        $this->addSql('CREATE TABLE sdgrole (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, sdg_id INTEGER NOT NULL, percent INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF166D1F9C ON sdgrole (project_id)');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF6F37DCD9 ON sdgrole (sdg_id)');
        $this->addSql('CREATE TABLE sampling_activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partnership_id INTEGER NOT NULL, description VARCHAR(200) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_49213369166D1F9C ON sampling_activity (project_id)');
        $this->addSql('CREATE INDEX IDX_492133696AE7F85 ON sampling_activity (partnership_id)');
        $this->addSql('CREATE TABLE expenditure (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ilri_code VARCHAR(20) NOT NULL, name VARCHAR(200) NOT NULL, home_program VARCHAR(20) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, report_date DATETIME NOT NULL, total_budget INTEGER DEFAULT NULL, amount INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE sampling_documentation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sampling_activity_id INTEGER NOT NULL, document_type_id INTEGER NOT NULL, document VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_43BC985A994540B8 ON sampling_documentation (sampling_activity_id)');
        $this->addSql('CREATE INDEX IDX_43BC985A61232A4F ON sampling_documentation (document_type_id)');
        $this->addSql('CREATE TABLE organisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, short_name VARCHAR(20) DEFAULT NULL, full_name VARCHAR(200) NOT NULL, logo_url VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E6E132B4F92F3E70 ON organisation (country_id)');
        $this->addSql('CREATE TABLE sampling_document_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, short_name VARCHAR(20) NOT NULL, long_name VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE sdg (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, headline VARCHAR(50) NOT NULL, full_name VARCHAR(200) NOT NULL, color VARCHAR(7) NOT NULL, link VARCHAR(255) NOT NULL, logo_url VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE staff (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(15) NOT NULL, first_name VARCHAR(30) NOT NULL, last_name VARCHAR(50) NOT NULL, home_program VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(20) DEFAULT NULL, first_name VARCHAR(30) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(100) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE staff_role');
        $this->addSql('DROP TABLE partnership');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE partnership_type');
        $this->addSql('DROP TABLE country_role');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE sdgrole');
        $this->addSql('DROP TABLE sampling_activity');
        $this->addSql('DROP TABLE expenditure');
        $this->addSql('DROP TABLE sampling_documentation');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('DROP TABLE sampling_document_type');
        $this->addSql('DROP TABLE sdg');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE contact');
    }
}
