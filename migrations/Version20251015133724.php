<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251015133724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, nom VARCHAR(255) NOT NULL, lien_prototype VARCHAR(255) NOT NULL, INDEX IDX_2449BA15C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hackathon (id INT AUTO_INCREMENT NOT NULL, organisateur_id INT NOT NULL, date_heure_debut DATETIME DEFAULT NULL, date_heure_fin DATETIME DEFAULT NULL, lieu VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, theme VARCHAR(255) DEFAULT NULL, INDEX IDX_8B3AF64FD936B2FA (organisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, hackathon_id INT NOT NULL, participant_id INT NOT NULL, equipe_id INT NOT NULL, num INT NOT NULL, date DATETIME NOT NULL, competence VARCHAR(255) DEFAULT NULL, INDEX IDX_5E90F6D6996D90CF (hackathon_id), INDEX IDX_5E90F6D69D1C3019 (participant_id), INDEX IDX_5E90F6D66D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_jury (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noter (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisateur (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, site_web VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, date_naissance DATETIME NOT NULL, lien_portefolio VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, hackathon_id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, retenu TINYINT(1) NOT NULL, INDEX IDX_50159CA9996D90CF (hackathon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE hackathon ADD CONSTRAINT FK_8B3AF64FD936B2FA FOREIGN KEY (organisateur_id) REFERENCES organisateur (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D66D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9996D90CF FOREIGN KEY (hackathon_id) REFERENCES hackathon (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15C18272');
        $this->addSql('ALTER TABLE hackathon DROP FOREIGN KEY FK_8B3AF64FD936B2FA');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6996D90CF');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69D1C3019');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D66D861B89');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9996D90CF');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE hackathon');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE membre_jury');
        $this->addSql('DROP TABLE noter');
        $this->addSql('DROP TABLE organisateur');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
