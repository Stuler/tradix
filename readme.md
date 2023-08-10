## TODO
### Admin module:



### Member module:
#### ACL 

## DB Migrace

### Změna v schématu db

1. po vytvoření změny v db (CREATE, UPDATE, ALTER tabulky) vygenerovat nebo skopírovat z admineru SQL dotaz
2. do příkazového řádku zadat:

- `./bin/console.php migrations:create structures add-*nazevTabulky*` - pro vytvoření nové tabulky
- `./bin/console.php migrations:create structures alter-*nazevTabulky*` - alter- pro vytvoření alteru, drop - pro drop, update- pro update atd

3. ve složce database/migrations/structures se vytvoří nový sql soubor s timestampom (např. 2022-03-10-102823-add-squad.sql)
    - do tohto souboru vložit vygenerovaný SQL kód z bodu 1

### Změna v datasetu

- používa se např. pro vytvoření číselníku s předem danýma hodnotama (země, měny, atd...), nebo pro vyplnění databáze smysluplnými datami pro vývoj a testování

1. vytvořit dataset a exportovat jeho SQL z admineru nebo napsat SQL ručně (INSERT, REMOVE, atd)
2. do příkazového řádku zadat:
   -`./bin/console.php migrations:create basic-data fill-*nazevTabulky*` - pro produkci -`./bin/console.php migrations:create dummy-data fill-*nazevTabulky*` - pro vývoj
3. ve složce database/migrations/dummy-data se vytvoří nový sql soubor s timestampom (např. 2022-03-10-104852-fill-squad.sql)
    - do tohto souboru vložit vygenerovaný SQL kód z bodu 1
4. migrace se provádí postupně podle timestampu v názvu, takže nikdy nevytvářet data závislé na jiné tabulce vopřed!!

### Spuštění migrací

`./bin/console.php migrations:reset `- NIKDY NA PRODUKCI!!! (bo bude velmi zle) - vytvorí sa v db tabulka 'migrations'
`./bin/console.php migrations:continue` - migrace, které doposud nebyly spušteny, se spustí

- Ak migrace zlyhá uprostřed, v tabulce migrations máme info, že neproběhla a kde skončila 

