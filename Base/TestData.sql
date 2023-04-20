INSERT INTO
    admin
VALUES
    (1, 'admin', 'admin', md5('admin'));

INSERT INTO
    TypeProduit(nom)
VALUES
    ('LEGUME');

INSERT INTO
    TypeProduit(nom)
VALUES
    ('FRUIT');

INSERT INTO
    TypeProduit(nom)
VALUES
    ('DIVERS');

INSERT INTO
    Saison(nom, moisdebut, moisfin)
VALUES
    ('HIVER', 6, 9);

INSERT INTO
    Saison(nom, moisdebut, moisfin)
VALUES
    ('PRINTEMPS', 9, 12);

INSERT INTO
    Saison(nom, moisdebut, moisfin)
VALUES
    ('ETE', 12, 3);

INSERT INTO
    Saison(nom, moisdebut, moisfin)
VALUES
    ('AUTOMNE', 3, 6);

INSERT INTO
    region(nom)
VALUES
    ('Analamanga'),
    ('Itasy'),
    ('Bongolava'),
    ('Vakinakaratra'),
    ('Haute Matsiatra'),
    ('Sofia'),
    ('Diana'),
    ('Sava'),
    ('Alaotra Mangoro'),
    ('Betsiboka'),
    ('Menabe'),
    ('Androy'),
    ('Ihorombe'),
    ('Amoron i Mania'),
    ('Vatovavy Fitovinanay'),
    ('Melaky'),
    ('Analajirofo'),
    ('Antsinanana'),
    ('Atsimo Antsinanana'),
    ('Atsimo Andrefana'),
    ('Anosy'),
    ('Boeny');

INSERT INTO SOCIETE VALUES
    (DEFAULT,'Materauto'),
    (DEFAULT,'HRF Madagascar'),
    (DEFAULT,'AfriBaba'),
    (DEFAULT,'MadaRentCar');
INSERT INTO TRANSPORT  VALUES
    (DEFAULT,'Camion KIA Bongo','0345678909',1,1,1),
    (DEFAULT,'Camion KIA Bongo','0340987645',1,2,20),
    (DEFAULT,'Camion KIA Bongo','0345678345',1,2,10);

INSERT INTO ContratTransport VALUES
    (1,50000,10,default,2,'2023-09-09'),
    (2,45000,10,default,1,'2023-09-09'),
    (3,60000,10,default,5,'2023-09-09');
