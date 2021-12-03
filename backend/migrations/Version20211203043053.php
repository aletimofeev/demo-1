<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203043053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT fk_5d9f75a1ae80f5df');
        $this->addSql('ALTER TABLE employee DROP CONSTRAINT fk_5d9f75a1dd842e46');
        $this->addSql('DROP SEQUENCE department_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE position_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employee_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE departments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employees_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE positions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE departments (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_16AEB8D45E237E06 ON departments (name)');
        $this->addSql('CREATE INDEX departments_name_idx ON departments (name)');
        $this->addSql('CREATE TABLE employees (id INT NOT NULL, department_id INT NOT NULL, position_id INT NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(50) NOT NULL, patronymic VARCHAR(50) NOT NULL, birth_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA82C300AE80F5DF ON employees (department_id)');
        $this->addSql('CREATE INDEX IDX_BA82C300DD842E46 ON employees (position_id)');
        $this->addSql('CREATE INDEX employees_name_idx ON employees (lastname)');
        $this->addSql('CREATE INDEX employees_birth_date_idx ON employees (birth_date)');
        $this->addSql('CREATE TABLE positions (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX positions_name_idx ON positions (name)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300AE80F5DF FOREIGN KEY (department_id) REFERENCES departments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300DD842E46 FOREIGN KEY (position_id) REFERENCES positions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE "position"');
        $this->addSql('DROP TABLE employee');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employees DROP CONSTRAINT FK_BA82C300AE80F5DF');
        $this->addSql('ALTER TABLE employees DROP CONSTRAINT FK_BA82C300DD842E46');
        $this->addSql('DROP SEQUENCE departments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE employees_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE positions_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE department_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE position_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE department (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_cd1de18a5e237e06 ON department (name)');
        $this->addSql('CREATE TABLE "position" (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, department_id INT NOT NULL, position_id INT NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(50) NOT NULL, patronymic VARCHAR(50) NOT NULL, birth_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_5d9f75a1ae80f5df ON employee (department_id)');
        $this->addSql('CREATE INDEX idx_5d9f75a1dd842e46 ON employee (position_id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT fk_5d9f75a1ae80f5df FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT fk_5d9f75a1dd842e46 FOREIGN KEY (position_id) REFERENCES "position" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE positions');
    }
}
