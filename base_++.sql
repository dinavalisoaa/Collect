    drop view v_chargecollecte;
    CREATE view v_chargecollecte
    as
    SELECT coalesce(sum(montant),0) as charge,cl.id as collectid FROM charge cg full join collect cl on cl.id=cg.collectid group by cl.id;;

drop view v_budgetdebit;
        CREATE view v_budgetdebit
    as
select cl.PlanningCollecteid, cl.prixUnitaire*cl.quantite as Recette,(cl.prixUnitaire*cl.quantite)+v.charge as volaniala,  v.charge From  v_chargecollecte v join Collect cl on cl.id=v.collectid;

CREATE or REPLACE view 
v_etatbudget  as
 select budget-coalesce(volaniala,0),pl.id as PlanningCollecteId from v_budgetdebit v full join PlanningCollecte pl on pl.id=v.PlanningCollecteId;