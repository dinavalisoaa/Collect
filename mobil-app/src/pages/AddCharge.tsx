import { IonButton, IonCard, IonCardContent, IonCardHeader, IonCardTitle, IonContent, IonHeader, IonInput, IonItem, IonLabel, IonPage, IonTitle, IonToolbar } from "@ionic/react"
import { useState } from "react"
import SessionManagement from "../components/SessionManage";
import { Charge } from "../model/Charge";

export default function AddCharge() {
    const [collect, setCollect] = useState(1);
    const [dateCharge, setDateCharge] = useState();
    const [montant, setMontant] = useState(0);

    function addCharge( e: React.FormEvent<HTMLFormElement> ) {
        e.preventDefault();
        let obj = {
            collect : collect,
            dateCharge : dateCharge,
            montant : montant,
        }
        console.log(montant);
        new Charge(obj).save();
    }
    
 

    return (
        <IonPage>
            <IonHeader>
                <IonToolbar>
                <IonTitle>Ajout Charge</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <SessionManagement></SessionManagement>
                <IonCard>
                    <IonCardHeader>
                        <IonCardTitle>Ajout d'un collect</IonCardTitle>
                    </IonCardHeader>
                    <IonCardContent>
                        <form onSubmit={addCharge}>
                            <IonItem>
                                <IonLabel>Collect</IonLabel>
                                <select onSelect={(e:any) => setCollect(e.target.value)}>
                                    <option value={1}>And Collect</option>
                                </select>
                            </IonItem>
                            <IonItem>
                                <IonLabel>Date de charge</IonLabel>
                                <IonInput type="date" value={dateCharge} onChange={(e:any) => setDateCharge(e.target.value)} required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Montant</IonLabel>
                                <IonInput type="number" value={montant} onChange={(e:any) => setMontant(e.target.value)} required/>
                            </IonItem>
                            <IonButton type="submit" expand="block">Login</IonButton>
                        </form>
                    </IonCardContent>
                </IonCard>
            </IonContent>
        </IonPage>
    )
}