import React, { useEffect, useRef, useState } from 'react';
import { IonButton, IonCol, IonContent, IonHeader, IonInput, IonItem, IonLabel, IonPage, IonRow, IonSelect, IonSelectOption, IonThumbnail, IonTitle, IonToolbar } from '@ionic/react';
import { ifExist, InsertPersonne, ListePersonne, Personne } from '../model/Personne';
import { SQLiteDBConnection } from 'react-sqlite-hook';
import { sqlite } from '../App';
import { InsertRequete, Requete } from '../model/Requete';

const InsertForm: React.FC = () => {
    var nom = useRef<HTMLIonInputElement>(null);
    var prenoms = useRef<HTMLIonInputElement>(null);
    var naissance = useRef<HTMLIonInputElement>(null);
    var sexe = useRef<HTMLIonSelectElement>(null);

    // useEffect(() => {
    //     setLoading(true);
    //     fetch('http://localhost:8989/SynchronisationMaitre/RequeteNonSynchroniser')
    //         .then(data => data.json())
    //         .then(res => {
    //             setListe(res);
    //             console.log("Listeee: "+res.syntaxe);
    //             setLoading(false);
    //         })
    // }, [])

    // const allVehicule = list_.map(group => {
    //     console.log("Test");
    //     return (
    //         <IonItem>
    //             <IonThumbnail slot="start">
    //                 <img alt="Silhouette of mountains"
    //                     src="https://ionicframework.com/docs/img/demos/thumbnail.svg" />
    //             </IonThumbnail>
    //             <IonLabel>
    //                 {group.id}
    //             </IonLabel>
    //             <IonLabel>
    //                 {group.syntaxe}
    //             </IonLabel>
    //         </IonItem>
    //     )
    // })

    const Insert = async (): Promise<void> => {
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
            else{
                await db.open();

            }
            const p: Personne = new Personne();
            p.nom = nom.current?.value as string;
            p.prenoms = prenoms.current?.value as string;
            p.dateNaissance = naissance.current?.value as string;
            p.sexe = sexe.current?.value as string;
            const insert = InsertPersonne(db, p);
            InsertRequete(db, await insert);
            let res: Personne[] = await ListePersonne(db);
            // alert(res.length);
            nom.current!.value = "";
            prenoms.current!.value = "";
            naissance.current!.value = "";
            sexe.current!.value = "";
            await db.close();
            return;
        }
        catch (err) {
            console.log(`Error: ${err}`);
            return;
        }
    }
    
    return (
        <div>
            <IonPage>
                <IonHeader>
                    <IonToolbar color='primary'>
                        <IonTitle>Enregistrer une personne</IonTitle>
                    </IonToolbar>
                </IonHeader>
                <IonContent>
                    <div id="login">
                        <form>
                            <IonItem>
                                <IonLabel position="floating"> Nom</IonLabel>
                                <IonInput ref={nom} type="text"></IonInput>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Prenoms</IonLabel>
                                <IonInput ref={prenoms} type="text"></IonInput>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Date de naissance</IonLabel>
                                <br></br>
                                <IonInput ref={naissance} type="date"></IonInput>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Sexe</IonLabel>
                                <IonSelect ref={sexe} interface="popover" placeholder="Selectionnez un sexe">
                                    <IonSelectOption value="Homme">Homme</IonSelectOption>
                                    <IonSelectOption value="Femme">Femme</IonSelectOption>
                                </IonSelect>
                            </IonItem>
                            <IonRow>
                                <IonCol className="ion-text-center">
                                    <IonButton onClick={Insert}>Enregistrer</IonButton>
                                </IonCol>
                            </IonRow>
                        </form>
                    </div >
                </IonContent>
            </IonPage>
        </div>
    );
};

export default InsertForm;