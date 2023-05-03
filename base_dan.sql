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
INSERT INTO produit(id,nom,TypeProduitid,debutsaison,finsaison,dureePeremption,modeConservation,typestockid) VALUES(DEFAULT, 'Lentille', 3, 4,8, 18, 'endroit sec', 1),
(DEFAULT, 'Orange', 1, 1,3, 18, 'refrigere', 2),(DEFAULT, 'testlifo', 2, 3,7, 18, 'ombre', 3);

INSERT INTO engard VALUES(DEFAULT, 'ENGARD1', 0, 0, 1);
INSERT INTO engard VALUES(DEFAULT, 'ENGARD2', 0, 0, 1);

INSERT INTO MouvementStock VALUES(DEFAULT, 2000, 5, '2023-04-01', 1, 1);
INSERT INTO MouvementStock VALUES(DEFAULT, 2500, 5, '2023-04-02', 2, 1);
INSERT INTO MouvementStock VALUES(DEFAULT, 2000, -2, '2023-04-03', 1, 1);
INSERT INTO MouvementStock VALUES(DEFAULT, 1900, 5, '2023-04-01', 1, 2);
INSERT INTO MouvementStock VALUES(DEFAULT, 2600, 5, '2023-04-02', 2, 2);

drop view v_etatstock;
CREATE VIEW v_etatstock_V1 AS
SELECT produitid, SUM
(COALESCE(prixUnitaire, 0)*quantite) valeurstock, SUM(quantite) quantitestock FROM mouvementStock GROUP BY produitid;

Create view v_etatstock
select pr.id as produitid ,coalesce(valeurstock,0) valeurstock,coalesce(quantitestock,0) quantitestock
from v_etatstock_V1 v RIGHT join produit pr on pr.id=v.produitid;

ALTER TABLE etatstock ADD COLUMN dateentree date DEFAULT now();
ALTER TABLE etatstock ADD COLUMN prixunitaire double precision DEFAULT 0;

INSERT INTO etatstock VALUES(DEFAULT, 1, 8, null, 1937.5);
INSERT INTO etatstock VALUES(DEFAULT, 2, 5, '2023-04-02', 2500);
INSERT INTO etatstock VALUES(DEFAULT, 2, 5, '2023-04-02', 2600);
