import { IonButton, IonCard, IonCardContent, IonCardHeader, IonCardTitle, IonContent, IonHeader, IonIcon, IonInput, IonItem, IonLabel, IonPage, IonTitle, IonToolbar } from "@ionic/react"
import { addOutline } from "ionicons/icons";
import { useState } from "react"
import { Link } from "react-router-dom";
import SessionManagement from "../components/SessionManage";
import { Collection } from "../model/Collection";

export default function AddCollect() {
    const [produit, setProduit] = useState(1);
    const [dateCollect, setDate] = useState();
    const [pointCollect, setPointCollect] = useState(1);
    const [quantite, setQuantite] = useState(0);
    const [pu, setPU] = useState(0);

    function addCollect( e: React.FormEvent<HTMLFormElement> ) {
        e.preventDefault();

        let obj = {
            produit : produit,
            dateCollect : dateCollect,
            point : pointCollect,
            quantite : quantite,
            pu : pu,
            collectionerId : localStorage.getItem("adminId")
        }

        new Collection(obj).save();
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
                                <IonLabel>Point de collect</IonLabel>
                                <select onSelect={(e:any) => setPointCollect(e.target.value)}>
                                    <option value={1}>Andavamamba</option>
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