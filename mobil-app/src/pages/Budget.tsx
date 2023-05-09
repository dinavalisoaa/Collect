import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonCard, IonCardContent, IonCardHeader, IonCardSubtitle, IonCardTitle, IonCol, IonGrid, IonRow } from "@ionic/react";
import { useEffect, useState } from "react";
import ExploreContainer from "../components/ExploreContainer";
import { Charge } from "../model/Charge";
import { PlanningCollecte } from "../model/PlanningCollecte";
import { Produit } from "../model/Produit";

export default function Budget() {
    const [charge, setCharge] = useState<any[]>();
    useEffect(()=>{
        new Charge({}).findAll().then((value)=>{
            setCharge(value);
        });
    },[]);

    return (
        <IonPage>
            <IonHeader>
            <IonToolbar>
                <IonTitle>Liste des Charges</IonTitle>
            </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <IonHeader collapse="condense">
                    <IonToolbar>
                    <IonTitle size="large">Liste des Charges</IonTitle>
                    </IonToolbar>
                </IonHeader>
                <IonGrid>
                    {
                        charge?.map((value)=>{
                            return(
                                <IonRow>
                                    <IonCol>
                                        <IonCard>
                                            <IonCardHeader>
                                                <IonCardTitle>Charge le {value.dateCharge}</IonCardTitle>
                                                <IonCardSubtitle>Charge sur la collect numero {value.collect}</IonCardSubtitle>
                                            </IonCardHeader>

                                            <IonCardContent>
                                                Ceci est une charge avec la valeur
                                                <IonCard color="success">
                                                    <IonCardHeader>
                                                        <IonCardTitle>{value.montant} ar</IonCardTitle>
                                                    </IonCardHeader>
                                                </IonCard>
                                            </IonCardContent>
                                        </IonCard>
                                    </IonCol>
                                </IonRow>
                            )
                        })
                    }
                    
                </IonGrid>

                
                <ExploreContainer />
            </IonContent>
        </IonPage>
    );
}