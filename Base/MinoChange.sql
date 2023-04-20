alter table  Transport drop column Transportid  ;
drop table societe;
create table societe(
    id SERIAL PRIMARY key ,
    nom VARCHAR(50)
);
alter table transport add column idsociete int;
ALTER TABLE transport ADD  FOREIGN KEY (idsociete) REFERENCES societe(id);
alter table ContratTransport drop column PlanningCollecteid;
alter table ContratTransport add column duree  int default 0;
alter table ContratTransport add column dateDebut  date default now();
ALTER TABLE ContratTransport ALTER COLUMN montant SET DEFAULT 0;
ALTER TABLE TRANSPORT DROP COLUMN PointCollectid ;
ALTER TABLE TRANSPORT ADD COLUMN "type" int default 0;
ALTER TABLE TRANSPORT ADD COLUMN CAPACITE INT DEFAULT 0;
ALTER TABLE TRANSPORT ADD COLUMN etat INT DEFAULT 0;
ALTER TABLE TRANSPORT ADD COLUMN IMMATRICULATION VARCHAR(30);


drop view v_transport;
create or replace view v_transport as
select s.id idSociete,t.id idTransport,t.etat, t.nom transport, contact,s.nom societe from transport  t join societe s on t.idsociete=s.id;

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
    Collecteurid INT4 NOT NULL,
    PRIMARY KEY (id)
);
