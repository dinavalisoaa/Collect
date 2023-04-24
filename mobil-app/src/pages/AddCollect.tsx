import { IonButton, IonCard, IonCardContent, IonCardHeader, IonCardTitle, IonContent, IonHeader, IonInput, IonItem, IonLabel, IonPage, IonTitle, IonToolbar } from "@ionic/react"
import { useState } from "react"
import SessionManagement from "../components/SessionManage";
import { Collection } from "../model/Collection";

export default function AddCollect() {
    const [produit, setProduit] = useState(1);
    const [dateCollect, setDate] = useState();
    const [planningCollect, setPlanningCollect] = useState(1);
    const [quantite, setQuantite] = useState(0);
    const [pu, setPU] = useState(0);

    function addCollect( e: React.FormEvent<HTMLFormElement> ) {
        e.preventDefault();
        let admin = localStorage.getItem("admin")

        if(admin != null){
            let obj = {
                produit : produit,
                dateCollect : dateCollect,
                planningCollect : planningCollect,
                quantite : quantite,
                prixUnitaire : pu,
                Collecteurid : JSON.parse(admin).id
            }
            

            new Collection(obj).create();
        }
    }

    return (
        <IonPage>
            <IonHeader>
                <IonToolbar>
                <IonTitle>Collect</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <SessionManagement></SessionManagement>
                <IonCard>
                    <IonCardHeader>
                        <IonCardTitle>Ajout d'un collect</IonCardTitle>
                    </IonCardHeader>
                    <IonCardContent>
                        <form onSubmit={addCollect}>
                            <IonItem>
                                <IonLabel>Produit</IonLabel>
                                <select onSelect={(e:any) => setProduit(e.target.value)}>
                                    <option value={1}>Manioc</option>
                                </select>
                            </IonItem>
                            <IonItem>
                                <IonLabel>Date</IonLabel>
                                <IonInput type="date" value={dateCollect} onChange={(e:any) => setDate(e.target.value)} className="text-center" required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Prix Unitaire</IonLabel>
                                <IonInput type="number" value={pu} onChange={(e:any) => setPU(e.target.value)} required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Quantite</IonLabel>
                                <IonInput type="number" value={quantite} onChange={(e:any) => setQuantite(e.target.value)} required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel>Planning de collect</IonLabel>
                                <select onSelect={(e:any) => setPlanningCollect(e.target.value)}>
                                    <option value={1}>Plan 1</option>
                                </select>
                            </IonItem>
                            <IonButton type="submit" expand="block">Confirmer</IonButton>
                        </form>
                    </IonCardContent>
                </IonCard>
            </IonContent>
        </IonPage>
    )
}