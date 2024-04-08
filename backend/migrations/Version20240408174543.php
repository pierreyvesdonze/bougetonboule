<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408174543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, instruction LONGTEXT NOT NULL, difficulty VARCHAR(32) NOT NULL, body_part VARCHAR(32) NOT NULL, image VARCHAR(255) DEFAULT NULL, priority_order SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_instance (id INT AUTO_INCREMENT NOT NULL, training_program_id INT NOT NULL, exercise_id INT NOT NULL, level SMALLINT NOT NULL, serie SMALLINT NOT NULL, repetition_count SMALLINT DEFAULT NULL, duration_start SMALLINT DEFAULT NULL, duration_end SMALLINT DEFAULT NULL, break_time SMALLINT NOT NULL, INDEX IDX_445C11368406BD6C (training_program_id), UNIQUE INDEX UNIQ_445C1136E934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goal_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, weight VARCHAR(32) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_program (id INT AUTO_INCREMENT NOT NULL, goal_category_id INT NOT NULL, title VARCHAR(255) NOT NULL, instruction LONGTEXT NOT NULL, INDEX IDX_4FD3E78A8C005C50 (goal_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_session (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_finish TINYINT(1) NOT NULL, INDEX IDX_D7A45DAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_week (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, training_program_id INT NOT NULL, selected_training_days JSON NOT NULL COMMENT \'(DC2Type:json)\', is_finish TINYINT(1) NOT NULL, INDEX IDX_54C02E83A76ED395 (user_id), INDEX IDX_54C02E838406BD6C (training_program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_performance (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, training_session_id INT NOT NULL, exercise_instance_id INT NOT NULL, repetition_count SMALLINT DEFAULT NULL, duration_start SMALLINT DEFAULT NULL, duration_end SMALLINT DEFAULT NULL, INDEX IDX_2BCC5F14A76ED395 (user_id), INDEX IDX_2BCC5F14DB8156B9 (training_session_id), INDEX IDX_2BCC5F1477A36299 (exercise_instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise_instance ADD CONSTRAINT FK_445C11368406BD6C FOREIGN KEY (training_program_id) REFERENCES training_program (id)');
        $this->addSql('ALTER TABLE exercise_instance ADD CONSTRAINT FK_445C1136E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE training_program ADD CONSTRAINT FK_4FD3E78A8C005C50 FOREIGN KEY (goal_category_id) REFERENCES goal_category (id)');
        $this->addSql('ALTER TABLE training_session ADD CONSTRAINT FK_D7A45DAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training_week ADD CONSTRAINT FK_54C02E83A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training_week ADD CONSTRAINT FK_54C02E838406BD6C FOREIGN KEY (training_program_id) REFERENCES training_program (id)');
        $this->addSql('ALTER TABLE user_performance ADD CONSTRAINT FK_2BCC5F14A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_performance ADD CONSTRAINT FK_2BCC5F14DB8156B9 FOREIGN KEY (training_session_id) REFERENCES training_session (id)');
        $this->addSql('ALTER TABLE user_performance ADD CONSTRAINT FK_2BCC5F1477A36299 FOREIGN KEY (exercise_instance_id) REFERENCES exercise_instance (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise_instance DROP FOREIGN KEY FK_445C11368406BD6C');
        $this->addSql('ALTER TABLE exercise_instance DROP FOREIGN KEY FK_445C1136E934951A');
        $this->addSql('ALTER TABLE training_program DROP FOREIGN KEY FK_4FD3E78A8C005C50');
        $this->addSql('ALTER TABLE training_session DROP FOREIGN KEY FK_D7A45DAA76ED395');
        $this->addSql('ALTER TABLE training_week DROP FOREIGN KEY FK_54C02E83A76ED395');
        $this->addSql('ALTER TABLE training_week DROP FOREIGN KEY FK_54C02E838406BD6C');
        $this->addSql('ALTER TABLE user_performance DROP FOREIGN KEY FK_2BCC5F14A76ED395');
        $this->addSql('ALTER TABLE user_performance DROP FOREIGN KEY FK_2BCC5F14DB8156B9');
        $this->addSql('ALTER TABLE user_performance DROP FOREIGN KEY FK_2BCC5F1477A36299');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE exercise_instance');
        $this->addSql('DROP TABLE goal_category');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE training_program');
        $this->addSql('DROP TABLE training_session');
        $this->addSql('DROP TABLE training_week');
        $this->addSql('DROP TABLE user_performance');
    }
}
