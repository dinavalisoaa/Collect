import { IonButton, IonCard, IonCardContent, IonCardHeader, IonCardTitle, IonContent, IonHeader, IonInput, IonItem, IonLabel, IonPage, IonTitle, IonToolbar } from "@ionic/react"
import { useEffect, useState } from "react"
import SessionManagement from "../components/SessionManage";
import { Collection } from "../model/Collection";
import { PlanningCollecte } from "../model/PlanningCollecte";
import { Produit } from "../model/Produit";

export default function AddCollect() {
    const [produit, setProduit] = useState(1);
    const [dateCollect, setDate] = useState();
    const [planningCollect, setPlanningCollect] = useState(1);
    const [quantite, setQuantite] = useState(0);
    const [pu, setPU] = useState(0);

    const [produits, setProduits] = useState<any[]>();
    const [planningCollects, setPlanningCollects] = useState<any[]>();

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

    useEffect(()=>{
        new Produit({}).findAll().then((value)=>{
            setProduits(value);
        });

        new PlanningCollecte({}).findAll().then((value)=>{
            setPlanningCollects(value);
        });
    },[]);

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
                                <select onChange={(e:any) => setProduit(e.target.value)}>
                                    {
                                        produits?.map((element)=>{
                                            return <option value={element.id}>{element.nom}</option>
                                        })
                                    }
                                </select>
                            </IonItem>
                            <IonItem>
                                <IonLabel>Date</IonLabel>
                                <IonInput type="date" value={dateCollect} onIonChange={(e:any) => setDate(e.target.value)} className="text-center" required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Prix Unitaire</IonLabel>
                                <IonInput type="number" value={pu} onIonChange={(e:any) => setPU(e.target.value)} required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Quantite</IonLabel>
                                <IonInput type="number" value={quantite} onIonChange={(e:any) => setQuantite(e.target.value)} required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel>Planning de collect</IonLabel>
                                <select onChange={(e:any) => setPlanningCollect(e.target.value)}>
                                    {
                                        planningCollects?.map((element)=>{
                                            return <option value={element.id}>Planning N-{element.id}</option>
                                        })
                                    }
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