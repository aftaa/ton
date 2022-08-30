<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220618200443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE if not exists reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE if not exists messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES TripCustomers (CustomerID)');
//        $this->addSql('ALTER TABLE TripArticles CHANGE ArticleID ArticleID INT AUTO_INCREMENT NOT NULL, CHANGE Title title LONGTEXT NOT NULL, CHANGE TitleEN TitleEN LONGTEXT NOT NULL, CHANGE Content content LONGTEXT NOT NULL, CHANGE ContentEN ContentEN LONGTEXT NOT NULL, CHANGE added added DATETIME NOT NULL, CHANGE display display TINYINT(1) NOT NULL, CHANGE sort sort INT NOT NULL');
//        $this->addSql('ALTER TABLE TripCategories CHANGE Name name VARCHAR(255) NOT NULL, CHANGE NameEN NameEN VARCHAR(255) NOT NULL, CHANGE Visible visible TINYINT(1) NOT NULL, CHANGE Image image VARCHAR(255) NOT NULL, CHANGE MenuOrder MenuOrder INT NOT NULL, CHANGE ImageTitle ImageTitle VARCHAR(255) NOT NULL, CHANGE ShowBy ShowBy SMALLINT NOT NULL, CHANGE Text text LONGTEXT NOT NULL, CHANGE PageTitle PageTitle LONGTEXT NOT NULL, CHANGE seo_uri seo_uri VARCHAR(50) NOT NULL, CHANGE keywords keywords LONGTEXT NOT NULL, CHANGE description description LONGTEXT NOT NULL');
//        $this->addSql('ALTER TABLE TripColors ADD name VARCHAR(255) NOT NULL, ADD NameEN VARCHAR(255) NOT NULL, DROP ColorName, DROP ColorNameEN');
//        $this->addSql('ALTER TABLE TripCustomers CHANGE Login login VARCHAR(255) NOT NULL, CHANGE Pass pass VARCHAR(255) NOT NULL, CHANGE FName FName VARCHAR(255) NOT NULL, CHANGE SName SName VARCHAR(255) NOT NULL, CHANGE LName LName VARCHAR(255) NOT NULL, CHANGE Email email VARCHAR(255) NOT NULL, CHANGE Phone phone VARCHAR(255) NOT NULL, CHANGE Country country VARCHAR(255) NOT NULL, CHANGE City city VARCHAR(255) NOT NULL, CHANGE Postalcode postalcode VARCHAR(255) NOT NULL, CHANGE Address address VARCHAR(255) NOT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL');
//        $this->addSql('CREATE UNIQUE INDEX UNIQ_D54DF107AA08CB10 ON TripCustomers (login)');
//        $this->addSql('ALTER TABLE TripDesignes CHANGE DesignName DesignName VARCHAR(255) NOT NULL, CHANGE DesignNameEN DesignNameEN VARCHAR(255) NOT NULL, CHANGE ImageLO ImageLO VARCHAR(255) NOT NULL, CHANGE Visible visible TINYINT(1) NOT NULL, CHANGE CategoryID CategoryID INT NOT NULL, CHANGE DBDate DBDate DATETIME NOT NULL, CHANGE sort sort INT NOT NULL, CHANGE Text text LONGTEXT NOT NULL, CHANGE Search search TINYINT(1) NOT NULL');
//        $this->addSql('CREATE INDEX IDX_6744F3B3E8042869 ON TripDesignes (CategoryID)');
//        $this->addSql('ALTER TABLE TripNews CHANGE Title title VARCHAR(255) NOT NULL, CHANGE TitleEN TitleEN VARCHAR(255) NOT NULL, CHANGE display_ru display_ru TINYINT(1) NOT NULL, CHANGE display_en display_en TINYINT(1) NOT NULL, CHANGE NewsDate NewsDate DATE NOT NULL, CHANGE ImageLO ImageLO VARCHAR(255) NOT NULL, CHANGE ImageHI ImageHI VARCHAR(255) NOT NULL, CHANGE Content content LONGTEXT NOT NULL, CHANGE ContentEN ContentEN VARCHAR(255) NOT NULL, CHANGE Link link VARCHAR(255) NOT NULL, CHANGE SizeX SizeX INT NOT NULL, CHANGE SizeY SizeY INT NOT NULL');
//        $this->addSql('ALTER TABLE TripOrderDetails CHANGE OrderID OrderID INT NOT NULL, CHANGE SizeID SizeID INT NOT NULL, CHANGE ProductDesc ProductDesc VARCHAR(255) NOT NULL, CHANGE ProductPrice ProductPrice INT NOT NULL, CHANGE Quantity quantity INT NOT NULL');
//        $this->addSql('CREATE INDEX IDX_22B570B1EF06D63 ON TripOrderDetails (OrderID)');
//        $this->addSql('CREATE INDEX IDX_22B570B18FE6346E ON TripOrderDetails (ProductID)');
//        $this->addSql('CREATE INDEX IDX_22B570B1B56EF630 ON TripOrderDetails (SizeID)');
//        $this->addSql('ALTER TABLE TripOrders CHANGE CustomerID CustomerID INT NOT NULL, CHANGE OrderStatus OrderStatus INT NOT NULL, CHANGE OrderDate OrderDate DATETIME NOT NULL, CHANGE TotalPrice TotalPrice INT NOT NULL, CHANGE TotalQuantity TotalQuantity INT NOT NULL, CHANGE ShipCountry ShipCountry VARCHAR(255) NOT NULL, CHANGE ShipCity ShipCity VARCHAR(255) NOT NULL, CHANGE ShipPostalcode ShipPostalcode VARCHAR(6) NOT NULL, CHANGE ShipAddress ShipAddress LONGTEXT NOT NULL, CHANGE ShipDate ShipDate DATE NOT NULL, CHANGE Comments comments LONGTEXT NOT NULL, CHANGE Currency currency VARCHAR(10) NOT NULL, CHANGE ShipMetro ShipMetro VARCHAR(100) NOT NULL');
//        $this->addSql('CREATE INDEX IDX_FDAD97D7854CF4BD ON TripOrders (CustomerID)');
//        $this->addSql('ALTER TABLE TripPages CHANGE Title title VARCHAR(255) NOT NULL, CHANGE TitleEN TitleEN VARCHAR(255) NOT NULL, CHANGE Visible visible TINYINT(1) NOT NULL, CHANGE Content content LONGTEXT NOT NULL, CHANGE ContentEN ContentEN LONGTEXT NOT NULL, CHANGE keywords keywords LONGTEXT NOT NULL, CHANGE description description LONGTEXT NOT NULL');
//        $this->addSql('ALTER TABLE TripProducts CHANGE CategoryID CategoryID INT NOT NULL, CHANGE DBDate DBDate DATETIME NOT NULL, CHANGE Name name VARCHAR(255) NOT NULL, CHANGE NameEN NameEN VARCHAR(255) NOT NULL, CHANGE display_ru display_ru TINYINT(1) NOT NULL, CHANGE display_en display_en TINYINT(1) NOT NULL, CHANGE Visible visible TINYINT(1) NOT NULL, CHANGE Marked marked TINYINT(1) NOT NULL, CHANGE MarkedTime MarkedTime DATETIME NOT NULL, CHANGE Description description LONGTEXT NOT NULL, CHANGE DescriptionEN DescriptionEN LONGTEXT NOT NULL, CHANGE ImageLO ImageLO VARCHAR(255) NOT NULL, CHANGE ImageHI ImageHI VARCHAR(255) NOT NULL, CHANGE ImageFL ImageFL VARCHAR(255) NOT NULL, CHANGE ImageHB ImageHB VARCHAR(255) NOT NULL, CHANGE ImageFB ImageFB VARCHAR(255) NOT NULL, CHANGE Price price INT NOT NULL, CHANGE PriceEN PriceEN INT NOT NULL, CHANGE Articul articul VARCHAR(255) NOT NULL, CHANGE TypeID TypeID INT NOT NULL, CHANGE DesignID DesignID INT NOT NULL, CHANGE Sale sale VARCHAR(1) NOT NULL, CHANGE Search search TINYINT(1) NOT NULL, CHANGE keywords keywords LONGTEXT NOT NULL, CHANGE meta_description meta_description LONGTEXT NOT NULL');
//        $this->addSql('CREATE INDEX IDX_10594724A736B16E ON TripProducts (TypeID)');
//        $this->addSql('CREATE INDEX IDX_10594724BC5D423A ON TripProducts (DesignID)');
//        $this->addSql('CREATE INDEX IDX_10594724E8042869 ON TripProducts (CategoryID)');
//        $this->addSql('ALTER TABLE TripSizes DROP display, CHANGE SizeName SizeName VARCHAR(255) NOT NULL');
//        $this->addSql('ALTER TABLE TripTypes CHANGE TypeName TypeName VARCHAR(255) NOT NULL, CHANGE TypeNameEN TypeNameEN VARCHAR(255) NOT NULL, CHANGE Visible visible TINYINT(1) NOT NULL, CHANGE MenuOrder MenuOrder INT NOT NULL, CHANGE Text text LONGTEXT NOT NULL, CHANGE SexID SexID SMALLINT NOT NULL, CHANGE seo_title seo_title VARCHAR(255) NOT NULL, CHANGE Text2 text2 LONGTEXT NOT NULL, CHANGE seo_uri seo_uri VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE TripArticles CHANGE ArticleID ArticleID INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE title Title TEXT DEFAULT NULL, CHANGE TitleEN TitleEN TEXT DEFAULT NULL, CHANGE content Content TEXT DEFAULT NULL, CHANGE ContentEN ContentEN TEXT DEFAULT NULL, CHANGE added added DATETIME DEFAULT NULL, CHANGE display display TINYINT(1) DEFAULT 0 NOT NULL, CHANGE sort sort INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE TripCategories CHANGE name Name VARCHAR(255) DEFAULT NULL, CHANGE NameEN NameEN VARCHAR(255) DEFAULT NULL, CHANGE visible Visible INT DEFAULT 1 NOT NULL, CHANGE image Image VARCHAR(255) DEFAULT NULL, CHANGE MenuOrder MenuOrder INT DEFAULT 0 NOT NULL, CHANGE ImageTitle ImageTitle VARCHAR(255) DEFAULT NULL, CHANGE ShowBy ShowBy INT DEFAULT 0 NOT NULL, CHANGE text Text TEXT NOT NULL, CHANGE PageTitle PageTitle TEXT NOT NULL, CHANGE seo_uri seo_uri VARCHAR(50) DEFAULT NULL, CHANGE keywords keywords TEXT DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE TripColors ADD ColorName VARCHAR(255) DEFAULT \'\' NOT NULL, ADD ColorNameEN VARCHAR(255) DEFAULT \'\' NOT NULL, DROP name, DROP NameEN');
        $this->addSql('DROP INDEX UNIQ_D54DF107AA08CB10 ON TripCustomers');
        $this->addSql('ALTER TABLE TripCustomers CHANGE login Login VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE pass Pass VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE FName FName VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE SName SName VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE LName LName VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE email Email VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE phone Phone VARCHAR(255) DEFAULT NULL, CHANGE country Country VARCHAR(255) DEFAULT NULL, CHANGE city City VARCHAR(255) DEFAULT NULL, CHANGE postalcode Postalcode VARCHAR(6) DEFAULT \'123456\', CHANGE address Address VARCHAR(255) DEFAULT NULL, CHANGE is_verified is_verified TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE TripDesignes DROP FOREIGN KEY FK_6744F3B3E8042869');
        $this->addSql('DROP INDEX IDX_6744F3B3E8042869 ON TripDesignes');
        $this->addSql('ALTER TABLE TripDesignes CHANGE DesignName DesignName VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE DesignNameEN DesignNameEN VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE ImageLO ImageLO VARCHAR(255) DEFAULT NULL, CHANGE visible Visible INT DEFAULT 1 NOT NULL, CHANGE CategoryID CategoryID INT DEFAULT NULL, CHANGE DBDate DBDate DATETIME DEFAULT NULL, CHANGE sort sort INT DEFAULT 0 NOT NULL, CHANGE text Text TEXT NOT NULL, CHANGE search Search TINYINT(1) DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE TripNews CHANGE title Title VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE TitleEN TitleEN VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE display_ru display_ru TINYINT(1) DEFAULT 1 NOT NULL, CHANGE display_en display_en TINYINT(1) DEFAULT 1 NOT NULL, CHANGE NewsDate NewsDate DATE DEFAULT NULL, CHANGE ImageLO ImageLO VARCHAR(255) DEFAULT NULL, CHANGE ImageHI ImageHI VARCHAR(255) DEFAULT NULL, CHANGE content Content TEXT DEFAULT NULL, CHANGE ContentEN ContentEN TEXT DEFAULT NULL, CHANGE link Link VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE SizeX SizeX INT DEFAULT 0 NOT NULL, CHANGE SizeY SizeY INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE TripOrderDetails DROP FOREIGN KEY FK_22B570B1EF06D63');
        $this->addSql('ALTER TABLE TripOrderDetails DROP FOREIGN KEY FK_22B570B18FE6346E');
        $this->addSql('ALTER TABLE TripOrderDetails DROP FOREIGN KEY FK_22B570B1B56EF630');
        $this->addSql('DROP INDEX IDX_22B570B1EF06D63 ON TripOrderDetails');
        $this->addSql('DROP INDEX IDX_22B570B18FE6346E ON TripOrderDetails');
        $this->addSql('DROP INDEX IDX_22B570B1B56EF630 ON TripOrderDetails');
        $this->addSql('ALTER TABLE TripOrderDetails CHANGE OrderID OrderID INT DEFAULT NULL, CHANGE SizeID SizeID INT DEFAULT NULL, CHANGE ProductDesc ProductDesc VARCHAR(255) DEFAULT NULL, CHANGE ProductPrice ProductPrice DOUBLE PRECISION DEFAULT NULL, CHANGE quantity Quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE TripOrders DROP FOREIGN KEY FK_FDAD97D7854CF4BD');
        $this->addSql('DROP INDEX IDX_FDAD97D7854CF4BD ON TripOrders');
        $this->addSql('ALTER TABLE TripOrders CHANGE CustomerID CustomerID INT DEFAULT NULL, CHANGE OrderStatus OrderStatus INT DEFAULT NULL, CHANGE OrderDate OrderDate DATETIME DEFAULT NULL, CHANGE TotalPrice TotalPrice DOUBLE PRECISION DEFAULT NULL, CHANGE TotalQuantity TotalQuantity INT DEFAULT NULL, CHANGE ShipCountry ShipCountry VARCHAR(255) DEFAULT NULL, CHANGE ShipCity ShipCity VARCHAR(255) DEFAULT NULL, CHANGE ShipPostalcode ShipPostalcode VARCHAR(6) DEFAULT NULL, CHANGE ShipAddress ShipAddress TEXT DEFAULT NULL, CHANGE ShipDate ShipDate DATE DEFAULT NULL, CHANGE comments Comments TEXT DEFAULT NULL, CHANGE currency Currency VARCHAR(10) DEFAULT NULL, CHANGE ShipMetro ShipMetro VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE TripPages CHANGE title Title VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE TitleEN TitleEN VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE visible Visible INT DEFAULT 1 NOT NULL, CHANGE content Content TEXT DEFAULT NULL, CHANGE ContentEN ContentEN TEXT DEFAULT NULL, CHANGE keywords keywords TEXT DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE TripProducts DROP FOREIGN KEY FK_10594724A736B16E');
        $this->addSql('ALTER TABLE TripProducts DROP FOREIGN KEY FK_10594724BC5D423A');
        $this->addSql('ALTER TABLE TripProducts DROP FOREIGN KEY FK_10594724E8042869');
        $this->addSql('DROP INDEX IDX_10594724A736B16E ON TripProducts');
        $this->addSql('DROP INDEX IDX_10594724BC5D423A ON TripProducts');
        $this->addSql('DROP INDEX IDX_10594724E8042869 ON TripProducts');
        $this->addSql('ALTER TABLE TripProducts CHANGE CategoryID CategoryID INT DEFAULT NULL, CHANGE DBDate DBDate DATETIME DEFAULT NULL, CHANGE name Name VARCHAR(255) DEFAULT NULL, CHANGE NameEN NameEN VARCHAR(255) DEFAULT NULL, CHANGE display_ru display_ru TINYINT(1) DEFAULT 1 NOT NULL, CHANGE display_en display_en TINYINT(1) DEFAULT 1 NOT NULL, CHANGE visible Visible INT DEFAULT 1 NOT NULL, CHANGE marked Marked INT DEFAULT 0 NOT NULL, CHANGE MarkedTime MarkedTime DATETIME DEFAULT NULL, CHANGE description Description TEXT DEFAULT NULL, CHANGE DescriptionEN DescriptionEN TEXT DEFAULT NULL, CHANGE ImageLO ImageLO VARCHAR(255) DEFAULT NULL, CHANGE ImageHI ImageHI VARCHAR(255) DEFAULT NULL, CHANGE ImageFL ImageFL VARCHAR(255) DEFAULT NULL, CHANGE ImageHB ImageHB VARCHAR(255) DEFAULT NULL, CHANGE ImageFB ImageFB VARCHAR(255) DEFAULT NULL, CHANGE price Price INT DEFAULT 0 NOT NULL, CHANGE PriceEN PriceEN INT DEFAULT 0 NOT NULL, CHANGE articul Articul VARCHAR(255) DEFAULT NULL, CHANGE TypeID TypeID INT DEFAULT NULL, CHANGE DesignID DesignID INT DEFAULT NULL, CHANGE sale Sale VARCHAR(1) DEFAULT NULL, CHANGE search Search TINYINT(1) DEFAULT 1 NOT NULL, CHANGE keywords keywords TEXT DEFAULT NULL, CHANGE meta_description meta_description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE TripSizes ADD display TINYINT(1) DEFAULT 1 NOT NULL, CHANGE SizeName SizeName VARCHAR(255) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE TripTypes CHANGE TypeName TypeName VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE TypeNameEN TypeNameEN VARCHAR(255) DEFAULT \'\' NOT NULL, CHANGE visible Visible INT DEFAULT 1 NOT NULL, CHANGE MenuOrder MenuOrder INT DEFAULT 0 NOT NULL, CHANGE text Text TEXT DEFAULT NULL, CHANGE SexID SexID TINYINT(1) NOT NULL, CHANGE seo_title seo_title VARCHAR(255) DEFAULT NULL, CHANGE text2 Text2 TEXT DEFAULT NULL, CHANGE seo_uri seo_uri VARCHAR(50) DEFAULT NULL');
    }
}
