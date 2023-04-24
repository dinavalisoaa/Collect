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
ALTER TABLE TRANSPORT ADD COLUMN marque VARCHAR(50) default 'TOYOTA';
ALTER TABLE TRANSPORT ADD COLUMN CAPACITE INT DEFAULT 0;
ALTER TABLE TRANSPORT ADD COLUMN etat INT DEFAULT 0;
ALTER TABLE TRANSPORT ADD COLUMN IMMATRICULATION VARCHAR(30);


drop view v_transport;
create or replace view v_transport as
select s.id idSociete,t.id idTransport,t.etat, t.nom transport, contact,s.nom societe from transport  t join societe s on t.idsociete=s.id;

DROP view V_CONTRAT ;
CREATE OR REPLACE VIEW V_CONTRAT as
select t.id, s.nom societe, t.nom transport ,marque,IMMATRICULATION,montant, duree,
to_char(dateDebut::date, 'DD Month YYYY') dateDebut,
to_char((SELECT DATE(c.dateDebut::DATE + INTERVAL '12 month' * duree))::date, 'DD Month YYYY') datefin
from transport   t join contrattransport c on t.id=c.Transportid
join societe s on t.idSociete=s.id;

--ETAT O TRANSPORTEUR 
    -- 5 ENGARD 
    -- 10  PROBLEME 

DROP TABLE TRANSPORTMARCHANDISE;
CREATE TABLE TRANSPORTMARCHANDISE(
    ID SERIAL NOT NULL,
    IDTRANSPORT INT ,
    IDENGARD INT ,
    IDPLANNINGCOLLECTE INT ,
    ETAT  INT  DEFAULT 0,
    REMARQUE VARCHAR ,
    FOREIGN KEY (IDPLANNINGCOLLECTE) REFERENCES PLANNINGCOLLECTE(ID),
    FOREIGN KEY (IDTRANSPORT) REFERENCES TRANSPORT(ID),
    FOREIGN KEY (IDENGARD) REFERENCES ENGARD(ID)
);
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
