# Specifikace

## ER diagram

```
@startuml
' hide the spot
hide circle

' avoid problems with angled crows feet
skinparam linetype ortho

entity "Score" as e01 {
  *id_score : int <<generované>>
  --
  nick : text
  score : int
}

entity "Admin" as e02 {
  *id_uzivatel : int <<generované>>
  --
  username : text
  password : text <<hash>>
}
@enduml

'http://www.plantuml.com/plantuml/uml/VOr1IeD138NtSuhGZI0KrAMKKi_W0IJEn4xeJ6P8yl-_LNeWp-757ALOLsu2x-Mzx-tCKNsg9Ln1vaJWcS1wy_2Z8cii5COJvyO9khRdGjLWOS-0iY-K86fR35w8FDY1fQDYXS92Vkm4JJst44YS_GYhnzYKLe06T7CBxm7WcjEJVRjm3omEcysUXBJDA9yVs-r8hDVZ2CV3I3Yz-b1_2k5qeJ-aodAct_tIfpUUqQdyFp0PgM2boqX7iwLfEZkZcD7oQ9p2ZYHDjNm1
```

## Charakteristika funkčností aplikace

Jedná se o hru v javascriptu a backend v php na zpracování skóre.

## Role a oprávnění

Aplikace bude obsahovat tyto role:

### Hráč

Bude mít pouze možnost vložit nick a po odehrané hře se jeho skóre uloží do databáze.

### Admin

Má možnost editovat/smazat skóre.

## Rozhraní a jeho funkce

Stránka na které bude velký div pro hrací plochu. V horní části bude navigační tlačítko a start hry.
Dále tam bude aktuální score, zbývající čas a zvolená přezdívka hráče.

+ Stránka pro aktuální skóre.
+ Stránka pro správu skóre.
+ API endpoint, který bude vracet nejvyšší skóre.
+ Endpoint na uložení skóre.

