<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241202141319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add category, director, actors relations';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE cast (movie_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_12B8B9F68F93B6FC (movie_id), INDEX IDX_12B8B9F6217BBB47 (person_id), PRIMARY KEY(movie_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cast ADD CONSTRAINT FK_12B8B9F68F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cast ADD CONSTRAINT FK_12B8B9F6217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD category_id INT NOT NULL, ADD director_id INT NOT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F899FB366 FOREIGN KEY (director_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F12469DE2 ON movie (category_id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F899FB366 ON movie (director_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cast DROP FOREIGN KEY FK_12B8B9F68F93B6FC');
        $this->addSql('ALTER TABLE cast DROP FOREIGN KEY FK_12B8B9F6217BBB47');
        $this->addSql('DROP TABLE cast');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F12469DE2');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F899FB366');
        $this->addSql('DROP INDEX IDX_1D5EF26F12469DE2 ON movie');
        $this->addSql('DROP INDEX IDX_1D5EF26F899FB366 ON movie');
        $this->addSql('ALTER TABLE movie DROP category_id, DROP director_id');
    }
}
