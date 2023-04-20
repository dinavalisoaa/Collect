import React, { useEffect, useState } from 'react';
import {
    IonBackButton,
    IonBadge,
    IonButtons,
    IonContent,
    IonHeader,
    IonItem,
    IonLabel,
    IonList,
    IonNote,
    IonPage,
    IonTitle,
    IonToolbar,
} from '@ionic/react';
import { useParams } from 'react-router';

const DetailVehicule: React.FC = () => {
    const params = useParams<{ idVehicule: string }>();
    const [list_, setList] = useState<any>([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        setLoading(true);
        fetch('http://localhost:8080/vehicules/' + params.idVehicule)
            .then(data => data.json())
            .then(res => {
                setList(res);
                setLoading(false);
            })
    }, [])

    return (
        <IonPage id="view-message-page">
            <IonHeader>
                <IonToolbar color='primary'>
                    <IonButtons slot="start">
                        <IonBackButton text="Retour" defaultHref="/Vehicule"></IonBackButton>
                    </IonButtons>
                    <IonTitle>Details</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent>
                <IonList>
                    <IonItem>
                        <IonLabel>
                            <IonBadge color="primary" slot="start">
                                <h2>{list_.immatriculation}</h2>
                            </IonBadge>
                            <h3>Marque : <IonNote>{list_.marque}</IonNote></h3>
                            <h3>DateEXP : <IonNote>2022-12-29</IonNote></h3>
                            <IonNote>Numéro {list_.idVehicule}</IonNote>

                        </IonLabel>
                    </IonItem>
                </IonList>
            </IonContent>
        </IonPage>
    );
}

export default DetailVehicule;
