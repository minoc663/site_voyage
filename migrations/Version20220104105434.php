<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104105434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, vol_id INT NOT NULL, INDEX IDX_42C84955A76ED395 (user_id), UNIQUE INDEX UNIQ_42C849559F2BFB7A (vol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559F2BFB7A FOREIGN KEY (vol_id) REFERENCES vol (id)');
        $this->addSql('ALTER TABLE hebergement ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_4852DD9CB83297E7 ON hebergement (reservation_id)');
        $this->addSql('ALTER TABLE voyageur ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyageur ADD CONSTRAINT FK_FE322254B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_FE322254B83297E7 ON voyageur (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CB83297E7');
        $this->addSql('ALTER TABLE voyageur DROP FOREIGN KEY FK_FE322254B83297E7');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP INDEX IDX_4852DD9CB83297E7 ON hebergement');
        $this->addSql('ALTER TABLE hebergement DROP reservation_id');
        $this->addSql('DROP INDEX IDX_FE322254B83297E7 ON voyageur');
        $this->addSql('ALTER TABLE voyageur DROP reservation_id');
    }
}
