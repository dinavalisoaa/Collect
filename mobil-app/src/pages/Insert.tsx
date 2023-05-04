import { IonContent, IonPage } from "@ionic/react"
import { useEffect } from "react"
import { PlanningCollecte } from "../model/PlanningCollecte";
import { Produit } from "../model/Produit";
import { TypeCharge } from "../model/TypeCharge";
import { User } from "../model/User";

export default function AddCharge() {
    useEffect(()=>{
        const chargeFixe : TypeCharge = new TypeCharge({ id : 1, nom: "fixe"});
        const chargeVariable : TypeCharge = new TypeCharge({ id : 2, nom: "variable"});
        const planningCollect : PlanningCollecte = new PlanningCollecte({tonnage : 10, dateDelai : '2021-12-12', budget : 10000});
        const user : User = new User("admin@gmail.com", "admin");
        const produit : Produit = new Produit({nom : 'Prod 1', TypeProduitid : 1, Saisonid : 1 , dureePeremption : 12.0, modeConservation : "Trano"})
        const produit2 : Produit = new Produit({nom : 'Prod 2', TypeProduitid : 2, Saisonid : 2 , dureePeremption : 13.0, modeConservation : "Glace"})

        user.create();
        chargeFixe.create();
        chargeVariable.create();
        planningCollect.create();
        
        produit.create();
        produit2.create();
    }, []);

    return (
        <IonPage>
            <IonContent>
                <h1>Insertion ...</h1>
            </IonContent>
        </IonPage>
    )
}