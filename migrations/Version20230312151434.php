<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312151434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marca (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentacion (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, zona_id INT DEFAULT NULL, proveedor_id INT DEFAULT NULL, presentacion_id INT DEFAULT NULL, marca_id INT DEFAULT NULL, codigo INT NOT NULL, descripcion_producto VARCHAR(200) NOT NULL, precio DOUBLE PRECISION NOT NULL, stock INT NOT NULL, iva INT NOT NULL, peso DOUBLE PRECISION NOT NULL, INDEX IDX_A7BB0615104EA8FC (zona_id), INDEX IDX_A7BB0615CB305D73 (proveedor_id), INDEX IDX_A7BB061591BDCCB (presentacion_id), INDEX IDX_A7BB061581EF0041 (marca_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proveedor (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zona (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615104EA8FC FOREIGN KEY (zona_id) REFERENCES zona (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615CB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061591BDCCB FOREIGN KEY (presentacion_id) REFERENCES presentacion (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061581EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615104EA8FC');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615CB305D73');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB061591BDCCB');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB061581EF0041');
        $this->addSql('DROP TABLE marca');
        $this->addSql('DROP TABLE presentacion');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE proveedor');
        $this->addSql('DROP TABLE zona');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
