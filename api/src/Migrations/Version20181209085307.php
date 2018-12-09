<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181209085307 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_message (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD message_type_id INT NOT NULL, DROP message_type');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63855C4B69F FOREIGN KEY (message_type_id) REFERENCES type_message (id)');
        $this->addSql('CREATE INDEX IDX_4C62E63855C4B69F ON contact (message_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63855C4B69F');
        $this->addSql('DROP TABLE type_message');
        $this->addSql('DROP INDEX IDX_4C62E63855C4B69F ON contact');
        $this->addSql('ALTER TABLE contact ADD message_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP message_type_id');
    }
}
