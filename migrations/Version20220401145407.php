<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220401145407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D9D86650F');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921DDE18E50B');
        $this->addSql('DROP INDEX IDX_DA62921D9D86650F ON bookmark');
        $this->addSql('DROP INDEX IDX_DA62921DDE18E50B ON bookmark');
        $this->addSql('ALTER TABLE bookmark ADD user_id INT NOT NULL, ADD product_id INT NOT NULL, DROP user_id_id, DROP product_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark ADD user_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP user_id, DROP product_id');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921DDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DA62921D9D86650F ON bookmark (user_id_id)');
        $this->addSql('CREATE INDEX IDX_DA62921DDE18E50B ON bookmark (product_id_id)');
    }
}
