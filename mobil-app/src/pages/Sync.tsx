import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonButton, IonIcon, NavContext } from "@ionic/react";
import { navigate, syncOutline } from "ionicons/icons";
import { useCallback, useContext, useEffect } from "react";

export default function Sync() {
    const {navigate} = useContext(NavContext);
    const redirect = useCallback(
		() => navigate("/add-collect", 'root'),[navigate]
	)
    
    
    function verifyIf() {
        const server = localStorage.getItem("ip");
        if(!server){
            redirect();
        }
        
    }
    

    function sync() {
        alert("syncronisation");
    }

    useEffect(()=>{
        verifyIf();
    },[])
    
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