import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonButton, IonIcon } from "@ionic/react";
import { syncOutline } from "ionicons/icons";

export default function Sync() {
    function sync() {
        alert("syncronisation");
    }
    
    return (
        <IonPage>
            <IonHeader>
                <IonToolbar>
                <IonTitle>Syncronisation</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <IonButton expand="block" onClick={sync}>
                    <IonIcon icon={syncOutline}/>
                    Sync
                </IonButton>
            </IonContent>
        </IonPage>
    )
}