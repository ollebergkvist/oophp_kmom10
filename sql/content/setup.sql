--
-- Create the database with a test user
--
CREATE DATABASE IF NOT EXISTS oophp;

GRANT ALL ON oophp.* TO user @localhost IDENTIFIED BY "pass";

USE oophp;

-- Ensure UTF8 as chacrter encoding within connection.
SET
    NAMES utf8;

--
-- Create table for content
--
DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `path` CHAR(120) UNIQUE,
    `slug` CHAR(120) UNIQUE,
    `title` VARCHAR(120),
    `data` TEXT,
    `type` CHAR(20),
    `filter` VARCHAR(80) DEFAULT NULL,
    `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

--
-- Create table for products
--
DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `path` CHAR(120) UNIQUE,
    `slug` CHAR(120) UNIQUE,
    `title` VARCHAR(120),
    `article_number` INT (4) NOT NULL UNIQUE,
    `name` VARCHAR(100) NOT NULL,
    `category` TEXT,
    `short_description` TEXT,
    `long_description` TEXT,
    `amount` INT (3),
    `price` INT (6),
    `image` VARCHAR(100) DEFAULT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `activated` TIMESTAMP DEFAULT NULL,
    `deleted` TIMESTAMP DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

--
-- Create table for users
--
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `username` VARCHAR(320) PRIMARY KEY NOT NULL,
    `firstname` TEXT,
    `lastname` TEXT,
    `password` VARCHAR (16) NOT NULL,
    `email` VARCHAR(320),
    `rights` VARCHAR(5) DEFAULT "user",
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `activated` TIMESTAMP DEFAULT NULL,
    `deleted` TIMESTAMP DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

--
-- Clear table first
--
DELETE FROM
    `content`;

INSERT INTO
    `content` (
        `path`,
        `slug`,
        `type`,
        `title`,
        `data`,
        `filter`
    )
VALUES
    (
        "hem",
        NULL,
        "page",
        "Hem",
        "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter 'nl2br' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.",
        "bbcode,nl2br"
    ),
    (
        "om",
        NULL,
        "page",
        "Om",
        "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.",
        "markdown"
    ),
    (
        "blogpost-1",
        "valkommen-till-min-blogg",
        "post",
        "Välkommen till min blogg!",
        "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.",
        "link,nl2br"
    ),
    (
        "blogpost-2",
        "nu-har-sommaren-kommit",
        "post",
        "Nu har sommaren kommit",
        "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.",
        "nl2br"
    ),
    (
        "blogpost-3",
        "nu-har-hosten-kommit",
        "post",
        "Nu har hösten kommit",
        "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost",
        "nl2br"
    );

SELECT
    `id`,
    `path`,
    `slug`,
    `type`,
    `title`,
    `created`
FROM
    `content`;

--
-- Clear table first
--
DELETE FROM
    `products`;

--
-- Insert values into users
--
INSERT INTO
    `products` (
        `article_number`,
        `name`,
        `short_description`,
        `amount`,
        `price`,
        `category`
    )
VALUES
    (
        "001",
        'Apple Macbook Pro 13\"',
        "1,4 GHz fyrkärnig processor med Turbo Boost upp till 3,9 GHz\n128 GB lagring\nTouch Bar och Touch ID",
        "10",
        "16803",
        "laptop"
    ),
    (
        "002",
        'Apple Macbook Pro 16\"',
        "2,6 GHz sexkärnig processor\n512 GB lagring\nAMD Radeon Pro 5300M",
        "7",
        "29999",
        "laptop"
    ),
    (
        "003",
        'Apple iMac 21.5\"',
        "2,3 GHz dubbelkärnig processor med Turbo Boost upp till 3,6 GHz\n1 TB lagring",
        "9",
        "14071",
        "desktop"
    ),
    (
        "004",
        'Apple iMac Pro 27\"',
        "3,2 GHz åttakärnig Intel Xeon W-processor, Turbo Boost upp till 4,2 GHz",
        "13",
        "57075",
        "desktop"
    ),
    (
        "005",
        'Apple MacBook Air',
        "1,1 GHz dubbelkärnig Core i3-processor med Turbo Boost upp till 3,2 GHz\n256 GB lagring\nTouch I",
        "11",
        "12995",
        "desktop"
    ),
    (
        "006",
        'Apple Mac Pro',
        "3,5 GHz åttakärnig Intel Xeon W-processor, Turbo Boost upp till 4,0 GHz",
        "5",
        "71995",
        "desktop"
    ),
    (
        "007",
        'Apple Mac mini',
        "3,6 GHz fyrkärnig processor\n256 GB lagring",
        "3",
        "10495",
        "desktop"
    ),
    (
        "008",
        'Apple Pro Display XDR',
        "32 tum, Retina 6K. Enastående färgprecision. Enormt stor betraktningsvinkel. Och XDR (Extreme Dynamic Range).",
        "8",
        "59995",
        "display"
    ),
    (
        "009",
        'Apple iPad Air',
        "Med iPad Air får fler än någonsin tillgång till vår mest kraftfulla teknik. A12 Bionic-chippet med Neural Engine. 10,5‑tums Retina-skärm med True Tone. Stöd för Apple Pencil och Smart Keyboard. Knappt 470 gram och 6,1 mm. Ett kraftpaket du kan bära med dig överallt.",
        "13",
        "6298",
        "tablet"
    ),
    (
        "010",
        'Apple iPhone 11',
        "Ett helt nytt system med dubbla kameror. Vidga dina vyer från vidvinkel till ultravidvinkel. Det omgjorda gränssnittet använder den nya kameran med ultravidvinkel för att visa vad som händer utanför bild – och låter dig ta in det i bilden. Filma och redigera videor lika enkelt som du redigerar bilder. Det här är världens mest populära kamera – nu med helt nya perspektiv.",
        "14",
        "9195",
        "mobile"
    );

SELECT
    *
FROM
    `products`;

--
-- Clear table first
--
DELETE FROM
    `users`;

--
-- Insert values into users
--
INSERT INTO
    `users` (
        `username`,
        `password`,
        `firstname`,
        `lastname`,
        `email`,
        `rights`
    )
VALUES
    (
        "admin",
        "admin",
        "Foo",
        "Bar",
        "admin@gmail.com",
        "admin"
    ),
    (
        "john doe",
        "pass",
        "John",
        "Doe",
        "johndoe@gmail.com",
        "admin"
    ),
    (
        "jane doe",
        "pass",
        "Jane",
        "Doe",
        "janedoe@gmail.com",
        "admin"
    );

SELECT
    *
FROM
    `users`;