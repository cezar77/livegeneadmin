<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181002061459 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_B55FFCE5217BBB47');
        $this->addSql('DROP INDEX IDX_B55FFCE5166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__staff_role AS SELECT id, project_id, person_id, percent FROM staff_role');
        $this->addSql('DROP TABLE staff_role');
        $this->addSql('CREATE TABLE staff_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, person_id INTEGER NOT NULL, percent INTEGER NOT NULL, CONSTRAINT FK_B55FFCE5166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B55FFCE5217BBB47 FOREIGN KEY (person_id) REFERENCES staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO staff_role (id, project_id, person_id, percent) SELECT id, project_id, person_id, percent FROM __temp__staff_role');
        $this->addSql('DROP TABLE __temp__staff_role');
        $this->addSql('CREATE INDEX IDX_B55FFCE5217BBB47 ON staff_role (person_id)');
        $this->addSql('CREATE INDEX IDX_B55FFCE5166D1F9C ON staff_role (project_id)');
        $this->addSql('DROP INDEX IDX_8619D6AEE7A1254A');
        $this->addSql('DROP INDEX IDX_8619D6AE9393F8FE');
        $this->addSql('DROP INDEX IDX_8619D6AE166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partnership AS SELECT id, project_id, partner_id, contact_id, start_date, end_date FROM partnership');
        $this->addSql('DROP TABLE partnership');
        $this->addSql('CREATE TABLE partnership (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partner_id INTEGER NOT NULL, contact_id INTEGER DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, CONSTRAINT FK_8619D6AE166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8619D6AE9393F8FE FOREIGN KEY (partner_id) REFERENCES organisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8619D6AEE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO partnership (id, project_id, partner_id, contact_id, start_date, end_date) SELECT id, project_id, partner_id, contact_id, start_date, end_date FROM __temp__partnership');
        $this->addSql('DROP TABLE __temp__partnership');
        $this->addSql('CREATE INDEX IDX_8619D6AEE7A1254A ON partnership (contact_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AE9393F8FE ON partnership (partner_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AE166D1F9C ON partnership (project_id)');
        $this->addSql('DROP INDEX IDX_D05A018EF92F3E70');
        $this->addSql('DROP INDEX IDX_D05A018E166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__country_role AS SELECT id, project_id, country_id, percent FROM country_role');
        $this->addSql('DROP TABLE country_role');
        $this->addSql('CREATE TABLE country_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, country_id INTEGER NOT NULL, percent INTEGER NOT NULL, CONSTRAINT FK_D05A018E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D05A018EF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO country_role (id, project_id, country_id, percent) SELECT id, project_id, country_id, percent FROM __temp__country_role');
        $this->addSql('DROP TABLE __temp__country_role');
        $this->addSql('CREATE INDEX IDX_D05A018EF92F3E70 ON country_role (country_id)');
        $this->addSql('CREATE INDEX IDX_D05A018E166D1F9C ON country_role (project_id)');
        $this->addSql('DROP INDEX IDX_2FB3D0EE5BD1A144');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project AS SELECT id, principal_investigator_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, start_date, end_date, status, capacity_development FROM project');
        $this->addSql('DROP TABLE project');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, principal_investigator_id INTEGER NOT NULL, ilri_code VARCHAR(20) NOT NULL COLLATE BINARY, full_name VARCHAR(200) NOT NULL COLLATE BINARY, short_name VARCHAR(50) NOT NULL COLLATE BINARY, projects_group VARCHAR(20) NOT NULL COLLATE BINARY, donor_reference VARCHAR(50) DEFAULT NULL COLLATE BINARY, donor_project_name VARCHAR(200) DEFAULT NULL COLLATE BINARY, start_date DATE NOT NULL, end_date DATE NOT NULL, status INTEGER NOT NULL, capacity_development INTEGER NOT NULL, CONSTRAINT FK_2FB3D0EE5BD1A144 FOREIGN KEY (principal_investigator_id) REFERENCES staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO project (id, principal_investigator_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, start_date, end_date, status, capacity_development) SELECT id, principal_investigator_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, start_date, end_date, status, capacity_development FROM __temp__project');
        $this->addSql('DROP TABLE __temp__project');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE5BD1A144 ON project (principal_investigator_id)');
        $this->addSql('DROP INDEX IDX_8EB6A6AF6F37DCD9');
        $this->addSql('DROP INDEX IDX_8EB6A6AF166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sdgrole AS SELECT id, project_id, sdg_id, percent FROM sdgrole');
        $this->addSql('DROP TABLE sdgrole');
        $this->addSql('CREATE TABLE sdgrole (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, sdg_id INTEGER NOT NULL, percent INTEGER NOT NULL, CONSTRAINT FK_8EB6A6AF166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8EB6A6AF6F37DCD9 FOREIGN KEY (sdg_id) REFERENCES sdg (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sdgrole (id, project_id, sdg_id, percent) SELECT id, project_id, sdg_id, percent FROM __temp__sdgrole');
        $this->addSql('DROP TABLE __temp__sdgrole');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF6F37DCD9 ON sdgrole (sdg_id)');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF166D1F9C ON sdgrole (project_id)');
        $this->addSql('DROP INDEX IDX_492133696AE7F85');
        $this->addSql('DROP INDEX IDX_49213369166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_activity AS SELECT id, project_id, partnership_id, description, start_date, end_date FROM sampling_activity');
        $this->addSql('DROP TABLE sampling_activity');
        $this->addSql('CREATE TABLE sampling_activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partnership_id INTEGER NOT NULL, description VARCHAR(200) NOT NULL COLLATE BINARY, start_date DATE NOT NULL, end_date DATE NOT NULL, CONSTRAINT FK_49213369166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_492133696AE7F85 FOREIGN KEY (partnership_id) REFERENCES partnership (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sampling_activity (id, project_id, partnership_id, description, start_date, end_date) SELECT id, project_id, partnership_id, description, start_date, end_date FROM __temp__sampling_activity');
        $this->addSql('DROP TABLE __temp__sampling_activity');
        $this->addSql('CREATE INDEX IDX_492133696AE7F85 ON sampling_activity (partnership_id)');
        $this->addSql('CREATE INDEX IDX_49213369166D1F9C ON sampling_activity (project_id)');
        $this->addSql('DROP INDEX IDX_43BC985A61232A4F');
        $this->addSql('DROP INDEX IDX_43BC985A994540B8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_documentation AS SELECT id, sampling_activity_id, document_type_id, document FROM sampling_documentation');
        $this->addSql('DROP TABLE sampling_documentation');
        $this->addSql('CREATE TABLE sampling_documentation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sampling_activity_id INTEGER NOT NULL, document_type_id INTEGER NOT NULL, document VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_43BC985A994540B8 FOREIGN KEY (sampling_activity_id) REFERENCES sampling_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_43BC985A61232A4F FOREIGN KEY (document_type_id) REFERENCES sampling_document_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sampling_documentation (id, sampling_activity_id, document_type_id, document) SELECT id, sampling_activity_id, document_type_id, document FROM __temp__sampling_documentation');
        $this->addSql('DROP TABLE __temp__sampling_documentation');
        $this->addSql('CREATE INDEX IDX_43BC985A61232A4F ON sampling_documentation (document_type_id)');
        $this->addSql('CREATE INDEX IDX_43BC985A994540B8 ON sampling_documentation (sampling_activity_id)');
        $this->addSql('DROP INDEX IDX_E6E132B4F92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__organisation AS SELECT id, country_id, short_name, full_name, logo_url FROM organisation');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('CREATE TABLE organisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, short_name VARCHAR(20) DEFAULT NULL COLLATE BINARY, full_name VARCHAR(200) NOT NULL COLLATE BINARY, logo_url VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_E6E132B4F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO organisation (id, country_id, short_name, full_name, logo_url) SELECT id, country_id, short_name, full_name, logo_url FROM __temp__organisation');
        $this->addSql('DROP TABLE __temp__organisation');
        $this->addSql('CREATE INDEX IDX_E6E132B4F92F3E70 ON organisation (country_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sdg AS SELECT id, headline, full_name, color, link, logo_url FROM sdg');
        $this->addSql('DROP TABLE sdg');
        $this->addSql('CREATE TABLE sdg (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, headline VARCHAR(50) NOT NULL COLLATE BINARY, full_name VARCHAR(200) NOT NULL COLLATE BINARY, color VARCHAR(7) NOT NULL COLLATE BINARY, link VARCHAR(255) NOT NULL COLLATE BINARY, logo_url VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO sdg (id, headline, full_name, color, link, logo_url) SELECT id, headline, full_name, color, link, logo_url FROM __temp__sdg');
        $this->addSql('DROP TABLE __temp__sdg');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BB15543E0E861BD ON sdg (headline)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BB15543DBC463C4 ON sdg (full_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BB15543665648E9 ON sdg (color)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BB1554336AC99F1 ON sdg (link)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BB155439520AA7 ON sdg (logo_url)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D05A018E166D1F9C');
        $this->addSql('DROP INDEX IDX_D05A018EF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__country_role AS SELECT id, project_id, country_id, percent FROM country_role');
        $this->addSql('DROP TABLE country_role');
        $this->addSql('CREATE TABLE country_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, country_id INTEGER NOT NULL, percent INTEGER NOT NULL)');
        $this->addSql('INSERT INTO country_role (id, project_id, country_id, percent) SELECT id, project_id, country_id, percent FROM __temp__country_role');
        $this->addSql('DROP TABLE __temp__country_role');
        $this->addSql('CREATE INDEX IDX_D05A018E166D1F9C ON country_role (project_id)');
        $this->addSql('CREATE INDEX IDX_D05A018EF92F3E70 ON country_role (country_id)');
        $this->addSql('DROP INDEX IDX_E6E132B4F92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__organisation AS SELECT id, country_id, short_name, full_name, logo_url FROM organisation');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('CREATE TABLE organisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, short_name VARCHAR(20) DEFAULT NULL, full_name VARCHAR(200) NOT NULL, logo_url VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO organisation (id, country_id, short_name, full_name, logo_url) SELECT id, country_id, short_name, full_name, logo_url FROM __temp__organisation');
        $this->addSql('DROP TABLE __temp__organisation');
        $this->addSql('CREATE INDEX IDX_E6E132B4F92F3E70 ON organisation (country_id)');
        $this->addSql('DROP INDEX IDX_8619D6AE166D1F9C');
        $this->addSql('DROP INDEX IDX_8619D6AE9393F8FE');
        $this->addSql('DROP INDEX IDX_8619D6AEE7A1254A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partnership AS SELECT id, project_id, partner_id, contact_id, start_date, end_date FROM partnership');
        $this->addSql('DROP TABLE partnership');
        $this->addSql('CREATE TABLE partnership (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partner_id INTEGER NOT NULL, contact_id INTEGER DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL)');
        $this->addSql('INSERT INTO partnership (id, project_id, partner_id, contact_id, start_date, end_date) SELECT id, project_id, partner_id, contact_id, start_date, end_date FROM __temp__partnership');
        $this->addSql('DROP TABLE __temp__partnership');
        $this->addSql('CREATE INDEX IDX_8619D6AE166D1F9C ON partnership (project_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AE9393F8FE ON partnership (partner_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AEE7A1254A ON partnership (contact_id)');
        $this->addSql('DROP INDEX IDX_2FB3D0EE5BD1A144');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project AS SELECT id, principal_investigator_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, start_date, end_date, status, capacity_development FROM project');
        $this->addSql('DROP TABLE project');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, principal_investigator_id INTEGER NOT NULL, ilri_code VARCHAR(20) NOT NULL, full_name VARCHAR(200) NOT NULL, short_name VARCHAR(50) NOT NULL, projects_group VARCHAR(20) NOT NULL, donor_reference VARCHAR(50) DEFAULT NULL, donor_project_name VARCHAR(200) DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status INTEGER NOT NULL, capacity_development INTEGER NOT NULL)');
        $this->addSql('INSERT INTO project (id, principal_investigator_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, start_date, end_date, status, capacity_development) SELECT id, principal_investigator_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, start_date, end_date, status, capacity_development FROM __temp__project');
        $this->addSql('DROP TABLE __temp__project');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE5BD1A144 ON project (principal_investigator_id)');
        $this->addSql('DROP INDEX IDX_49213369166D1F9C');
        $this->addSql('DROP INDEX IDX_492133696AE7F85');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_activity AS SELECT id, project_id, partnership_id, description, start_date, end_date FROM sampling_activity');
        $this->addSql('DROP TABLE sampling_activity');
        $this->addSql('CREATE TABLE sampling_activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partnership_id INTEGER NOT NULL, description VARCHAR(200) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL)');
        $this->addSql('INSERT INTO sampling_activity (id, project_id, partnership_id, description, start_date, end_date) SELECT id, project_id, partnership_id, description, start_date, end_date FROM __temp__sampling_activity');
        $this->addSql('DROP TABLE __temp__sampling_activity');
        $this->addSql('CREATE INDEX IDX_49213369166D1F9C ON sampling_activity (project_id)');
        $this->addSql('CREATE INDEX IDX_492133696AE7F85 ON sampling_activity (partnership_id)');
        $this->addSql('DROP INDEX IDX_43BC985A994540B8');
        $this->addSql('DROP INDEX IDX_43BC985A61232A4F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_documentation AS SELECT id, sampling_activity_id, document_type_id, document FROM sampling_documentation');
        $this->addSql('DROP TABLE sampling_documentation');
        $this->addSql('CREATE TABLE sampling_documentation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sampling_activity_id INTEGER NOT NULL, document_type_id INTEGER NOT NULL, document VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO sampling_documentation (id, sampling_activity_id, document_type_id, document) SELECT id, sampling_activity_id, document_type_id, document FROM __temp__sampling_documentation');
        $this->addSql('DROP TABLE __temp__sampling_documentation');
        $this->addSql('CREATE INDEX IDX_43BC985A994540B8 ON sampling_documentation (sampling_activity_id)');
        $this->addSql('CREATE INDEX IDX_43BC985A61232A4F ON sampling_documentation (document_type_id)');
        $this->addSql('DROP INDEX UNIQ_7BB15543E0E861BD');
        $this->addSql('DROP INDEX UNIQ_7BB15543DBC463C4');
        $this->addSql('DROP INDEX UNIQ_7BB15543665648E9');
        $this->addSql('DROP INDEX UNIQ_7BB1554336AC99F1');
        $this->addSql('DROP INDEX UNIQ_7BB155439520AA7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sdg AS SELECT id, headline, full_name, color, link, logo_url FROM sdg');
        $this->addSql('DROP TABLE sdg');
        $this->addSql('CREATE TABLE sdg (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, headline VARCHAR(50) NOT NULL, full_name VARCHAR(200) NOT NULL, color VARCHAR(7) NOT NULL, link VARCHAR(255) NOT NULL, logo_url VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO sdg (id, headline, full_name, color, link, logo_url) SELECT id, headline, full_name, color, link, logo_url FROM __temp__sdg');
        $this->addSql('DROP TABLE __temp__sdg');
        $this->addSql('DROP INDEX IDX_8EB6A6AF166D1F9C');
        $this->addSql('DROP INDEX IDX_8EB6A6AF6F37DCD9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sdgrole AS SELECT id, project_id, sdg_id, percent FROM sdgrole');
        $this->addSql('DROP TABLE sdgrole');
        $this->addSql('CREATE TABLE sdgrole (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, sdg_id INTEGER NOT NULL, percent INTEGER NOT NULL)');
        $this->addSql('INSERT INTO sdgrole (id, project_id, sdg_id, percent) SELECT id, project_id, sdg_id, percent FROM __temp__sdgrole');
        $this->addSql('DROP TABLE __temp__sdgrole');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF166D1F9C ON sdgrole (project_id)');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF6F37DCD9 ON sdgrole (sdg_id)');
        $this->addSql('DROP INDEX IDX_B55FFCE5166D1F9C');
        $this->addSql('DROP INDEX IDX_B55FFCE5217BBB47');
        $this->addSql('CREATE TEMPORARY TABLE __temp__staff_role AS SELECT id, project_id, person_id, percent FROM staff_role');
        $this->addSql('DROP TABLE staff_role');
        $this->addSql('CREATE TABLE staff_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, person_id INTEGER NOT NULL, percent INTEGER NOT NULL)');
        $this->addSql('INSERT INTO staff_role (id, project_id, person_id, percent) SELECT id, project_id, person_id, percent FROM __temp__staff_role');
        $this->addSql('DROP TABLE __temp__staff_role');
        $this->addSql('CREATE INDEX IDX_B55FFCE5166D1F9C ON staff_role (project_id)');
        $this->addSql('CREATE INDEX IDX_B55FFCE5217BBB47 ON staff_role (person_id)');
    }
}
