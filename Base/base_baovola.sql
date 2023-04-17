CREATE database Collecte;
\c Collect
CREATE TABLE Admin (
    id SERIAL NOT NULL,
    nom INT4,
    login INT4,
    mdp INT4,
    PRIMARY KEY (id)
);

CREATE TABLE Charge (
    id SERIAL NOT NULL,
    montant FLOAT8,
    "date" date,
    TypeChargeid INT4 NOT NULL,
    Collectid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Collect (
    id SERIAL NOT NULL,
    quantite INT4,
    "date" date,
    prixUnitaire FLOAT8,
    Pro9duitid INT4 NOT NULL,
    PointCollectid INT4 NOT NULL,
    Collecteurid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Collecteur (
    id SERIAL NOT NULL,
    nom VARCHAR(255),
    mdp VARCHAR(255),
    login VARCHAR(255),
    contact VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE ContratTransport (
    Transportid INT4 NOT NULL,
    montant FLOAT8,
    etatPaiement INT4,
    id SERIAL NOT NULL,
    PlanningCollecteid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Engard (
    id SERIAL NOT NULL,
    nom VARCHAR(255),
    latitude FLOAT8,
    longitude FLOAT8,
    Regionid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE EtatStock (
    id SERIAL NOT NULL,
    Produitid INT4 NOT NULL,
    quantite INT4,
    PRIMARY KEY (id)
);

CREATE TABLE MouvementStock (
    id SERIAL NOT NULL,
    prixUnitaire FLOAT8,
    quantite INT4,
    "date" date,
    TypeStockid INT4 NOT NULL,
    Produitid INT4 NOT NULL,
    Engardid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE MouvementTransport (
    id SERIAL NOT NULL,
    montant FLOAT8,
    "date" date,
    Transportid INT4 NOT NULL,
    PlanningCollecteid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE PlanningCollecte (
    id SERIAL NOT NULL,
    tonnage FLOAT8,
    dateDelai date,
    budget FLOAT8,
    PRIMARY KEY (id)
);

CREATE TABLE PointCollect (
    id SERIAL NOT NULL,
    latitude FLOAT8,
    longitude FLOAT8,
    Regionid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Produit (
    id SERIAL NOT NULL,
    nom VARCHAR(255),
    TypeProduitid INT4 NOT NULL,
    Saisonid INT4 NOT NULL,
    dureePeremption FLOAT8,
    modeConservation VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE Region (id SERIAL NOT NULL, nom VARCHAR(255), PRIMARY KEY (id));

CREATE TABLE Saison (
    id SERIAL NOT NULL,
    nom VARCHAR(255),
    moisdebut INT4,
    moisfin INT4,
    PRIMARY KEY (id)
);

CREATE TABLE Transport (
    id SERIAL NOT NULL,
    nom VARCHAR(255),
    contact VARCHAR(255),
    Transportid INT4 NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE TypeCharge (
    id SERIAL NOT NULL,
     nom VARCHAR(255),
      PRIMARY KEY (id)
);

CREATE TABLE TypeProduit (
    id SERIAL NOT NULL,
     nom VARCHAR(255),
      PRIMARY KEY (id)
);

CREATE TABLE TypeStock (id SERIAL NOT NULL, nom VARCHAR(255), PRIMARY KEY (id));

ALTER TABLE
    Produit
ADD
    CONSTRAINT FKProduit46594 FOREIGN KEY (TypeProduitid) REFERENCES TypeProduit (id);

ALTER TABLE
    Produit
ADD
    CONSTRAINT FKProduit822622 FOREIGN KEY (Saisonid) REFERENCES Saison (id);

ALTER TABLE
    PointCollect
ADD
    CONSTRAINT FKPointColle984070 FOREIGN KEY (Regionid) REFERENCES Region (id);

ALTER TABLE
    Engard
ADD
    CONSTRAINT FKEngard455257 FOREIGN KEY (Regionid) REFERENCES Region (id);

ALTER TABLE
    ContratTransport
ADD
    CONSTRAINT FKContratTra317848 FOREIGN KEY (Transportid) REFERENCES Transport (id);

ALTER TABLE
    MouvementTransport
ADD
    CONSTRAINT FKMouvementT978222 FOREIGN KEY (Transportid) REFERENCES Transport (id);

ALTER TABLE
    MouvementStock
ADD
    CONSTRAINT FKMouvementS712717 FOREIGN KEY (TypeStockid) REFERENCES TypeStock (id);

ALTER TABLE
    MouvementStock
ADD
    CONSTRAINT FKMouvementS647708 FOREIGN KEY (Produitid) REFERENCES Produit (id);

ALTER TABLE
    EtatStock
ADD
    CONSTRAINT FKEtatStock474316 FOREIGN KEY (Produitid) REFERENCES Produit (id);

ALTER TABLE
    Collect
ADD
    CONSTRAINT FKCollect631300 FOREIGN KEY (Produitid) REFERENCES Produit (id);

ALTER TABLE
    Collect
ADD
    CONSTRAINT FKCollect819440 FOREIGN KEY (PointCollectid) REFERENCES PointCollect (id);

ALTER TABLE
    Collect
ADD
    CONSTRAINT FKCollect168864 FOREIGN KEY (Collecteurid) REFERENCES Collecteur (id);

ALTER TABLE
    Charge
ADD
    CONSTRAINT FKCharge374352 FOREIGN KEY (TypeChargeid) REFERENCES TypeCharge (id);

ALTER TABLE
    Charge
ADD
    CONSTRAINT FKCharge172009 FOREIGN KEY (Collectid) REFERENCES Collect (id);

ALTER TABLE
    MouvementStock
ADD
    CONSTRAINT FKMouvementS182631 FOREIGN KEY (Engardid) REFERENCES Engard (id);

ALTER TABLE
    ContratTransport
ADD
    CONSTRAINT FKContratTra519951 FOREIGN KEY (PlanningCollecteid) REFERENCES PlanningCollecte (id);

ALTER TABLE
    MouvementTransport
ADD
    CONSTRAINT FKMouvementT791264 FOREIGN KEY (PlanningCollecteid) REFERENCES PlanningCollecte (id);

ALTER TABLE
    Collecteur
ADD
    COLUMN photo VARCHAR;

ALTER TABLE
    PlanningCollecte
ADD
    COLUMN ProduitId INT;

ALTER TABLE
    PlanningCollecte
ADD
    FOREIGN KEY (ProduitId) REFERENCES Produit(Id);

ALTER TABLE
    pointcollect
ADD
    COLUMN nom VARCHAR;

