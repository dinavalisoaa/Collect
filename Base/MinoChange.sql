alter table  Transport drop column Transportid  ;

drop table transport;
CREATE TABLE Transport (
    id SERIAL NOT NULL,
    societe VARCHAR(50),
    nom VARCHAR(50),
    contact VARCHAR(50),
    PRIMARY KEY (id)
);

drop table ContratTransport;
CREATE TABLE ContratTransport (
    id SERIAL NOT NULL,
    Transportid INT4 NOT NULL,
    montant FLOAT8,
    duree FLOAT8,
    dateDebut date,
    PRIMARY KEY (id)
);

CREATE TABLE MouvementTransport (
    id SERIAL NOT NULL,
    idEngard  int ,
    Transportid INT4 NOT NULL,
    tonnage FLOAT8,
    PRIMARY KEY (id),
    FOREIGN key (idEngard) REFERENCES Engard(id)
);

