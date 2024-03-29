import { IonMenu, IonHeader, IonToolbar, IonTitle, IonContent, IonList, IonItem, IonIcon, IonLabel } from '@ionic/react';
import { logOutOutline, downloadOutline, cloudUploadOutline, addSharp, syncOutline, atOutline, wallet, listOutline } from 'ionicons/icons';

interface SidebarMenuProps {
  onDeconnexion: () => void;
}

const SidebarMenu: React.FC<SidebarMenuProps> = ({ onDeconnexion }) => {
    return (
        <IonMenu side="start" contentId="main-content">
            <IonHeader>
                <IonToolbar>
                    <IonTitle>Menu</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent>
                <IonList>
                    <IonItem button routerLink='/create-type'>
                        <IonIcon icon={addSharp} slot="start" />
                        <IonLabel>Create Type charge</IonLabel>
                    </IonItem>
                    <IonItem button routerLink='/add-collect'>
                        <IonIcon icon={downloadOutline} slot="start" />
                        <IonLabel>Collecte</IonLabel>
                    </IonItem>
                    <IonItem button routerLink='/add-charge'>
                        <IonIcon icon={cloudUploadOutline} slot="start" />
                        <IonLabel>Charge</IonLabel>
                    </IonItem>
                    <IonItem button routerLink='/sync'>
                        <IonIcon icon={syncOutline} slot="start" />
                        <IonLabel>Sync</IonLabel>
                    </IonItem>

                    <IonItem button routerLink='/config'>
                        <IonIcon icon={atOutline} slot="start" />
                        <IonLabel>Config</IonLabel>
                    </IonItem>

                    <IonItem button routerLink='/list-charge'>
                        <IonIcon icon={wallet} slot="start" />
                        <IonLabel>Liste Charge</IonLabel>
                    </IonItem>

                    <IonItem button routerLink='/list-collect'>
                        <IonIcon icon={listOutline} slot="start" />
                        <IonLabel>Liste Collect</IonLabel>
                    </IonItem>

                    <IonItem button onClick={onDeconnexion}>
                        <IonIcon icon={logOutOutline} slot="start" />
                        <IonLabel>Déconnexion</IonLabel>
                    </IonItem>
                </IonList>
            </IonContent>
        </IonMenu>
    );
};

export default SidebarMenu;
