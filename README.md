# Muzicka skola

Projekat vodjenja evidencije polaznika muzicke skole i njihovih profesora.

## Uvod

Kursevi se drze po instrumentima. Svaki kurs se radi po jednom instrumentu, i predaje ga jedan profesor.

Ucenici se prilikom upisa u skolu opredeljuju za kurseve koje zele da pohadjaju. Nakon upisa, moguce je menjati kurseve. Takodje, ucenici se mogu ispisati iz skole.

Profesori mogu drzati vise kurseva.

## Funkcionalnosti

Projekat se pokrece sa predefinisanom listom dostupnih instrumenata.

Funkcionalnosti koje je moguce koristiti putem web interfejsa:
* [PHP.OO, select] Izlistavanje svih ucenika
* [form] Dodavanje kursa (jedan instrument jedan profesor)
* [PHP.OO, form, PHP.date] Dodavanje ucenika i upis na zeljene kurseve
* [PHP.$_DELETE] Ispisivanje ucenika iz skole

## Pokretanje programa

MySQL server mora biti pokrenut, i baza "muzickaskola" kreirana.

```sql
CREATE DATABASE muzickaskola;
```
