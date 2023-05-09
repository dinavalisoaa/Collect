import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonCard, IonCardContent, IonCardHeader, IonCardSubtitle, IonCardTitle, IonCol, IonGrid, IonRow } from "@ionic/react";
import { useEffect, useState } from "react";
import ExploreContainer from "../components/ExploreContainer";
import { Collection } from "../model/Collection";

export default function ListeDesCollect() {
    const [collects, setCollects] = useState<any[]>();

    useEffect(()=>{
        new Collection({}).findAll().then((value)=>{
            setCollects(value);
        });
    },[]);

    return (
        <IonPage>
            <IonHeader>
                <IonToolbar>
                <IonTitle>Les Collectes Faits</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <IonHeader collapse="condense">
                    <IonToolbar>
                        <IonTitle size="large">Les Collectes Faits</IonTitle>
                    </IonToolbar>
                </IonHeader>
                
                <IonGrid>
                    {
                        collects?.map((value)=>{
                            return (
                                <IonRow>
                                    <IonCol>
                                        <IonCard>
                                            <IonCardHeader>
                                                <IonCardTitle>Collect le {value.dateCollect}</IonCardTitle>
                                                <IonCardSubtitle>Voici la collect fait le {value.dateCollect}</IonCardSubtitle>
                                            </IonCardHeader>

                                            <IonCardContent>
                                                Avec un quantite  :
                                                <IonCard color="primary">
                                                    <IonCardHeader>
                                                        <IonCardTitle>{value.quantite}</IonCardTitle>
                                                    </IonCardHeader>
                                                </IonCard>
                                                Avec un prix unitaire :
                                                <IonCard color="success">
                                                    <IonCardHeader>
                                                        <IonCardTitle>{value.prixUnitaire} ar</IonCardTitle>
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
                {/* <ExploreContainer /> */}
            </IonContent>
        </IonPage>
    )
}