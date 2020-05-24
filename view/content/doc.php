<?php

namespace Anax\View;

/**
 * Template file to render doc view
 */

?>

<div class="container page">
    <h1>Kodstruktur</h1>
    <hr>
    <h4>Klass</h4>
    <p>Samtliga kontrollers använder sig utav klassen Content och dess metoder.
        Klassens syfte är att exekvera SQL frågor och hämta data från tabellerna i databasen,
        svaren mottages utav kontroller-klasserna som sedan renderar datan i de olika vyerna.
        <h4 class="mb-3">Kontrollers</h4>
        <h6>ContentController</h6>
        <ul>
            <li>GET eshop/</li>
            <p>Index sida för butiken, uppvisar featured blogginlägg, 3 senaste blogginläggen, featured brand,
                3 senaste produkterna samt en rea sektion som uppvisar produkter till nedsatt pris
            </p>
            <li>GET eshop/products</li>
            <p>Översiktsvy för alla produkter som tabell med kolumnerna: artikelnummer, produktnamn, kategori, beskrivning, bild, pris samt lagerantal
            </p>
            <li>GET eshop/blog</li>
            <p>Översiktsvy för alla blogginlägg med titel, publikationsdatum samt ingress
            </p>
            <li>GET eshop/blogpost/:id</li>
            <p>Visar individuellt blogginlägg med allt innehåll
            </p>
            <li>GET eshop/product/:id</li>
            <p>Visar individuell produkt med allt innehåll
            </p>
            <li>GET eshop/error</li>
            <p>Visar felmeddelande då användare försöker nå en route som ej finns
            </p>
            <li>GET eshop/login</li>
            <p>Formulär för att logga in</p>
            <li>POST eshop/login</li>
            <p>Hanterar formulärdata för inloggning</p>
            <li>GET eshop/logout</li>
            <p>Formulär för att logga ut</p>
            <li>POST eshop/logout</li>
            <p>Hanterar formulärdata för utloggning</p>
            <li>GET eshop/about</li>
            <p>About sida</p>
            <li>GET eshop/doc</li>
            <p>Dokumentation sida</p>
            <li>ANY eshop/register</li>
            <p>Formulär för att registrering utav användarkonto inklusive hantering utav formulärdata</p>
        </ul>
        <h6>AdminController</h6>
        <ul>
            <li>ANY admin/</li>
            <p>Översiktsvy för alla blogginlägg som tabell (ink. sökfunktion, paginering och sortering) samt länkar för att editera
                och radera inlägg
            </p>
            <li>ANY admin/products</li>
            <p>Översiktsvy för alla produkter som tabell (ink. sökfunktion, paginering och sortering) samt länkar för att editera
                och radera produkter
            </p>
            <li>ANY admin/users</li>
            <p>Översiktsvy för alla användarkonton som tabell (ink. sökfunktion, paginering och sortering) samt länkar för att editera
                och radera användarkonton
            </p>
            <li>GET admin/create/:id</li>
            <p>Formulär för att skapa blogginlägg</p>
            <li>POST admin/create</li>
            <p>Hanterar formulärdata för skapande utav blogginlägg</p>
            <li>GET admin/createproduct/:id</li>
            <p>Formulär för att skapa produkt</p>
            <li>POST admin/createproduct</li>
            <p>Hanterar formulärdata för skapande utav produkt</p>
            <li>GET admin/delete/:id</li>
            <p>Formulär för att radera blogginlägg</p>
            <li>POST admin/delete</li>
            <p>Hanterar formulärdata för radering utav blogginlägg</p>
            <li>GET admin/deleteproduct/:id</li>
            <p>Formulär för att radera produkt</p>
            <li>POST admin/deleteproduct</li>
            <p>Hanterar formulärdata för radering utav produkt</p>
            <li>GET admin/deleteuser/:id</li>
            <p>Formulär för att radera användarkonto</p>
            <li>POST admin/deleteuser</li>
            <p>Hanterar formulärdata för radering utav användarkonto</p>
            <li>GET admin/edit/:id</li>
            <p>Formulär för att editera blogginlägg</p>
            <li>POST admin/edit</li>
            <p>Hanterar formulärdata för editering utav blogginlägg</p>
            <li>GET admin/editproduct/:id</li>
            <p>Formulär för att editera produkt</p>
            <li>POST admin/editproduct</li>
            <p>Hanterar formulärdata för editering utav produkt</p>
            <li>GET admin/edituser/:id</li>
            <p>Formulär för att editera användarkonto</p>
            <li>POST admin/edituser</li>
            <p>Hanterar formulärdata för editering utav användarkonto</p>
            <li>GET admin/reset</li>
            <p>Submit knapp för att återställa databas</p>
            <li>POST admin/reset</li>
            <p>Hanterar formulärdata för återställning utav databas</p>
        </ul>
        <h6>UserController</h6>
        <ul>
            <li>GET /user</li>
            <p>Uppvisar användarkonto och dess uppgifter som formulär</p>
            <li>POST /user</li>
            <p>Hanterar formulärdata för editering utav användarkonto</p>
        </ul>
        <h3>Databas</h3>
        <hr>
        <h4>Tabeller</h4>
        <p>Databasen består utav 3 stycken tabeller: content, products samt users.</p>
        <p>Den förstnämnda tabellen används för att spara blogginlägg men vid vidareutveckling utav webbplatsen
            finns det även möjlighet att spara hela webbsidor här om kunden önskar att göra så i framtiden, detta genom att särskilja
            på pages och posts i kolumnen "type". Products innehåller
            butikens produktsortiment medan users används för att spara användarkonton med "admin" eller "user" rättigheter.
        </p>
        <p>Tabellerna är helt frikopplade från varandra, dvs. det finns inga relationer sinsemellan tabellerna</p>
        <h4>ER-diagram</h4>
        <img src="../img/er.png" alt="er-diagram">
        <h4>Testning</h4>
        <hr>
        <h4>Enhetstestning</h4>
        <p>Då det inte var obligatoriskt att enhetstesta, valde jag att prioritera min ambition att uppfyllai nte bara grundkraven men även de 3
            stycken additionella poänggivande momenten. Jag avsatte 7 dagar för detta slutprojekt precis som jag avsatte samma tidsbegränsning för slutprojektet
            i kursen webbapp, därmed hann jag tråkigt nog inte med att utföra några enhetstester denna gång. Utöver min tidsprioritering för detta projekt, så
            kan jag inte minnas att vi har gått igenom hur vi enhetstestar klasser som är beroende utav en databas, så jag är fundersam över hur jag
            skulle ha gått tillväga här om jag så hade önskat. Det går dock att köra kommandot "make phpunit" utan några problem.
        </p>
        <h4>Validering</h4>
        <p>
            Rörande validering utav projektet, så går det att köra kommandot "make test" och projektet validerar på alla punkter
            utan felmeddelande.
        </p>
        <h4>Dokumentation</h4>
        <p>
            Gällande att generera dokumentation med kommandot "make doc" (phpdoc), så fungerar det precis som tänkt.
            Jag har valt att ta bort .anax från .phpdoc.xml samt ignorera test klasser.
            Dokumentationen återfinns i katalogen "doc/api".
        </p>
</div>