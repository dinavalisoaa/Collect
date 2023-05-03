CREATE TABLE Admin (id SERIAL NOT NULL, nom int4, login int4, mdp int4, PRIMARY KEY (id));
CREATE TABLE Charge (id SERIAL NOT NULL, montant float8, "date" date, TypeChargeid int4 NOT NULL, Collectid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE Collect (id SERIAL NOT NULL, quantite int4, "date" date, prixUnitaire float8, Pro9duitid int4 NOT NULL, PointCollectid int4 NOT NULL, Collecteurid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE Collecteur (id SERIAL NOT NULL, nom varchar(255), mdp varchar(255), login varchar(255), contact varchar(255), PRIMARY KEY (id));
CREATE TABLE ContratTransport (Transportid int4 NOT NULL, montant float8, etatPaiement int4, id SERIAL NOT NULL, PlanningCollecteid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE Engard (id SERIAL NOT NULL, nom varchar(255), latitude float8, longitude float8, Regionid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE EtatStock (id SERIAL NOT NULL, Produitid int4 NOT NULL, quantite int4, PRIMARY KEY (id));
CREATE TABLE MouvementStock (id SERIAL NOT NULL, prixUnitaire float8, quantite int4, "date" date, TypeStockid int4 NOT NULL, Produitid int4 NOT NULL, Engardid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE MouvementTransport (id SERIAL NOT NULL, montant float8, "date" date, Transportid int4 NOT NULL, PlanningCollecteid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE PlanningCollecte (id SERIAL NOT NULL, tonnage float8, dateDelai date, budget float8, PRIMARY KEY (id));
CREATE TABLE PointCollect (id SERIAL NOT NULL, latitude float8, longitude float8, Regionid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE Produit (id SERIAL NOT NULL, nom varchar(255), TypeProduitid int4 NOT NULL, Saisonid int4 NOT NULL, dureePeremption float8, modeConservation varchar(255), PRIMARY KEY (id));
CREATE TABLE Region (id SERIAL NOT NULL, nom varchar(255), PRIMARY KEY (id));
CREATE TABLE Saison (id SERIAL NOT NULL, nom varchar(255), moisdebut int4, moisfin int4, PRIMARY KEY (id));
CREATE TABLE Transport (id SERIAL NOT NULL, nom varchar(255), contact varchar(255), Transportid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE TypeCharge (id SERIAL NOT NULL, nom varchar(255), PRIMARY KEY (id));
CREATE TABLE TypeProduit (id SERIAL NOT NULL, nom varchar(255), PRIMARY KEY (id));
CREATE TABLE TypeStock (id SERIAL NOT NULL, nom varchar(255), PRIMARY KEY (id));
ALTER TABLE Produit ADD CONSTRAINT FKProduit46594 FOREIGN KEY (TypeProduitid) REFERENCES TypeProduit (id);
ALTER TABLE Produit ADD CONSTRAINT FKProduit822622 FOREIGN KEY (Saisonid) REFERENCES Saison (id);
ALTER TABLE PointCollect ADD CONSTRAINT FKPointColle984070 FOREIGN KEY (Regionid) REFERENCES Region (id);
ALTER TABLE Engard ADD CONSTRAINT FKEngard455257 FOREIGN KEY (Regionid) REFERENCES Region (id);
ALTER TABLE ContratTransport ADD CONSTRAINT FKContratTra317848 FOREIGN KEY (Transportid) REFERENCES Transport (id);
ALTER TABLE MouvementTransport ADD CONSTRAINT FKMouvementT978222 FOREIGN KEY (Transportid) REFERENCES Transport (id);
ALTER TABLE MouvementStock ADD CONSTRAINT FKMouvementS712717 FOREIGN KEY (TypeStockid) REFERENCES TypeStock (id);
ALTER TABLE MouvementStock ADD CONSTRAINT FKMouvementS647708 FOREIGN KEY (Produitid) REFERENCES Produit (id);
ALTER TABLE EtatStock ADD CONSTRAINT FKEtatStock474316 FOREIGN KEY (Produitid) REFERENCES Produit (id);
ALTER TABLE Collect ADD CONSTRAINT FKCollect631300 FOREIGN KEY (Produitid) REFERENCES Produit (id);
ALTER TABLE Collect ADD CONSTRAINT FKCollect819440 FOREIGN KEY (PointCollectid) REFERENCES PointCollect (id);
ALTER TABLE Collect ADD CONSTRAINT FKCollect168864 FOREIGN KEY (Collecteurid) REFERENCES Collecteur (id);
ALTER TABLE Charge ADD CONSTRAINT FKCharge374352 FOREIGN KEY (TypeChargeid) REFERENCES TypeCharge (id);
ALTER TABLE Charge ADD CONSTRAINT FKCharge172009 FOREIGN KEY (Collectid) REFERENCES Collect (id);
ALTER TABLE MouvementStock ADD CONSTRAINT FKMouvementS182631 FOREIGN KEY (Engardid) REFERENCES Engard (id);
ALTER TABLE ContratTransport ADD CONSTRAINT FKContratTra519951 FOREIGN KEY (PlanningCollecteid) REFERENCES PlanningCollecte (id);
ALTER TABLE MouvementTransport ADD CONSTRAINT FKMouvementT791264 FOREIGN KEY (PlanningCollecteid) REFERENCES PlanningCollecte (id);


alter TABLE Collecteur  add column photo varchar;
alter TABLE PlanningCollecte  add column ProduitId int;
alter TABLE PlanningCollecte  add FOREIGN KEY (ProduitId) REFERENCES Produit(Id);

 alter table pointcollect add column nom varchar;

insert into admin values(1,'admin','admin',md5('admin'));
insert into TypeProduit(nom) values('LEGUME');
insert into TypeProduit(nom) values('FRUIT');
insert into TypeProduit(nom) values('DIVERS');


insert into Saison(nom,moisdebut,moisfin) values('HIVER',6,9);
insert into Saison(nom,moisdebut,moisfin) values('PRINTEMPS',9,12);
insert into Saison(nom,moisdebut,moisfin) values('ETE',12,3);
insert into Saison(nom,moisdebut,moisfin) values('AUTOMNE',3,6);

insert into region(nom)values('Analamanga'),('Itasy'),('Bongolava'),('Vakinakaratra'),('Haute Matsiatra'),
('Sofia'),('Diana'),('Sava'),('Alaotra Mangoro'),('Betsiboka'),('Menabe'),('Androy'),('Ihorombe'),('Amoron i Mania'),('Vatovavy Fitovinanay'),('Melaky'),('Analajirofo'),('Antsinanana'),('Atsimo Antsinanana'),('Atsimo Andrefana'),('Anosy'),('Boeny');

--Nouveaux
CREATE TABLE Client(
    id SERIAL PRIMARY KEY,
    nom varchar(200),
    adresse varchar(255),
    email varchar(255),
    telephone varchar(100)
);

INSERT INTO Client(nom,adresse,email,telephone)
VALUES
    ('Super-market','Iavoloha','super-market@gmail.com','038 93 492 49'),
    ('Tsara Varotra','Anosibe','tsara.varotra@gmail.com','032 49 949 22'),
    ('Chez Rajao','Behenjy','rajaogilbert@gmail.com','034 02 529 48'),
    ('Razafy Antoine','Ambatofotsy','antoinera@gmail.com','034 02 938 92');

CREATE TABLE Commande(
    id SERIAL PRIMARY KEY,
    date date,
    Clientid int,
    FOREIGN KEY (Clientid) REFERENCES Client(id)
);

INSERT INTO Commande(date,Clientid)
VALUES
    ('2023-01-19',1),
    ('2023-02-04',1),
    ('2023-04-14',1),
    ('2023-09-23',1),
    ('2023-03-24',2),
    ('2023-05-13',2),
    ('2023-10-02',2),
    ('2023-06-29',3),
    ('2023-07-06',3),
    ('2023-11-27',3),
    ('2023-12-16',3),
    ('2023-08-12',4);

CREATE TABLE DetailCommande(
    id SERIAL PRIMARY KEY,
    Commandeid int,
    Produitid int,
    quantite double precision,
    prixUnitaire double precision,
    FOREIGN KEY (Commandeid) REFERENCES Commande(id),
    FOREIGN KEY (Produitid) REFERENCES Produit(id)
);

INSERT INTO DetailCommande(Commandeid,Produitid,quantite,prixUnitaire)
VALUES
    (1,6,200,2700),
    (2,4,450,1650),
    (2,6,550,2630),
    (3,1,400,1800),
    (3,8,350,4150),
    (3,10,100,900),
    (4,2,600,2300),
    (4,3,400,1000),
    (4,9,1200,2450),
    (5,12,230,350),
    (5,1,250,1850),
    (6,11,400,780),
    (6,2,300,2200),
    (7,3,200,1150),
    (7,9,700,2500),
    (8,5,100,3050),
    (8,10,200,850),
    (8,11,300,810),
    (9,7,500,2600),
    (10,3,400,1100),
    (10,9,250,2650),
    (11,9,570,2550),
    (12,5,400,3150),
    (12,7,240,2600),
    (12,11,100,800);

CREATE TABLE Livraison(
    id SERIAL PRIMARY KEY,
    date date,
    Commandeid int,
    delaiPaiement int,
    FOREIGN KEY (Commandeid) REFERENCES Commande(id)
);

INSERT INTO Livraison(date,Commandeid,delaiPaiement)
VALUES
    ('2023-01-25',1,30),
    ('2023-02-05',2,30),
    ('2023-04-16',3,30),
    ('2023-09-25',4,30),
    ('2023-03-25',5,30),
    ('2023-05-13',6,30),
    ('2023-10-03',7,30),
    ('2023-06-30',8,30),
    ('2023-07-07',9,30),
    ('2023-11-28',10,30),
    ('2023-12-18',11,30),
    ('2023-08-14',12,30);

CREATE TABLE DetailLivraison(
    id SERIAL PRIMARY KEY,
    Livraisonid int,
    Produitid int,
    quantite double precision,
    FOREIGN KEY (Livraisonid) REFERENCES Livraison(id),
    FOREIGN KEY (Produitid) REFERENCES Produit(id)
);

INSERT INTO DetailLivraison(Livraisonid,Produitid,quantite)
VALUES
    (1,6,200),
    (2,4,450),
    (2,6,550),
    (3,1,400),
    (3,8,350),
    (3,10,100),
    (4,2,600),
    (4,3,400),
    (4,9,1200),
    (5,12,230),
    (5,1,250),
    (6,11,400),
    (6,2,300),
    (7,3,200),
    (7,9,700),
    (8,5,100),
    (8,10,200),
    (8,11,300),
    (9,7,500),
    (10,3,400),
    (10,9,250),
    (11,9,570),
    (12,5,400),
    (12,7,240),
    (12,11,100);

CREATE TABLE paiement(
    id SERIAL PRIMARY KEY,
    date date,
    Livraisonid int,
    montant double precision,
    FOREIGN KEY (Livraisonid) REFERENCES Livraison(id)
);

INSERT INTO Paiement(date,Livraisonid,montant)
VALUES
    ('2023-01-30',1,2000000),
    ('2023-02-14',1,5000000),
    ('2023-03-06',2,7500000),
    ('2023-05-14',3,6800000);
    ('2023-10-20',4,5900000),
    ('2023-04-20',5,5000000),
    ('2023-06-10',6,8100000),
    ('2023-11-01',7,7700000),
    ('2023-07-25',8,6100000),
    ('2023-08-02',9,8000000),
    ('2023-12-21',10,6000000),
    ('2023-12-29',11,5500000),
    ('2023-09-07',12,7800000);

CREATE TABLE ChargeFixe(
    id SERIAL PRIMARY KEY,
    designation varchar(200),
    montant double precision
);
INSERT INTO ChargeFixe(designation,montant)
VALUES
    ('Loyer engard',200000);

CREATE TABLE HistoriqueCharge(
    id SERIAL PRIMARY KEY,
    date date,
    ChargeFixeid int,
    montant double precision,
    FOREIGN KEY (ChargeFixeid) REFERENCES ChargeFixe(id)
);

INSERT INTO TypeCharge(nom)
VALUES
    ('Docker'),
    ('Paquettage');

INSERT INTO Charge(montant,date,TypeChargeid,Collectid)
VALUES
    (20000,'2023-01-23',1,1),
    (15000,'2023-02-23',1,2),
    (35000,'2023-03-23',2,3),
    (22000,'2023-04-23',1,4),
    (18000,'2023-05-23',2,5),
    (15500,'2023-06-23',2,6),
    (20000,'2023-07-23',2,7),
    (21500,'2023-08-23',1,8),
    (12500,'2023-09-23',1,9),
    (30000,'2023-10-23',2,10),
    (28000,'2023-11-23',1,11),
    (19000,'2023-12-23',1,12);


INSERT INTO Charge(montant,date,TypeChargeid,Collectid)
VALUES
    (30000,'2023-01-23',1,1),
    (25000,'2023-02-23',1,2),
    (15000,'2023-03-23',2,3),
    (12000,'2023-04-23',1,4),
    (52000,'2023-04-23',1,4),
    (38000,'2023-05-23',2,5),
    (45500,'2023-06-23',2,6),
    (40000,'2023-07-23',2,7),
    (21500,'2023-08-23',1,8),
    (22500,'2023-09-23',1,9),
    (6000,'2023-10-23',2,10),
    (28000,'2023-11-23',1,11),
    (19000,'2023-12-23',1,12);
DROP TABLE Transport CASCADE;
CREATE TABLE Transport(
    id SERIAL PRIMARY KEY,
    nom varchar(100),
    contact varchar(50)
);
INSERT INTO Transport(nom,contact)
VALUES
    ('Transmad','0348294813'),
    ('Tsara Transport','0347492302'),
    ('I-transport','0329492834');

DROP TABLE PlanningCollecte CASCADE;
CREATE TABLE PlanningCollecte(
    id SERIAL PRIMARY KEY,
    dateDelai date,
    PointCollectid int,
    budget double precision,
    FOREIGN KEY (PointCollectid) REFERENCES PointCollect(id)
);

alter table PlanningCollecte add column produitid int ;
alter table PlanningCollecte add FOREIGN key (produitid)REFERENCES produit(id) ;
alter table PlanningCollecte add column  tonnage int ;
alter table PlanningCollecte add column  etat int ;

INSERT INTO PlanningCollecte(dateDelai,PointCollectid,budget,produitid,tonnage)
VALUES
    ('2023-05-12',8,20000000,4,13),
    ('2023-05-12',10,20000000,3,42),
    ('2023-05-12',12,20000000,2,40);

CREATE TABLE CollecteurPlanning(
    id SERIAL PRIMARY KEY,
    Collecteurid int,
    PlanningCollecteid int,
    FOREIGN KEY (Collecteurid) REFERENCES Collecteur(id),
    FOREIGN KEY (PlanningCollecteid) REFERENCES PlanningCollecte(id)
);
INSERT INTO CollecteurPlanning(Collecteurid,PlanningCollecteid)
VALUES
    (1,1),
    (2,2),
    (3,3);

INSERT INTO MouvementTransport(montant,date,Transportid,PlanningCollecteid)
VALUES
    (50000,'2023-01-15',1,1),
    (70000,'2023-02-15',1,1),
    (47000,'2023-03-15',1,1),
    (55000,'2023-04-15',1,1),
    (39000,'2023-05-15',2,2),
    (41000,'2023-06-15',2,2),
    (50000,'2023-07-15',2,2),
    (57000,'2023-08-15',2,2),
    (38000,'2023-09-15',3,3),
    (50000,'2023-10-15',3,3),
    (29000,'2023-11-15',3,3),
    (47000,'2023-12-15',3,3);

--VIEW
--Recette
CREATE or REPLACE View v_recette_temp as
select m.abreviation,extract(month from p.date) as mois,sum(p.montant) as montant from paiement p join mois m on m.id = extract(month from p.date) where extract(year from p.date) = extract(year from current_date) group by extract(month from p.date),m.abreviation order by mois;
drop view v_recette;

    CREATE or REPLACE View v_recette as
    select mois.abreviation,mois.id::int as mois, coalesce(montant,0) montant from v_recette_temp v right join mois on mois.id=v.mois;

--Depense
    --Charge variable
    CREATE or REPLACE View v_chargevariable as
    select m.abreviation,extract(month from c.date) as mois,sum(c.montant) as montant from charge c join mois m on m.id = extract(month from c.date) where extract(year from c.date) = extract(year from current_date) group by extract(month from c.date),m.abreviation order by mois;

--Achat produit (Collecte)
CREATE or REPLACE View v_depensecollecte as
select m.abreviation,extract(month from c.date) as mois,sum(c.quantite*c.prixunitaire) as montant from collect c join mois m on m.id = extract(month from c.date) where extract(year from c.date) = extract(year from current_date) group by extract(month from c.date),m.abreviation order by mois;

--Transport
CREATE or REPLACE View v_depensetransport as
select m.abreviation,extract(month from mt.date) as mois,sum(mt.montant) as montant from mouvementtransport mt join mois m on m.id = extract(month from mt.date) where extract(year from mt.date) = extract(year from current_date) group by extract(month from mt.date),m.abreviation order by mois;

--Depense fixe
CREATE or REPLACE View v_depensefixe as
select sum(montant) as montant from chargefixe;

--Depense total
CREATE or REPLACE View v_depense as
select v.abreviation,v.mois,(v.montant+c.montant+t.montant+(select montant from v_depensefixe)) as montant from v_chargevariable v join v_depensecollecte c on v.mois = c.mois join v_depensetransport t on v.mois = t.mois;

--Benefice
CREATE or REPLACE View v_benefice as
select r.abreviation,r.mois,r.montant-coalesce(d.montant,0) as montant from v_recette r  left join v_depense d on r.mois = d.mois;

--Fidelite client
CREATE or REPLACE View v_fideliteclient as
select cl.nom,cl.adresse,cl.email,cl.telephone,count(c.*) from commande c join client cl on c.clientid = cl.id group by c.clientid,cl.nom,cl.adresse,cl.email,cl.telephone order by count desc;



