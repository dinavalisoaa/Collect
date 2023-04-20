<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistique extends Model
{
    public static function current_month(){
        $tab=Statistique::fromQuery("select extract(month from current_date) as mois");
        return $tab[0]['mois'];
    }

    //Quantite de collecte par produit
    public static function quantite_collecte(){
        $tab = Statistique::fromQuery("select sum(c.quantite) as quantite,c.produitid,p.nom from collect c join produit p on c.produitid = p.id where extract(year from c.date) = extract(year from current_date) group by c.produitid,p.nom order by c.produitid");
        return $tab;
    }

    //Quantite vendu par produit
    public static function quantite_vendu(){
        $tab = Statistique::fromQuery("select sum(d.quantite) as quantite,d.produitid,p.nom from detaillivraison d join produit p on d.produitid = p.id join livraison l on l.id = d.livraisonid where extract(year from l.date) = extract(year from current_date) group by d.produitid,p.nom order by d.produitid");
        return $tab;
    }

    //Recette par mois
    public static function montant_recette(){
        $tab = Statistique::fromQuery("select * from v_recette");
        return $tab;
    }

    //Charge variable
    public static function montant_charge(){
        $tab = Statistique::fromQuery("select * from v_chargevariable");
        return $tab;
    }

    //Achat produit (collecte)
    public static function montant_collecte(){
        $tab = Statistique::fromQuery("select * from v_depensecollecte");
        return $tab;
    }

    //transport
    public static function montant_transport(){
        $tab = Statistique::fromQuery("select * from v_depensetransport");
        return $tab;
    }

    //Charges fixes
    public static function montant_fixe(){
        $tab = Statistique::fromQuery("select * from v_depensefixe");
        return $tab;
    }

    //Total depense
    public static function montant_depense(){
        $tab = Statistique::fromQuery("select * from v_depense");
        return $tab;
    }

    //Total depense
    public static function montant_benefice(){
        $tab = Statistique::fromQuery("select * from v_benefice");
        return $tab;
    }

    //Somme recette
    public static function somme_recette(){
        $tab = Statistique::fromQuery("select sum(montant) as montant from v_recette");
        return $tab[0]['montant'];
    }

    //Somme depense
    public static function somme_depense(){
        $tab = Statistique::fromQuery("select sum(montant) as montant from v_depense");
        return $tab[0]['montant'];
    }

    //Somme benefice
    public static function somme_benefice(){
        $tab = Statistique::fromQuery("select sum(montant) as montant from v_benefice");
        return $tab[0]['montant'];
    }

    //Top 3 des clients fideles
    public static function client_fidele(){
        $tab = Statistique::fromQuery("select * from v_fideliteclient limit 3");
        return $tab;
    }
}
