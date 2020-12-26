-- napravi tabelu kursevi
CREATE TABLE `kursevi` (
  id INT NOT NULL AUTO_INCREMENT,
  instrument_ime VARCHAR(40) NOT NULL,
  profesor_ime VARCHAR(120) NOT NULL,
  PRIMARY KEY (id)
);
INSERT INTO
  `kursevi` (id, instrument_ime, profesor_ime)
VALUES
  (1, 'Gitara', 'Jelisaveta Ostojic'),
  (2, 'Klavir', 'Veljko Trifunovic'),
  (3, 'Violina', 'Miona Petrovic'),
  (4, 'Bubnjevi', 'Goran Markovic'),
  (5, 'Flauta', 'Olga Petrov');
-- napravi tabelu ucenici
  CREATE TABLE `ucenici` (
    id INT NOT NULL AUTO_INCREMENT,
    ime VARCHAR(30) NOT NULL,
    prezime VARCHAR(40) NOT NULL,
    datum_rodjenja DATE NOT NULL,
    telefon VARCHAR(30) NULL,
    datum_upisa DATE NULL,
    PRIMARY KEY (id)
  );
INSERT INTO
  `ucenici` (
    id,
    ime,
    prezime,
    datum_rodjenja,
    telefon,
    datum_upisa
  )
VALUES
  (
    1,
    'Milos',
    'Bajagic',
    '2006-05-04',
    '064999666',
    '2020-07-06'
  ),
  (
    2,
    'Milica',
    'Jakovljevic',
    '1998-04-07',
    '063305904',
    '2020-04-01'
  ),
  (
    3,
    'Jana',
    'Djurdjevic',
    '1998-10-05',
    '0649517695',
    '2020-07-07'
  );
-- napravi vezu izmedju ucenika i kurseva
  CREATE TABLE `ucenici_kursevi` (
    u_id INT NOT NULL,
    k_id INT NOT NULL,
    datum_upisa DATE NULL,
    FOREIGN KEY (u_id) REFERENCES ucenici(id) ON DELETE CASCADE,
    FOREIGN KEY (k_id) REFERENCES kursevi(id) ON DELETE CASCADE,
    PRIMARY KEY (u_id, k_id)
  );
INSERT INTO
  `ucenici_kursevi`
VALUES
  (2, 3, '2020-04-01'),
  (1, 1, '2020-07-06'),
  (3, 4, '2020-07-07'),
  (2, 2, '2020-07-24');
