<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250923083904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe ADD projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_2449BA15C18272 ON equipe (projet_id)');
        $this->addSql('ALTER TABLE inscription ADD hackathon_id INT NOT NULL, ADD participant_id INT NOT NULL, ADD equipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D66D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6996D90CF ON inscription (hackathon_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D69D1C3019 ON inscription (participant_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D66D861B89 ON inscription (equipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15C18272');
        $this->addSql('DROP INDEX IDX_2449BA15C18272 ON equipe');
        $this->addSql('ALTER TABLE equipe DROP projet_id');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6996D90CF');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69D1C3019');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D66D861B89');
        $this->addSql('DROP INDEX IDX_5E90F6D6996D90CF ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D69D1C3019 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D66D861B89 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP hackathon_id, DROP participant_id, DROP equipe_id');
    }
}
