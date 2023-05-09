import { IonPage, IonContent, IonItem, IonLabel, IonInput, IonButton, useIonToast } from "@ionic/react";
import { useState } from "react";
import { User } from "../model/User";

export default function AddIp() {
    const [ip, setIp] = useState('');
    const [present] = useIonToast();

    const presentToast = (position: 'top' | 'middle' | 'bottom') => {
		present({
			message: 'Changement reussi',
			duration: 1500,
			position: position
		});
	};

    const presentError = (position: 'top' | 'middle' | 'bottom') => {
		present({
			message: 'Changement erreur',
			duration: 1500,
			position: position
		});
	};


    const handleChange = (e: React.FormEvent<HTMLFormElement>) => {
		e.preventDefault();

        localStorage.setItem("ip",ip);

        if(!localStorage.getItem("ip")){
            presentError("bottom");
        } else {
            presentToast("bottom");
        }
		
	}
    return (
        <IonPage>
			<IonContent fullscreen>
				<h1 className='text-center'>Bienvenue sur Collector</h1>
				<form onSubmit={handleChange}>
					<IonItem>
						<IonLabel position="floating">Ip Address</IonLabel>
						<IonInput type="text" value={ip} onIonChange={e => setIp(e.detail.value!)} required />
					</IonItem>
					<IonButton type="submit" expand="block">Changer</IonButton>
				</form>
			</IonContent>
		</IonPage>
    )
}