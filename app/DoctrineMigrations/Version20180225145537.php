<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180225145537 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE task (id_increment INT AUTO_INCREMENT NOT NULL, user_has_courses_id INT DEFAULT NULL, tarea TEXT DEFAULT NULL, fecha_entrega DATETIME DEFAULT NULL, nota INT DEFAULT NULL, estado TEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_527EDB2574EE754E (user_has_courses_id), INDEX fk_task_user_has_courses1_idx (user_has_courses_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attendance (id_increment INT AUTO_INCREMENT NOT NULL, user_has_courses_id INT DEFAULT NULL, option_date DATETIME DEFAULT NULL, option_status VARCHAR(45) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_6DE30D9174EE754E (user_has_courses_id), INDEX fk_assistance_user_has_courses1_idx (user_has_courses_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_courses (id_increment INT AUTO_INCREMENT NOT NULL, courses_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX fk_user_project_has_courses_courses1_idx (courses_id), INDEX fk_user_project_has_courses_user_project1_idx (user_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grades (id_increment INT AUTO_INCREMENT NOT NULL, user_has_courses_id INT DEFAULT NULL, bimester VARCHAR(45) DEFAULT NULL, note_monthly INT DEFAULT NULL, note_bimonthly INT DEFAULT NULL, note_teacher INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_3AE3611074EE754E (user_has_courses_id), INDEX fk_notes_user_has_courses1_idx (user_has_courses_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE communication (id_increment INT AUTO_INCREMENT NOT NULL, user_has_courses_id INT DEFAULT NULL, message TEXT DEFAULT NULL, message_type VARCHAR(45) DEFAULT NULL, message_date DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_F9AFB5EB74EE754E (user_has_courses_id), INDEX fk_communication_user_has_courses1_idx (user_has_courses_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_has_permission (profile_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_9D41AA2CCCFA12B8 (profile_id), INDEX IDX_9D41AA2CFED90CCA (permission_id), PRIMARY KEY(profile_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_project (id_increment INT NOT NULL, user_id INT DEFAULT NULL, profile_id INT DEFAULT NULL, username VARCHAR(45) NOT NULL, registration_id LONGTEXT NOT NULL, slug VARCHAR(255) DEFAULT NULL, device_code VARCHAR(100) DEFAULT NULL, password VARCHAR(100) DEFAULT NULL, salt VARCHAR(45) DEFAULT NULL, dni VARCHAR(8) DEFAULT NULL, name VARCHAR(100) NOT NULL, last_name VARCHAR(100) DEFAULT NULL, dob DATE DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(45) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, is_father TINYINT(1) DEFAULT NULL, last_access DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_77BECEE4A76ED395 (user_id), INDEX FK_8D93D649CCFA12B8 (profile_id), INDEX fk_user_project_user_project1_idx (user_id), UNIQUE INDEX email_UNIQUE (email), UNIQUE INDEX username_UNIQUE (username), UNIQUE INDEX dni_UNIQUE (dni), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id_increment INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) DEFAULT NULL, group_permission VARCHAR(45) DEFAULT NULL, group_permission_tag VARCHAR(45) DEFAULT NULL, alias VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id_increment INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(45) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D044D5D4A76ED395 (user_id), PRIMARY KEY(id_increment)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2574EE754E FOREIGN KEY (user_has_courses_id) REFERENCES user_has_courses (id_increment)');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D9174EE754E FOREIGN KEY (user_has_courses_id) REFERENCES user_has_courses (id_increment)');
        $this->addSql('ALTER TABLE user_has_courses ADD CONSTRAINT FK_674FFB02F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id_increment)');
        $this->addSql('ALTER TABLE user_has_courses ADD CONSTRAINT FK_674FFB02A76ED395 FOREIGN KEY (user_id) REFERENCES user_project (id_increment)');
        $this->addSql('ALTER TABLE grades ADD CONSTRAINT FK_3AE3611074EE754E FOREIGN KEY (user_has_courses_id) REFERENCES user_has_courses (id_increment)');
        $this->addSql('ALTER TABLE communication ADD CONSTRAINT FK_F9AFB5EB74EE754E FOREIGN KEY (user_has_courses_id) REFERENCES user_has_courses (id_increment)');
        $this->addSql('ALTER TABLE profile_has_permission ADD CONSTRAINT FK_9D41AA2CCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE profile_has_permission ADD CONSTRAINT FK_9D41AA2CFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id_increment)');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4A76ED395 FOREIGN KEY (user_id) REFERENCES user_project (id_increment)');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id_increment)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4A76ED395 FOREIGN KEY (user_id) REFERENCES user_project (id_increment)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2574EE754E');
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D9174EE754E');
        $this->addSql('ALTER TABLE grades DROP FOREIGN KEY FK_3AE3611074EE754E');
        $this->addSql('ALTER TABLE communication DROP FOREIGN KEY FK_F9AFB5EB74EE754E');
        $this->addSql('ALTER TABLE user_has_courses DROP FOREIGN KEY FK_674FFB02F9295384');
        $this->addSql('ALTER TABLE profile_has_permission DROP FOREIGN KEY FK_9D41AA2CCCFA12B8');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4CCFA12B8');
        $this->addSql('ALTER TABLE user_has_courses DROP FOREIGN KEY FK_674FFB02A76ED395');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4A76ED395');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4A76ED395');
        $this->addSql('ALTER TABLE profile_has_permission DROP FOREIGN KEY FK_9D41AA2CFED90CCA');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('DROP TABLE user_has_courses');
        $this->addSql('DROP TABLE grades');
        $this->addSql('DROP TABLE communication');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_has_permission');
        $this->addSql('DROP TABLE user_project');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE session');
    }
}
