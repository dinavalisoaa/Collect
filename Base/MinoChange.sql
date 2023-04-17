alter table  Transport drop column Transportid  ;
drop table societe;
create table societe(
    id SERIAL NOT NULL,
    nom VARCHAR(50)
);
alter table transport add column idsociete int;
ALTER TABLE transport ADD CONSTRAINT idsociete FOREIGN KEY (idsociete) REFERENCES societe (id);
alter table ContratTransport drop column PlanningCollecteid;
alter table ContratTransport add column duree  int default 0;
alter table ContratTransport add column dateDebut  date default now()''

drop table transport;
CREATE TABLE Transport (
    id SERIAL NOT NULL,
    idsociete VARCHAR(50),
    nom VARCHAR(50),
    contact VARCHAR(50),
    PRIMARY KEY (id),
    FOREIGN KEY (idsociete) REFERENCES societe (id)
);

drop table ContratTransport;
CREATE TABLE ContratTransport (
    id SERIAL NOT NULL,
    Transportid INT4 NOT NULL,
    montant FLOAT8,
    duree FLOAT8 default 0,
    dateDebut date,
    PRIMARY KEY (id)
);

CREATE TABLE MouvementTransport (
    id SERIAL NOT NULL,
    dateTransport date,
    idEngard  int ,
    Transportid INT4 NOT NULL,
    tonnage FLOAT8,
    PRIMARY KEY (id),
    FOREIGN key (idEngard) REFERENCES Engard(id)
);

CREATE TABLE Collect (
    id SERIAL NOT NULL,
    quantite INT4,
    "date" date,
    prixUnitaire FLOAT8,
    Produitid INT4 NOT NULL,
    PointCollectid INT4 NOT NULL,
    Collecteurid INT4 NOT NULL,
    PRIMARY KEY (id)
);
