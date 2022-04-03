<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403173648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, price NUMERIC(16, 2) NOT NULL, INDEX IDX_17FD46C1A76ED395 (user_id), INDEX IDX_17FD46C14584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C14584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE bookmark ADD user_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP user_id, DROP product_id');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921DDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_DA62921D9D86650F ON bookmark (user_id_id)');
        $this->addSql('CREATE INDEX IDX_DA62921DDE18E50B ON bookmark (product_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE alert');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D9D86650F');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921DDE18E50B');
        $this->addSql('DROP INDEX IDX_DA62921D9D86650F ON bookmark');
        $this->addSql('DROP INDEX IDX_DA62921DDE18E50B ON bookmark');
        $this->addSql('ALTER TABLE bookmark ADD user_id INT NOT NULL, ADD product_id INT NOT NULL, DROP user_id_id, DROP product_id_id');
    }
}
