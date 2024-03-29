CREATE TABLE Admin (id SERIAL NOT NULL, nom varchar(255), login varchar(255), mdp varchar(255), PRIMARY KEY (id));
CREATE TABLE Charge (id SERIAL NOT NULL, montant float8, "date" date, TypeChargeid int4 NOT NULL, Collectid int4 NOT NULL, PRIMARY KEY (id));
CREATE TABLE Collect (id SERIAL NOT NULL, quantite int4, "date" date, prixUnitaire float8, Produitid int4 NOT NULL, PointCollectid int4 NOT NULL, Collecteurid int4 NOT NULL, PRIMARY KEY (id));
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
insert into Collecteur(nom,mdp,login,contact)values('Razafimahatratra Joro',md5('Joro'),'joro@gmail.com','0348729120');
insert into Collecteur(nom,mdp,login,contact)values('Ramafandra Faliaina',md5('Faly'),'faly@gmail.com','039874617');
insert into Collecteur(nom,mdp,login,contact)values('Ramafandra Faliaina',md5('Faly'),'faly@gmail.com','039874617');
insert into Collecteur(nom,mdp,login,contact)values('Razafimahatratra Joro',md5('Joro'),'joro@gmail.com','0348729120');
insert into TypeProduit(nom) values('LEGUME');
insert into TypeProduit(nom) values('FRUIT');
insert into TypeProduit(nom) values('DIVERS');


insert into Saison(nom,moisdebut,moisfin) values('HIVER',6,9);
insert into Saison(nom,moisdebut,moisfin) values('PRINTEMPS',9,12);
insert into Saison(nom,moisdebut,moisfin) values('ETE',12,3);
insert into Saison(nom,moisdebut,moisfin) values('AUTOMNE',3,6);

insert into region(nom)values('Analamanga'),('Itasy'),('Bongolava'),('Vakinakaratra'),('Haute Matsiatra'),
('Sofia'),('Diana'),('Sava'),('Alaotra Mangoro'),('Betsiboka'),('Menabe'),('Androy'),('Ihorombe'),('Amoron i Mania'),('Vatovavy Fitovinanay'),('Melaky'),('Analajirofo'),('Antsinanana'),('Atsimo Antsinanana'),('Atsimo Andrefana'),('Anosy'),('Boeny');
