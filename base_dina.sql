    drop view v_chargecollecte;
    CREATE view v_chargecollecte
    as
    SELECT coalesce(sum(montant),0) as charge,cl.id as collectid FROM charge cg full join collect cl on cl.id=cg.collectid group by cl.id;;

drop view v_budgetdebit;
        CREATE view v_budgetdebit
    as
select cl.PlanningCollecteid, cl.prixUnitaire*cl.quantite as Recette,(cl.prixUnitaire*cl.quantite)+v.charge as volaniala,  v.charge From  v_chargecollecte v join Collect cl on cl.id=v.collectid;

-- drop view v_etatbudget;
-- CREATE or REPLACE view 
-- v_etatbudget  as
--  select budget-coalesce(volaniala,0) as montant ,pl.id as PlanningCollecteId from v_budgetdebit v full join PlanningCollecte pl on pl.id=v.PlanningCollecteId;
 
 create view v_etatbudget as
select budget-sum as montant,c.planningcollecteid from v_chargeplanning c join planningcollecte p on p.id=c.planningcollecteid;

create view v_charge_achat as 
 select sum(coalesce(prixunitaire,0)*coalesce(quantite,0)),p.id as planningcollecteid From collect c full join planningcollecte p on p.id=c.planningcollecteid group by p.id;



create or replace view v_chargeplanning as select sum(coalesce(montant,0)), p.id planningcollecteid from charge c full join planningcollecte p on p.id=c.planningcollecteid group by p.id;

create view v_vola_niala as
select v1.sum+v2.sum  volaniala, v1.planningcollecteid from v_charge_achat v1 join v_chargeplanning v2 on v2.planningcollecteid=v1.planningcollecteid;

create or replace view v_etatbudget 
as select budget-volaniala as montant ,v.planningcollecteid from v_vola_niala v join planningcollecte p on v.planningcollecteid=p.id;

--  select *from v_budgetdebit;
--  planningcollecteid | recette | volaniala | charge
update pointcollect set nom='Isalo' where id=3;
update pointcollect set nom='Alasora' where id=4;
update pointcollect set nom='Antsirabe' where id=5;
update pointcollect set nom='Ambanja' where id=6;
update pointcollect set nom='Bongolava' where id=7;
update pointcollect set nom='Boeny' where id=8;

alter table PlanningCollecte drop column produitid;
alter table PlanningCollecte drop column tonnage;
alter table collect add column PlanningCollecteId int;
alter table collect add column etat int;
alter table collect alter column etat set DEFAULT 0;

alter table collect add FOREIGN key (PlanningCollecteId) REFERENCES PlanningCollecte(id);
alter table collect add drop column pointcollect;


create table EngardPointCollecte (
id SERIAL PRIMARY key,
Engardid int,
PointCollectid int,
FOREIGN key (Engardid) REFERENCES Engard(id),
FOREIGN key (PointCollectid) REFERENCES PointCollect(id)
);
 
 insert into EngardPointCollecte(engardid,PointCollectid)values(1,1);
 insert into EngardPointCollecte(engardid,PointCollectid)values(1,2);
 insert into EngardPointCollecte(engardid,PointCollectid)values(1,3);
 insert into EngardPointCollecte(engardid,PointCollectid)values(1,4);
 insert into EngardPointCollecte(engardid,PointCollectid)values(1,5);
 insert into EngardPointCollecte(engardid,PointCollectid)values(2,6);
 insert into EngardPointCollecte(engardid,PointCollectid)values(3,5);
 insert into EngardPointCollecte(engardid,PointCollectid)values(2,7);
 insert into EngardPointCollecte(engardid,PointCollectid)values(4,12);
 insert into EngardPointCollecte(engardid,PointCollectid)values(4,8);
 insert into EngardPointCollecte(engardid,PointCollectid)values(2,9);
 insert into EngardPointCollecte(engardid,PointCollectid)values(2,10);
 insert into EngardPointCollecte(engardid,PointCollectid)values(2,11);
 insert into EngardPointCollecte(engardid,PointCollectid)values(3,12);
 insert into EngardPointCollecte(engardid,PointCollectid)values(3,13);
 insert into EngardPointCollecte(engardid,PointCollectid)values(3,14);

create view v_pt_engard 
as 
select e.nom nomengard,e.id engardid, p.id  idpt,p.nom nompt from engard e,pointcollect p  ;


select *from pointcollect pt join engardpointcollecte e on e.pointcollectid=pt.id;


create or replace function getPointCollecte(engardids int)
 RETURNS table(id int,nom varchar)
language plpgsql
as
$$
  select p.* from engardpointcollecte e join pointcollect p on p.id=e.pointcollectid where e.engardid=engardids;
$$;

CREATE FUNCTION recupfoo(int) RETURNS SETOF pointcollect AS $$
select p.* from engardpointcollecte e join pointcollect p on p.id=e.pointcollectid where e.engardid= $1;
$$ LANGUAGE SQL;

CREATE FUNCTION getPointCollecte(int) RETURNS table(id int,nom varchar) AS $$
select p.id from engardpointcollecte e join pointcollect p on p.id=e.pointcollectid where e.engardid= $1;
$$ LANGUAGE SQL;

create table typepaquet(
  id SERIAL PRIMARY key,
  type varchar(200)
);
create table Paquettage(
  id SERIAL PRIMARY key,
  "date"date ,
  nombrePaquet int,
  quantiteParPaquet int,
  typepaquetId int,
  produitId int,
  FOREIGN key (typepaquetId) REFERENCES typepaquet(Id),
  FOREIGN key (produitId) REFERENCES produit(Id)
); 

alter table charge drop column collectid;
alter table charge add column PlanningCollecteid int ;
alter table charge add FOREIGN key(PlanningCollecteid) REFERENCES PlanningCollecte(id);

insert into charge(montant,date,TypeChargeid,planningcollecteid)values(20000,now(),1,10),(20000,now(),1,10),(40400,now(),2,12),(20000,now(),1,3),(20000,now(),1,4),(20000,now(),2,2);

insert into charge(montant,date,TypeChargeid,planningcollecteid)values(20000,now(),1,10),(20000,now(),1,10),(40400,now(),1,1),(26700,now(),1,3),(63000,now(),1,2),(29000,now(),2,3),(24000,now(),2,13),(20000,now(),2,8),(34000,now(),2,9),(299000,now(),2,10),(20000,now(),2,13),(60000,now(),2,14),(20000,now(),2,15),(20000,now(),1,16),(70000,now(),2,17);


insert into charge(montant,date,TypeChargeid,planningcollecteid)values(20000,now(),1,10),(20000,now(),1,10),(40400,'2023-04-12',1,1),(26700,now(),1,3),(63000,now(),1,2),(29000,now(),2,3),(24000,now(),2,13),(20000,now(),2,8),(34000,now(),2,9),(199000,now(),2,10),(20000,now(),2,13),(60000,now(),2,14),(20000,now(),2,15),(20000,now(),1,16),(70000,now(),2,17);

alter TABLE mouvementstock alter COLUMN "date" set DEFAULT  CURRENT_Date; 
alter TABLE commande add column etat int DEFAULT 0;

 delete from mouvementstock where id>100;