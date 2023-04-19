\c postgres
DROP DATABASE collect;
CREATE DATABASE collect;
\c collect

ALTER TABLE Admin ALTER COLUMN nom TYPE varchar;
ALTER TABLE Admin ALTER COLUMN login TYPE varchar;
ALTER TABLE Admin ALTER COLUMN mdp TYPE varchar;

ALTER TABLE produit ADD COLUMN typestockid int;
ALTER TABLE produit ADD CONSTRAINT produit_typestock FOREIGN KEY (typestockid) REFERENCES typestock(id);
ALTER TABLE MouvementStock DROP CONSTRAINT FKMouvementS712717;
ALTER TABLE MouvementStock DROP COLUMN typestockid;

INSERT INTO typestock VALUES(DEFAULT, 'CMUP');
INSERT INTO typestock VALUES(DEFAULT, 'FIFO');
INSERT INTO typestock VALUES(DEFAULT, 'LIFO');

UPDATE produit SET typestockid=1;

CREATE TABLE data(
    id SERIAL PRIMARY KEY,
    margeBenef double precision
);

INSERT INTO data VALUES(DEFAULT,20);

INSERT INTO produit VALUES(DEFAULT, 'Lentille', 3, 1, 18, 'endroit sec', 1);
INSERT INTO produit VALUES(DEFAULT, 'Orange', 1, 1, 18, 'refrigere', 2);

INSERT INTO engard VALUES(DEFAULT, 'ENGARD1', 0, 0, 1);
INSERT INTO engard VALUES(DEFAULT, 'ENGARD2', 0, 0, 1);

INSERT INTO MouvementStock VALUES(DEFAULT, 2000, 5, '2023-04-01', 1, 1);
INSERT INTO MouvementStock VALUES(DEFAULT, 2500, 5, '2023-04-02', 2, 1);
INSERT INTO MouvementStock VALUES(DEFAULT, 2000, -2, '2023-04-03', 1, 1);
INSERT INTO MouvementStock VALUES(DEFAULT, 1900, 5, '2023-04-01', 1, 2);
INSERT INTO MouvementStock VALUES(DEFAULT, 2600, 5, '2023-04-02', 2, 2);

CREATE VIEW v_etatstock AS
SELECT produitid, SUM(prixUnitaire*quantite) valeurstock, SUM(quantite) quantitestock FROM mouvementStock GROUP BY produitid;

ALTER TABLE etatstock ADD COLUMN dateentree date DEFAULT now();
ALTER TABLE etatstock ADD COLUMN prixunitaire double precision DEFAULT 0;

INSERT INTO etatstock VALUES(DEFAULT, 1, 38, null, 	2118.42);
INSERT INTO etatstock VALUES(DEFAULT, 2, 5, '2023-04-02', 2500);
INSERT INTO etatstock VALUES(DEFAULT, 2, 5, '2023-04-02', 2600);

quantite|pu|montant

CMUP
38 | PU | 80500

FIFO
5 | PU1 | XXXX
4 | PU2 | XXXX

LIFO
5 | PU1 | XXXX
6 | PU2 | XXXX
