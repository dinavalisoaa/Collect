import { IonButton, IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from "@ionic/react"
import { useState } from "react"
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
                <form onSubmit={addCharge}>
                    <div>
                        <label>Collect</label>
                        <select onSelect={(e:any) => setCollect(e.target.value)}>
                            <option value={1}>And Collect</option>
                        </select>
                    </div>
                    <div>
                        <label>Date de charge</label>
                        <input type="date" value={dateCharge} onChange={(e:any) => setDateCharge(e.target.value)} required/>
                    </div>
                    <div>
                        <label>Montant</label>
                        <input type="number" value={montant} onChange={(e:any) => setMontant(e.target.value)} required/>
                    </div>
                    <IonButton type="submit" expand="block">Login</IonButton>
                </form>
            </IonContent>
        </IonPage>
    )
}