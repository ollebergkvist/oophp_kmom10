<?php

namespace Anax\View;

/**
 * Template file to render doc view
 */

?>

<div class="container page">
    <h3>Kodstruktur</h3>
    <p>
        Kodstruktur för webbplatsen. Jag har gjort tre olika klasser som styr webbplatsens innehåll: Products, Blog, User och Index.
    </p>
    <h2>Klasser och kontrollers</h2>

    <h3>Products</h3>
    <p>
        Till routen "/products" har jag klassen Products och kontrollern ProductsController. Klassen ställer sql-frågorna till databasen, tar hand om svaret och skickar vidare till kontrollern som sedan renderar det i en vy. I kontrollern har jag route-pather för products/index, products/item, products/edit, products/create, products/reset, products/delete, products/search.
    </p>
    <h3>Content</h3>
    <p>
        Till routen "/blog" har jag klassen Blog och kontrollern BlogController. Klassen sköter kontakten med databasen och kontrollern lägger till och renderar vyerna med innehållet från databasen. I kontrollern har jag route-pather för blog/index, blog/edit, blog/create, blog/reset, blog/delete, blog/restore, blog/admin, blog/post, blog/search.
    </p>
    <h3>User</h3>
    <p>
        Till routen "/user" har jag klassen User och kontrollern UserController. Klassen pratar med databasen, kollar bland annat om användarnamnet och lösernordet finns i databasen vid inloggning. Kontrollern renderar vyerna för att logga in, registrera ny användare, ändra användaruppgifter. Jag har lagt till route-pather för följande: user/login, user/currentUser, user/logout, user/save, user/register, user/edit, user/search, user/delete.
    </p>
    <h3>Index</h3>
    <p>
        Jag har valt att själv styra vad som skall visas under index, och väljer därför att inte använda ramverkets FileBasedContentController. Detta för att jag själv vill välja vad som skall visas på start-sidan. Jag har klassen Index som hämtar innehållet från databasen som skall visas på förstasidan. Kontrollern IndexController styr sedan vad som skall renderas. Förutom index finns även router för: /om och /doc (denna sida).
    </p>
    <h2>Klassdiagram</h2>

    <h3>Databas</h3>
    <p>
        Jag valde att göra tre tabeller som styr sidans innehåll. En tabell för produkterna, en tabell för blogginläggen och en tabell för användarna. Tabellerna har ingen relation till varandra, jag ansåg inte att det behövdes göra något avancerat. Det räckte med dessa tre tabeller för att spara den data som krävdes.
    </p>
    <p>
        Här under ser ni ett ER-diagram över mina tabeller.
    </p>

    <h3>Testning</h3>
    <p>
        Det går att köra make phpunit. Dock så kräver mina klasser att det skickas in en databas som argument. Vi har inte gått igenom hur man skall enhetstesta klasser som är beroende av databasen, så jag vet faktiskt inte hur jag skall gå tillväga. Jag lyckades testa två metoder i min IndexController som inte är beroende av databasen, så det är dem enda metoderna som testas.
    </p>
</div>