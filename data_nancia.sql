--TypeProduit
INSERT INTO TypeProduit(nom)
VALUES
    ('Legume'),
    ('Fruit'),
    ('Legumineuse'),
    ('Ble');

--Mois
CREATE TABLE Mois(
    id SERIAL PRIMARY KEY,
    nom varchar(50),
    abreviation varchar(30)
);
INSERT INTO Mois(nom,abreviation)
VALUES
    ('Janvier','Jan'),
    ('Fevrier','Fev'),
    ('Mars','Mar'),
    ('Avril','Avr'),
    ('Mai','Mai'),
    ('Juin','Juin'),
    ('Juillet','Juil'),
    ('Aout','Aout'),
    ('Septembre','Sept'),
    ('Octobre','Oct'),
    ('Novembre','Nov'),
    ('Decembre','Dec');

--Produit
ALTER TABLE Produit DROP column Saisonid;
ALTER TABLE Produit ADD column debutSaison int REFERENCES Mois(id);
ALTER TABLE Produit ADD column finSaison int REFERENCES Mois(id);

INSERT INTO Produit(nom,TypeProduitid,debutSaison,finSaison,dureePeremption,modeConservation)
VALUES
    ('Carotte',1,3,7,90,' '),
    ('Pomme de terre',1,5,9,70,' '),
    ('Tomate',1,7,11,20,' '),
    ('Poirreau',1,2,5,40,' '),
    ('Citrouille',1,6,8,100,' '),
    ('Pomme',2,1,3,60,' '),
    ('Orange',2,7,8,40,' '),
    ('Avocat',2,4,7,80,' '),
    ('Letchis',2,8,12,70,' '),
    ('Haricot',3,3,9,300,' '),
    ('Riz',4,5,8,250,' '),
    ('Mais',4,3,6,200,' ');

--Collecteur
INSERT INTO Collecteur(nom,mdp,login,contact)
VALUES
    ('Rakoto',md5('1234'),'rakoto','0346574735'),
    ('Rabe',md5('1234'),'rabe','0347462464'),
    ('Randria',md5('1234'),'randria','0340496305');

--Region
INSERT INTO Region(nom)
VALUES
    ('Analamanga'),
    ('Vakinankaratra'),
    ('Amoron i Mania'),
    ('Melaky'),
    ('Betsiboka'),
    ('Sofia');

--PointCollect
INSERT INTO PointCollect(latitude,longitude,Regionid)
VALUES
    ('10234.45','293.49',1),
    ('10359.03','246.63',2),
    ('10362.57','252.46',2),
    ('11034.11','340.93',3),
    ('10892.25','263.42',4),
    ('11683.26','251.63',5),
    ('11014.28','251.53',6);
    ('11014.28','251.53',9);

--Collect
INSERT INTO Collect(quantite,date,prixUnitaire,ProduitId,PointCollectid,Collecteurid)
VALUES
    (400,'2023-01-24',1700,6,8,1),
    (200,'2023-01-24',1640,6,8,1),
    (600,'2023-01-24',1800,6,8,1),
    (180,'2023-01-24',2000,6,9,1),
    (650,'2023-01-24',1550,6,9,1),
    (900,'2023-02-24',2700,4,9,1),
    (200,'2023-02-24',2400,4,9,1),
    (220,'2023-02-24',3200,6,10,2),
    (700,'2023-02-24',1900,6,10,2),
    (190,'2023-02-24',2200,4,10,2),
    (400,'2023-03-24',2620,1,10,2),
    (450,'2023-03-24',1390,10,11,2),
    (175,'2023-03-24',3050,12,11,2),
    (250,'2023-04-24',2800,5,11,2),
    (290,'2023-04-24',1300,5,11,2),
    (300,'2023-04-24',1500,1,11,3),
    (320,'2023-04-24',1840,12,12,3),
    (850,'2023-05-24',1290,8,12,3),
    (680,'2023-05-24',2050,2,12,3),
    (375,'2023-06-24',1800,11,12,3),
    (400,'2023-06-24',2000,11,13,3),
    (200,'2023-06-24',2100,11,13,3),
    (600,'2023-07-24',1870,3,13,1),
    (180,'2023-07-24',1590,3,13,1),
    (650,'2023-07-24',2830,7,14,1),
    (900,'2023-07-24',3500,3,14,1),
    (200,'2023-07-24',4250,7,14,1),
    (220,'2023-08-24',3010,9,14,1),
    (700,'2023-08-24',3170,9,14,2),
    (190,'2023-08-24',4600,9,14,2),
    (400,'2023-09-24',2400,2,8,2),
    (450,'2023-09-24',3100,2,8,2),
    (175,'2023-10-24',1300,9,9,2),
    (250,'2023-10-24',2700,9,11,2),
    (290,'2023-10-24',1600,9,9,3),
    (300,'2023-11-24',2100,3,9,3),
    (320,'2023-11-24',2500,3,11,3),
    (1000,'2023-12-24',1500,9,10,3),
    (680,'2023-12-24',2150,9,10,3),
    (375,'2023-12-24',2000,9,12,3);

