import { IonContent, IonPage } from "@ionic/react"
import { useEffect } from "react"
import { TypeCharge } from "../model/TypeCharge";
import { User } from "../model/User";

export default function AddCharge() {
    useEffect(()=>{
        const chargeFixe : TypeCharge = new TypeCharge({ id : 1, nom: "fixe"});
        const chargeVariable : TypeCharge = new TypeCharge({ id : 2, nom: "variable"});
        const user : User = new User("admin@gmail.com", "admin");
    
        user.create();
        chargeFixe.create();
        chargeVariable.create();
    }, []);

    return (
        <IonPage>
            <IonContent>
                <h1>Insertion ...</h1>
            </IonContent>
        </IonPage>
    )
}