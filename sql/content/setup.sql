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
    `image` VARCHAR(100) DEFAULT NULL,
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
    `article_number` INT (4) UNIQUE,
    `name` VARCHAR(100),
    `category` TEXT,
    `short_description` TEXT,
    `long_description` TEXT,
    `amount` INT (3),
    `price` VARCHAR (12),
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
        `image`,
        `filter`
    )
VALUES
    (
        "blogpost-1",
        "prada",
        "post",
        "Prada",
        "More arrivals from Prada including jackets, shirts, accessories and a pair of sneakers made in calf leather now online.",
        "img/1.jpg",
        "markdown,nl2br"
    ),
    (
        "blogpost-2",
        "acne-studios-face-collection",
        "post",
        "Acne Studios Face collection",
        "Hoodies and sweatshirts from the Acne Studios Spring / Summer 2020 Face collection now available online.",
        "img/2.jpg",
        "markdown,nl2br"
    ),
    (
        "blogpost-3",
        "comme-des-garcons-homme-plus",
        "post",
        "Comme des Garcons Homme Plus",
        "More items from CDG Homme Plus, including a jacket, blazer and shorts featuring contrasting faux-fur applique panels throughout, now online.",
        "img/3.jpg",
        "markdown,nl2br"
    ),
    (
        "blogpost-4",
        "new-balance-m990v5",
        "post",
        "New Balance M990V5",
        "The New Balance M990V5 sneakers in a light grey colorway now available online.",
        "img/4.jpg",
        "markdown,nl2br"
    ),
    (
        "blogpost-5",
        "stone-island",
        "post",
        "Stone Island",
        "New delivery from Stone Island including a hooded sweatshirt, a half-zip overshirt and a nylon seersucker suit now online.",
        "img/5.jpg",
        "markdown,nl2br"
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
-- Insert values into products
--
INSERT INTO
    `products` (
        `article_number`,
        `name`,
        `short_description`,
        `amount`,
        `price`,
        `category`,
        `image`
    )
VALUES
    (
        "001",
        'NIKE ACG MOC 3.0 GREEN STRIKE / VIVID PURPLE',
        "Sneakers from Nike ACG. Tie dyed and quilted textile upper in a wrapped sock like construction. Rubber toe tip and outsole with a sticky finish for good grip.",
        "10",
        "1000 SEK",
        "shoes",
        "img/6.jpg"
    ),
    (
        "002",
        'COMMON PROJECTS ORIGINAL ACHILLES LOW SNEAKERS BLACK',
        "Sneakers from Common Projects. Low top leather upper with tonal top stitches and signature gold toned serial number printed on the lateral side. Features a tonal rubber midsole.",
        "7",
        "3700 SEK",
        "shoes",
        "img/7.jpg"
    ),
    (
        "003",
        'COMME DES GARÇONS PLAY X CONVERSE CHUCK TAYLOR 70 BIG HEART LOW BLACK',
        "Sneakers from Comme des Garçons Play made in collaboration with Converse. Canvas upper with a contrasting rubber toe cap and midsole. Heart print on the outer side and two metal eyelets on the inner side. Flat laces through metal eyelets. Contrasting top stitching throughout.",
        "9",
        "1500 SEK",
        "shoes",
        "img/8.jpg"
    ),
    (
        "004",
        'CAV EMPT WAVE STRIPE ZIP JACKET KHAKI',
        "Jacket from Cav Empt. Made from a cotton and nylon blend with contrasting wave stripes throughout. Features a spread collar, front zip closure and a single chest pocket. Cotton patch on the back and a rubber logo patch is placed on the left sleeve. Back yoke with twin pleats. Straight hem and straight cuffs.",
        "3",
        "6300 SEK",
        "jackets",
        "img/9.jpg"
    ),
    (
        "005",
        'COMME DES GARÇONS HOMME PLUS COATED PRINTED PANEL COACH JACKET BLACK',
        "Coach jacket from Comme des Garçons Homme Plus. Made from a coated rayon and cotton blend with contrasting faux-fur applique panels throughout. Features a spread collar, full snap-button front closure and two slanted pockets on the front. Oversized printed logo on the back. Straight cuffs and a straight hem with drawstrings for an adjustable fit.",
        "4",
        "13800 SEK",
        "jackets",
        "img/10.jpg"
    ),
    (
        "006",
        'UNDERCOVER CINDY SHERMAN DOUBLE BREASTED WOOL PATCH BLAZER BLACK',
        "Blazer from Undercover made from wool with a contrasting portrait patch on the back. Features darted front with button closure, peaked lapels, a single chest pocket and two front patch pockets. Fully lined and features two inner pockets. Buttoned cuffs and straight hem with double vents at the back.",
        "2",
        "12000 SEK",
        "jackets",
        "img/11.jpg"
    ),
    (
        "007",
        'COMME DES GARÇONS PLAY SMALL HEART LS T-SHIRT STRIPE GREEN',
        "T-shirt from Comme des Garçons Play. Made from a striped cotton fabric. Ribbed round-neck. Small sewn-on logo patch on the chest. Long sleeves and a straight hem.",
        "3",
        "1300 SEK",
        "t-shirts",
        "img/12.jpg"
    ),
    (
        "008",
        'NIKE ACG VORTEX T-SHIRT SUMMIT WHITE',
        "T-shirt from Nike ACG. Made from cotton jersey with a ribbed crew neck and short sleeves. Large vortex logo print on the back and customary ’ACG’ triangle logo print on the chest.",
        "4",
        "450 SEK",
        "t-shirts",
        "img/13.jpg"
    ),
    (
        "009",
        'ARIES NO PROBLEMO T-SHIRT BLACK',
        "T-shirt from Aries. Features a ribbed crew neck, short sleeves and a contrasting chest print.",
        "4",
        "800 SEK",
        "t-shirts",
        "img/14.jpg"
    ),
    (
        "010",
        'SUN BUDDIES AKIRA SUNGLASSES TRANSPARENT GREY',
        "Sunglasses from Sun Buddies. Semi transparent vintage inspired frame in a grey colorway, handmade of Italian acetate. Black Carl Zeiss lenses with 100% UV protection and a seven bar hinge with two visible rivets on the temple. Comes in a sliding paperboard box and an orange faux leather case.",
        "5",
        "1300 SEK",
        "eyewear",
        "img/15.jpg"
    ),
    (
        "011",
        'SUN BUDDIES ZINEDINE SUNGLASSES TORTOISE',
        "Sunglasses from Sun Buddies. Original tortoise patterned vintage inspired biblio frame in brown and yellow. Handmade of Italian acetate. Brown Carl Zeiss lenses with 100% UV protection and a five bar hinge with two visible rivets on temple. Comes in a sliding paperboard box and faux leather case in orange. Cleaning cloth included.",
        "4",
        "1400 SEK",
        "eyewear",
        "img/16.jpg"
    ),
    (
        "012",
        'SUN BUDDIES OZZY SUNGLASSES SILVER / DARK BLUE',
        "Sunglasses from Sun Buddies. Round 70’s inspired metal frame in a silver colorway with blue colored temple tips, handmade of stainless steel and Italian acetate. Blue Carl Zeiss lenses with 100% UV protection and a three bar hinge with vintage inspired details on the temple. Comes in a sliding paperboard box and an orange faux leather case.",
        "3",
        "1500 SEK",
        "eyewear",
        "img/17.jpg"
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
        "johndoe",
        "pass",
        "John",
        "Doe",
        "johndoe@gmail.com",
        "user"
    ),
    (
        "janedoe",
        "pass",
        "Jane",
        "Doe",
        "janedoe@gmail.com",
        "user"
    );

SELECT
    *
FROM
    `users`;