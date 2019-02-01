<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190201070421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_B55FFCE5166D1F9C');
        $this->addSql('DROP INDEX IDX_B55FFCE5217BBB47');
        $this->addSql('CREATE TEMPORARY TABLE __temp__staff_role AS SELECT id, project_id, person_id, percent FROM staff_role');
        $this->addSql('DROP TABLE staff_role');
        $this->addSql('CREATE TABLE staff_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, person_id INTEGER NOT NULL, percent INTEGER NOT NULL, CONSTRAINT FK_B55FFCE5166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B55FFCE5217BBB47 FOREIGN KEY (person_id) REFERENCES staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO staff_role (id, project_id, person_id, percent) SELECT id, project_id, person_id, percent FROM __temp__staff_role');
        $this->addSql('DROP TABLE __temp__staff_role');
        $this->addSql('CREATE INDEX IDX_B55FFCE5166D1F9C ON staff_role (project_id)');
        $this->addSql('CREATE INDEX IDX_B55FFCE5217BBB47 ON staff_role (person_id)');
        $this->addSql('DROP INDEX IDX_8619D6AE166D1F9C');
        $this->addSql('DROP INDEX IDX_8619D6AE9393F8FE');
        $this->addSql('DROP INDEX IDX_8619D6AEDCAFB84E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partnership AS SELECT id, project_id, partner_id, partnership_type_id, start_date, end_date FROM partnership');
        $this->addSql('DROP TABLE partnership');
        $this->addSql('CREATE TABLE partnership (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partner_id INTEGER NOT NULL, partnership_type_id INTEGER NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, CONSTRAINT FK_8619D6AE166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8619D6AE9393F8FE FOREIGN KEY (partner_id) REFERENCES organisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8619D6AEDCAFB84E FOREIGN KEY (partnership_type_id) REFERENCES partnership_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO partnership (id, project_id, partner_id, partnership_type_id, start_date, end_date) SELECT id, project_id, partner_id, partnership_type_id, start_date, end_date FROM __temp__partnership');
        $this->addSql('DROP TABLE __temp__partnership');
        $this->addSql('CREATE INDEX IDX_8619D6AE166D1F9C ON partnership (project_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AE9393F8FE ON partnership (partner_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AEDCAFB84E ON partnership (partnership_type_id)');
        $this->addSql('DROP INDEX IDX_5581D2E56AE7F85');
        $this->addSql('DROP INDEX IDX_5581D2E5E7A1254A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partnership_contact AS SELECT partnership_id, contact_id FROM partnership_contact');
        $this->addSql('DROP TABLE partnership_contact');
        $this->addSql('CREATE TABLE partnership_contact (partnership_id INTEGER NOT NULL, contact_id INTEGER NOT NULL, PRIMARY KEY(partnership_id, contact_id), CONSTRAINT FK_5581D2E56AE7F85 FOREIGN KEY (partnership_id) REFERENCES partnership (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5581D2E5E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO partnership_contact (partnership_id, contact_id) SELECT partnership_id, contact_id FROM __temp__partnership_contact');
        $this->addSql('DROP TABLE __temp__partnership_contact');
        $this->addSql('CREATE INDEX IDX_5581D2E56AE7F85 ON partnership_contact (partnership_id)');
        $this->addSql('CREATE INDEX IDX_5581D2E5E7A1254A ON partnership_contact (contact_id)');
        $this->addSql('DROP INDEX IDX_D05A018E166D1F9C');
        $this->addSql('DROP INDEX IDX_D05A018EF92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__country_role AS SELECT id, project_id, country_id, percent FROM country_role');
        $this->addSql('DROP TABLE country_role');
        $this->addSql('CREATE TABLE country_role (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, country_id INTEGER NOT NULL, percent INTEGER NOT NULL, CONSTRAINT FK_D05A018E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D05A018EF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO country_role (id, project_id, country_id, percent) SELECT id, project_id, country_id, percent FROM __temp__country_role');
        $this->addSql('DROP TABLE __temp__country_role');
        $this->addSql('CREATE INDEX IDX_D05A018E166D1F9C ON country_role (project_id)');
        $this->addSql('CREATE INDEX IDX_D05A018EF92F3E70 ON country_role (country_id)');
        $this->addSql('DROP INDEX IDX_2FB3D0EE3DD7B7A7');
        $this->addSql('DROP INDEX IDX_2FB3D0EE5BD1A144');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project AS SELECT id, principal_investigator_id, donor_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, total_project_value, total_ilri_value, total_livegene_value, start_date, end_date, status, capacity_development FROM project');
        $this->addSql('DROP TABLE project');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, principal_investigator_id INTEGER NOT NULL, donor_id INTEGER DEFAULT NULL, ilri_code VARCHAR(20) NOT NULL COLLATE BINARY, full_name VARCHAR(200) NOT NULL COLLATE BINARY, short_name VARCHAR(50) NOT NULL COLLATE BINARY, donor_reference VARCHAR(50) DEFAULT NULL COLLATE BINARY, donor_project_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, total_project_value INTEGER DEFAULT NULL, total_ilri_value INTEGER DEFAULT NULL, total_livegene_value INTEGER DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status INTEGER NOT NULL, capacity_development INTEGER NOT NULL, team VARCHAR(20) NOT NULL, CONSTRAINT FK_2FB3D0EE5BD1A144 FOREIGN KEY (principal_investigator_id) REFERENCES staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2FB3D0EE3DD7B7A7 FOREIGN KEY (donor_id) REFERENCES organisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO project (id, principal_investigator_id, donor_id, ilri_code, full_name, short_name, team, donor_reference, donor_project_name, total_project_value, total_ilri_value, total_livegene_value, start_date, end_date, status, capacity_development) SELECT id, principal_investigator_id, donor_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, total_project_value, total_ilri_value, total_livegene_value, start_date, end_date, status, capacity_development FROM __temp__project');
        $this->addSql('DROP TABLE __temp__project');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE3DD7B7A7 ON project (donor_id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE5BD1A144 ON project (principal_investigator_id)');
        $this->addSql('DROP INDEX IDX_8EB6A6AF166D1F9C');
        $this->addSql('DROP INDEX IDX_8EB6A6AF6F37DCD9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sdgrole AS SELECT id, project_id, sdg_id, percent FROM sdgrole');
        $this->addSql('DROP TABLE sdgrole');
        $this->addSql('CREATE TABLE sdgrole (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, sdg_id INTEGER NOT NULL, percent INTEGER NOT NULL, CONSTRAINT FK_8EB6A6AF166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8EB6A6AF6F37DCD9 FOREIGN KEY (sdg_id) REFERENCES sdg (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sdgrole (id, project_id, sdg_id, percent) SELECT id, project_id, sdg_id, percent FROM __temp__sdgrole');
        $this->addSql('DROP TABLE __temp__sdgrole');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF166D1F9C ON sdgrole (project_id)');
        $this->addSql('CREATE INDEX IDX_8EB6A6AF6F37DCD9 ON sdgrole (sdg_id)');
        $this->addSql('DROP INDEX IDX_49213369166D1F9C');
        $this->addSql('DROP INDEX IDX_492133699393F8FE');
        $this->addSql('DROP INDEX IDX_492133697E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_activity AS SELECT id, project_id, partner_id, owner_id, description, start_date, end_date FROM sampling_activity');
        $this->addSql('DROP TABLE sampling_activity');
        $this->addSql('CREATE TABLE sampling_activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partner_id INTEGER NOT NULL, owner_id INTEGER NOT NULL, description VARCHAR(200) NOT NULL COLLATE BINARY, start_date DATE NOT NULL, end_date DATE NOT NULL, CONSTRAINT FK_49213369166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_492133699393F8FE FOREIGN KEY (partner_id) REFERENCES organisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_492133697E3C61F9 FOREIGN KEY (owner_id) REFERENCES fos_user_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sampling_activity (id, project_id, partner_id, owner_id, description, start_date, end_date) SELECT id, project_id, partner_id, owner_id, description, start_date, end_date FROM __temp__sampling_activity');
        $this->addSql('DROP TABLE __temp__sampling_activity');
        $this->addSql('CREATE INDEX IDX_49213369166D1F9C ON sampling_activity (project_id)');
        $this->addSql('CREATE INDEX IDX_492133699393F8FE ON sampling_activity (partner_id)');
        $this->addSql('CREATE INDEX IDX_492133697E3C61F9 ON sampling_activity (owner_id)');
        $this->addSql('DROP INDEX IDX_43BC985A994540B8');
        $this->addSql('DROP INDEX IDX_43BC985ADA055526');
        $this->addSql('DROP INDEX IDX_43BC985AC33F7837');
        $this->addSql('DROP INDEX IDX_43BC985A7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_documentation AS SELECT id, sampling_activity_id, sampling_document_type_id, document_id, owner_id FROM sampling_documentation');
        $this->addSql('DROP TABLE sampling_documentation');
        $this->addSql('CREATE TABLE sampling_documentation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sampling_activity_id INTEGER NOT NULL, sampling_document_type_id INTEGER NOT NULL, document_id INTEGER NOT NULL, owner_id INTEGER NOT NULL, CONSTRAINT FK_43BC985A994540B8 FOREIGN KEY (sampling_activity_id) REFERENCES sampling_activity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_43BC985ADA055526 FOREIGN KEY (sampling_document_type_id) REFERENCES sampling_document_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_43BC985AC33F7837 FOREIGN KEY (document_id) REFERENCES media__media (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_43BC985A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES fos_user_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sampling_documentation (id, sampling_activity_id, sampling_document_type_id, document_id, owner_id) SELECT id, sampling_activity_id, sampling_document_type_id, document_id, owner_id FROM __temp__sampling_documentation');
        $this->addSql('DROP TABLE __temp__sampling_documentation');
        $this->addSql('CREATE INDEX IDX_43BC985A994540B8 ON sampling_documentation (sampling_activity_id)');
        $this->addSql('CREATE INDEX IDX_43BC985ADA055526 ON sampling_documentation (sampling_document_type_id)');
        $this->addSql('CREATE INDEX IDX_43BC985AC33F7837 ON sampling_documentation (document_id)');
        $this->addSql('CREATE INDEX IDX_43BC985A7E3C61F9 ON sampling_documentation (owner_id)');
        $this->addSql('DROP INDEX IDX_E6E132B4F92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__organisation AS SELECT id, country_id, short_name, full_name, logo_url FROM organisation');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('CREATE TABLE organisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, short_name VARCHAR(20) DEFAULT NULL COLLATE BINARY, full_name VARCHAR(200) NOT NULL COLLATE BINARY, logo_url VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_E6E132B4F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO organisation (id, country_id, short_name, full_name, logo_url) SELECT id, country_id, short_name, full_name, logo_url FROM __temp__organisation');
        $this->addSql('DROP TABLE __temp__organisation');
        $this->addSql('CREATE INDEX IDX_E6E132B4F92F3E70 ON organisation (country_id)');
        $this->addSql('DROP INDEX IDX_80D4C5414E7AF8F');
        $this->addSql('DROP INDEX IDX_80D4C541EA9FDD75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__media__gallery_media AS SELECT id, gallery_id, media_id, position, enabled, updated_at, created_at FROM media__gallery_media');
        $this->addSql('DROP TABLE media__gallery_media');
        $this->addSql('CREATE TABLE media__gallery_media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, gallery_id INTEGER DEFAULT NULL, media_id INTEGER DEFAULT NULL, position INTEGER NOT NULL, enabled BOOLEAN NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_80D4C5414E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_80D4C541EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO media__gallery_media (id, gallery_id, media_id, position, enabled, updated_at, created_at) SELECT id, gallery_id, media_id, position, enabled, updated_at, created_at FROM __temp__media__gallery_media');
        $this->addSql('DROP TABLE __temp__media__gallery_media');
        $this->addSql('CREATE INDEX IDX_80D4C5414E7AF8F ON media__gallery_media (gallery_id)');
        $this->addSql('CREATE INDEX IDX_80D4C541EA9FDD75 ON media__gallery_media (media_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__media__media AS SELECT id, description, enabled, provider_status, width, height, content_size, cdn_is_flushable, cdn_flush_at, cdn_status, updated_at, created_at, name, provider_name, provider_reference, length, content_type, copyright, author_name, context, cdn_flush_identifier, provider_metadata FROM media__media');
        $this->addSql('DROP TABLE media__media');
        $this->addSql('CREATE TABLE media__media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description CLOB DEFAULT NULL COLLATE BINARY, enabled BOOLEAN NOT NULL, provider_status INTEGER NOT NULL, width INTEGER DEFAULT NULL, height INTEGER DEFAULT NULL, content_size INTEGER DEFAULT NULL, cdn_is_flushable BOOLEAN DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INTEGER DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, provider_name VARCHAR(255) NOT NULL COLLATE BINARY, provider_reference VARCHAR(255) NOT NULL COLLATE BINARY, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL COLLATE BINARY, copyright VARCHAR(255) DEFAULT NULL COLLATE BINARY, author_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, context VARCHAR(64) DEFAULT NULL COLLATE BINARY, cdn_flush_identifier VARCHAR(64) DEFAULT NULL COLLATE BINARY, provider_metadata CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO media__media (id, description, enabled, provider_status, width, height, content_size, cdn_is_flushable, cdn_flush_at, cdn_status, updated_at, created_at, name, provider_name, provider_reference, length, content_type, copyright, author_name, context, cdn_flush_identifier, provider_metadata) SELECT id, description, enabled, provider_status, width, height, content_size, cdn_is_flushable, cdn_flush_at, cdn_status, updated_at, created_at, name, provider_name, provider_reference, length, content_type, copyright, author_name, context, cdn_flush_identifier, provider_metadata FROM __temp__media__media');
        $this->addSql('DROP TABLE __temp__media__media');
        $this->addSql('DROP INDEX UNIQ_C560D76192FC23A8');
        $this->addSql('DROP INDEX UNIQ_C560D761A0D96FBF');
        $this->addSql('DROP INDEX UNIQ_C560D761C05FB297');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user_user AS SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, twitter_uid, twitter_name, gplus_uid, gplus_name, token, two_step_code, facebook_data, twitter_data, gplus_data FROM fos_user_user');
        $this->addSql('DROP TABLE fos_user_user');
        $this->addSql('CREATE TABLE fos_user_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, username_canonical VARCHAR(180) NOT NULL COLLATE BINARY, email VARCHAR(180) NOT NULL COLLATE BINARY, email_canonical VARCHAR(180) NOT NULL COLLATE BINARY, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL COLLATE BINARY, password_requested_at DATETIME DEFAULT NULL, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:array)
        , created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL COLLATE BINARY, lastname VARCHAR(64) DEFAULT NULL COLLATE BINARY, website VARCHAR(64) DEFAULT NULL COLLATE BINARY, biography VARCHAR(1000) DEFAULT NULL COLLATE BINARY, gender VARCHAR(1) DEFAULT NULL COLLATE BINARY, locale VARCHAR(8) DEFAULT NULL COLLATE BINARY, timezone VARCHAR(64) DEFAULT NULL COLLATE BINARY, phone VARCHAR(64) DEFAULT NULL COLLATE BINARY, facebook_uid VARCHAR(255) DEFAULT NULL COLLATE BINARY, facebook_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, twitter_uid VARCHAR(255) DEFAULT NULL COLLATE BINARY, twitter_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, gplus_uid VARCHAR(255) DEFAULT NULL COLLATE BINARY, gplus_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, token VARCHAR(255) DEFAULT NULL COLLATE BINARY, two_step_code VARCHAR(255) DEFAULT NULL COLLATE BINARY, facebook_data CLOB DEFAULT NULL --(DC2Type:json)
        , twitter_data CLOB DEFAULT NULL --(DC2Type:json)
        , gplus_data CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, twitter_uid, twitter_name, gplus_uid, gplus_name, token, two_step_code, facebook_data, twitter_data, gplus_data) SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, twitter_uid, twitter_name, gplus_uid, gplus_name, token, two_step_code, facebook_data, twitter_data, gplus_data FROM __temp__fos_user_user');
        $this->addSql('DROP TABLE __temp__fos_user_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D76192FC23A8 ON fos_user_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D761A0D96FBF ON fos_user_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D761C05FB297 ON fos_user_user (confirmation_token)');
        $this->addSql('DROP INDEX IDX_B3C77447A76ED395');
        $this->addSql('DROP INDEX IDX_B3C77447FE54D947');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user_user_group AS SELECT user_id, group_id FROM fos_user_user_group');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id), CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO fos_user_user_group (user_id, group_id) SELECT user_id, group_id FROM __temp__fos_user_user_group');
        $this->addSql('DROP TABLE __temp__fos_user_user_group');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
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
        $this->addSql('DROP INDEX UNIQ_C560D76192FC23A8');
        $this->addSql('DROP INDEX UNIQ_C560D761A0D96FBF');
        $this->addSql('DROP INDEX UNIQ_C560D761C05FB297');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user_user AS SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code FROM fos_user_user');
        $this->addSql('DROP TABLE fos_user_user');
        $this->addSql('CREATE TABLE fos_user_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles CLOB NOT NULL --(DC2Type:array)
        , created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(1000) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, facebook_data CLOB DEFAULT \'NULL --(DC2Type:json)\' COLLATE BINARY --(DC2Type:json)
        , twitter_data CLOB DEFAULT \'NULL --(DC2Type:json)\' COLLATE BINARY --(DC2Type:json)
        , gplus_data CLOB DEFAULT \'NULL --(DC2Type:json)\' COLLATE BINARY --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code) SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code FROM __temp__fos_user_user');
        $this->addSql('DROP TABLE __temp__fos_user_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D76192FC23A8 ON fos_user_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D761A0D96FBF ON fos_user_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D761C05FB297 ON fos_user_user (confirmation_token)');
        $this->addSql('DROP INDEX IDX_B3C77447A76ED395');
        $this->addSql('DROP INDEX IDX_B3C77447FE54D947');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user_user_group AS SELECT user_id, group_id FROM fos_user_user_group');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('INSERT INTO fos_user_user_group (user_id, group_id) SELECT user_id, group_id FROM __temp__fos_user_user_group');
        $this->addSql('DROP TABLE __temp__fos_user_user_group');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
        $this->addSql('DROP INDEX IDX_80D4C5414E7AF8F');
        $this->addSql('DROP INDEX IDX_80D4C541EA9FDD75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__media__gallery_media AS SELECT id, gallery_id, media_id, position, enabled, updated_at, created_at FROM media__gallery_media');
        $this->addSql('DROP TABLE media__gallery_media');
        $this->addSql('CREATE TABLE media__gallery_media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, gallery_id INTEGER DEFAULT NULL, media_id INTEGER DEFAULT NULL, position INTEGER NOT NULL, enabled BOOLEAN NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO media__gallery_media (id, gallery_id, media_id, position, enabled, updated_at, created_at) SELECT id, gallery_id, media_id, position, enabled, updated_at, created_at FROM __temp__media__gallery_media');
        $this->addSql('DROP TABLE __temp__media__gallery_media');
        $this->addSql('CREATE INDEX IDX_80D4C5414E7AF8F ON media__gallery_media (gallery_id)');
        $this->addSql('CREATE INDEX IDX_80D4C541EA9FDD75 ON media__gallery_media (media_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__media__media AS SELECT id, name, description, enabled, provider_name, provider_status, provider_reference, provider_metadata, width, height, length, content_type, content_size, copyright, author_name, context, cdn_is_flushable, cdn_flush_identifier, cdn_flush_at, cdn_status, updated_at, created_at FROM media__media');
        $this->addSql('DROP TABLE media__media');
        $this->addSql('CREATE TABLE media__media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, enabled BOOLEAN NOT NULL, provider_name VARCHAR(255) NOT NULL, provider_status INTEGER NOT NULL, provider_reference VARCHAR(255) NOT NULL, width INTEGER DEFAULT NULL, height INTEGER DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, content_size INTEGER DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, cdn_is_flushable BOOLEAN DEFAULT NULL, cdn_flush_identifier VARCHAR(64) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INTEGER DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, provider_metadata CLOB DEFAULT \'NULL --(DC2Type:json)\' COLLATE BINARY --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO media__media (id, name, description, enabled, provider_name, provider_status, provider_reference, provider_metadata, width, height, length, content_type, content_size, copyright, author_name, context, cdn_is_flushable, cdn_flush_identifier, cdn_flush_at, cdn_status, updated_at, created_at) SELECT id, name, description, enabled, provider_name, provider_status, provider_reference, provider_metadata, width, height, length, content_type, content_size, copyright, author_name, context, cdn_is_flushable, cdn_flush_identifier, cdn_flush_at, cdn_status, updated_at, created_at FROM __temp__media__media');
        $this->addSql('DROP TABLE __temp__media__media');
        $this->addSql('DROP INDEX IDX_E6E132B4F92F3E70');
        $this->addSql('CREATE TEMPORARY TABLE __temp__organisation AS SELECT id, country_id, short_name, full_name, logo_url FROM organisation');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('CREATE TABLE organisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, country_id INTEGER NOT NULL, short_name VARCHAR(20) DEFAULT NULL, full_name VARCHAR(200) NOT NULL, logo_url VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO organisation (id, country_id, short_name, full_name, logo_url) SELECT id, country_id, short_name, full_name, logo_url FROM __temp__organisation');
        $this->addSql('DROP TABLE __temp__organisation');
        $this->addSql('CREATE INDEX IDX_E6E132B4F92F3E70 ON organisation (country_id)');
        $this->addSql('DROP INDEX IDX_8619D6AE166D1F9C');
        $this->addSql('DROP INDEX IDX_8619D6AE9393F8FE');
        $this->addSql('DROP INDEX IDX_8619D6AEDCAFB84E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partnership AS SELECT id, project_id, partner_id, partnership_type_id, start_date, end_date FROM partnership');
        $this->addSql('DROP TABLE partnership');
        $this->addSql('CREATE TABLE partnership (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partner_id INTEGER NOT NULL, partnership_type_id INTEGER NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL)');
        $this->addSql('INSERT INTO partnership (id, project_id, partner_id, partnership_type_id, start_date, end_date) SELECT id, project_id, partner_id, partnership_type_id, start_date, end_date FROM __temp__partnership');
        $this->addSql('DROP TABLE __temp__partnership');
        $this->addSql('CREATE INDEX IDX_8619D6AE166D1F9C ON partnership (project_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AE9393F8FE ON partnership (partner_id)');
        $this->addSql('CREATE INDEX IDX_8619D6AEDCAFB84E ON partnership (partnership_type_id)');
        $this->addSql('DROP INDEX IDX_5581D2E56AE7F85');
        $this->addSql('DROP INDEX IDX_5581D2E5E7A1254A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partnership_contact AS SELECT partnership_id, contact_id FROM partnership_contact');
        $this->addSql('DROP TABLE partnership_contact');
        $this->addSql('CREATE TABLE partnership_contact (partnership_id INTEGER NOT NULL, contact_id INTEGER NOT NULL, PRIMARY KEY(partnership_id, contact_id))');
        $this->addSql('INSERT INTO partnership_contact (partnership_id, contact_id) SELECT partnership_id, contact_id FROM __temp__partnership_contact');
        $this->addSql('DROP TABLE __temp__partnership_contact');
        $this->addSql('CREATE INDEX IDX_5581D2E56AE7F85 ON partnership_contact (partnership_id)');
        $this->addSql('CREATE INDEX IDX_5581D2E5E7A1254A ON partnership_contact (contact_id)');
        $this->addSql('DROP INDEX IDX_2FB3D0EE5BD1A144');
        $this->addSql('DROP INDEX IDX_2FB3D0EE3DD7B7A7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project AS SELECT id, principal_investigator_id, donor_id, ilri_code, full_name, short_name, team, donor_reference, donor_project_name, total_project_value, total_ilri_value, total_livegene_value, start_date, end_date, status, capacity_development FROM project');
        $this->addSql('DROP TABLE project');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, principal_investigator_id INTEGER NOT NULL, donor_id INTEGER DEFAULT NULL, ilri_code VARCHAR(20) NOT NULL, full_name VARCHAR(200) NOT NULL, short_name VARCHAR(50) NOT NULL, donor_reference VARCHAR(50) DEFAULT NULL, donor_project_name VARCHAR(255) DEFAULT NULL, total_project_value INTEGER DEFAULT NULL, total_ilri_value INTEGER DEFAULT NULL, total_livegene_value INTEGER DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status INTEGER NOT NULL, capacity_development INTEGER NOT NULL, projects_group VARCHAR(20) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO project (id, principal_investigator_id, donor_id, ilri_code, full_name, short_name, projects_group, donor_reference, donor_project_name, total_project_value, total_ilri_value, total_livegene_value, start_date, end_date, status, capacity_development) SELECT id, principal_investigator_id, donor_id, ilri_code, full_name, short_name, team, donor_reference, donor_project_name, total_project_value, total_ilri_value, total_livegene_value, start_date, end_date, status, capacity_development FROM __temp__project');
        $this->addSql('DROP TABLE __temp__project');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE5BD1A144 ON project (principal_investigator_id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE3DD7B7A7 ON project (donor_id)');
        $this->addSql('DROP INDEX IDX_49213369166D1F9C');
        $this->addSql('DROP INDEX IDX_492133699393F8FE');
        $this->addSql('DROP INDEX IDX_492133697E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_activity AS SELECT id, project_id, partner_id, owner_id, description, start_date, end_date FROM sampling_activity');
        $this->addSql('DROP TABLE sampling_activity');
        $this->addSql('CREATE TABLE sampling_activity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER NOT NULL, partner_id INTEGER NOT NULL, owner_id INTEGER NOT NULL, description VARCHAR(200) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL)');
        $this->addSql('INSERT INTO sampling_activity (id, project_id, partner_id, owner_id, description, start_date, end_date) SELECT id, project_id, partner_id, owner_id, description, start_date, end_date FROM __temp__sampling_activity');
        $this->addSql('DROP TABLE __temp__sampling_activity');
        $this->addSql('CREATE INDEX IDX_49213369166D1F9C ON sampling_activity (project_id)');
        $this->addSql('CREATE INDEX IDX_492133699393F8FE ON sampling_activity (partner_id)');
        $this->addSql('CREATE INDEX IDX_492133697E3C61F9 ON sampling_activity (owner_id)');
        $this->addSql('DROP INDEX IDX_43BC985A994540B8');
        $this->addSql('DROP INDEX IDX_43BC985ADA055526');
        $this->addSql('DROP INDEX IDX_43BC985AC33F7837');
        $this->addSql('DROP INDEX IDX_43BC985A7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sampling_documentation AS SELECT id, sampling_activity_id, sampling_document_type_id, document_id, owner_id FROM sampling_documentation');
        $this->addSql('DROP TABLE sampling_documentation');
        $this->addSql('CREATE TABLE sampling_documentation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sampling_activity_id INTEGER NOT NULL, sampling_document_type_id INTEGER NOT NULL, document_id INTEGER NOT NULL, owner_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO sampling_documentation (id, sampling_activity_id, sampling_document_type_id, document_id, owner_id) SELECT id, sampling_activity_id, sampling_document_type_id, document_id, owner_id FROM __temp__sampling_documentation');
        $this->addSql('DROP TABLE __temp__sampling_documentation');
        $this->addSql('CREATE INDEX IDX_43BC985A994540B8 ON sampling_documentation (sampling_activity_id)');
        $this->addSql('CREATE INDEX IDX_43BC985ADA055526 ON sampling_documentation (sampling_document_type_id)');
        $this->addSql('CREATE INDEX IDX_43BC985AC33F7837 ON sampling_documentation (document_id)');
        $this->addSql('CREATE INDEX IDX_43BC985A7E3C61F9 ON sampling_documentation (owner_id)');
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
