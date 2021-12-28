# Technická specifikace

## Datový logický model

viz soubor model.mwb

## Popis architektury

### Třídy

#### Admin

+ Nastav/změn heslo setPassword(String password)
+ Ověř heslo isPasswordValid(String password)

#### Score
+ Přidat skóre addScore(int score)
+ Odebrat skóre deleteScore(int id)
+ Zobraz skóre getScore(int limit)

### Technologie

+ Použiji MySQL k uložení dat.
+ Pro zpracování požadavků použiji PHP.
+ Pro zobrazení a interakci s uživatelem HTML5 + JavaScript s frameworkem Bootstrap + CSS.

#### Stránka score

+ Výpis hodnot
+ Pro přihlášeného administrátora možnost odebrat scóre

#### Stránka změna hesla

+ Pro přihlášeného administrátora nabídne změnu hesla.

#### Hra

+ Hrací pole
+ Uloží nick z předchozí hry k uživateli do jeho prohlížeče
+ Odešle po skončení hry scóre
+ Bude zobrazovat historicky nejvyšší skóre
