import React, { useEffect, useRef, useState } from 'react';
import { IonButton, IonButtons, IonCol, IonContent, IonHeader, IonInput, IonItem, IonLabel, IonList, IonMenuButton, IonModal, IonPage, IonRow, IonThumbnail, IonTitle, IonToolbar, IonVirtualScroll } from '@ionic/react';
import { ListePersonne, Personne } from '../model/Personne';
import { SQLiteDBConnection } from 'react-sqlite-hook';
import { sqlite } from '../App';
import { list } from 'ionicons/icons';
import { ListeAllRequete, Requete } from '../model/Requete';

const ListeRequete: React.FC = () => {
    const [list_, setListe] = useState<Requete[]>([]);
    const [loading, setLoading] = useState(true);

    const initialize = async (): Promise<void> => {
        if (loading == true) {
            console.log('Entering initialize');
            try {
                let db: SQLiteDBConnection;
                const ret = await sqlite.checkConnectionsConsistency();
                console.log(ret);
                const isConn = (await sqlite.isConnection("synchronisation", false)).result;
                console.log(isConn);
                if (ret.result && isConn) {
                    db = await sqlite.retrieveConnection("synchronisation", false);
                } else {
                    db = await sqlite.createConnection("synchronisation", false, "no-encryption", 1, false);
                    //await db.open();
                }
                if (!await (await db.isDBOpen()).result) {
                    await db.open();
                }
                setListe(await ListeAllRequete(db));
                await db.close();
                return;
            }
            catch (err) {
                console.log(`Error: ${err}`);
                return;
            }
        }
    }

    const allRequete = list_.map(group => {
        console.log("Test");
        return (
            <IonItem>
                <IonLabel>
                    {group.syntaxe}
                </IonLabel>
                <IonLabel>
                    {group.etat}
                </IonLabel>
            </IonItem>
        )
    })

    function RequeteList() {
        initialize();
        setLoading(false);
        return (
            <IonPage>
                <IonItem lines="none">
                    <IonButtons slot="start">
                        <IonMenuButton></IonMenuButton>
                    </IonButtons>
                    <IonTitle>Liste de tout les requetes</IonTitle>
                </IonItem>
                <IonContent>
                    <IonList>
                        {allRequete}
                    </IonList>
                </IonContent>
            </IonPage>
        );
    }

    return (
        <RequeteList />
    );
};

export default ListeRequete;