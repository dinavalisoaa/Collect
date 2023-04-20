import React, { useEffect, useRef, useState } from 'react';
import { IonButton, IonButtons, IonCol, IonContent, IonHeader, IonIcon, IonInput, IonItem, IonLabel, IonList, IonMenuButton, IonModal, IonPage, IonRow, IonSelect, IonSelectOption, IonThumbnail, IonTitle, IonToolbar, IonVirtualScroll, useIonViewWillEnter } from '@ionic/react';
import { DeletePersonne, getPersonneById, ListePersonne, Personne, UpdatePersonne } from '../model/Personne';
import { SQLiteDBConnection } from 'react-sqlite-hook';
import { sqlite } from '../App';
import { list, pencil, trashBin } from 'ionicons/icons';
import { InsertRequete, ListeAllRequete, Requete } from '../model/Requete';

const Liste: React.FC = () => {
    const [list_, setListe] = useState<Personne[]>([]);
    const [personne, setPersonne] = useState<Personne>();
    const [loading, setLoading] = useState(true);
    const [updateModal, setUpdateModal] = useState(false);
    var nom = useRef<HTMLIonInputElement>(null);
    var prenoms = useRef<HTMLIonInputElement>(null);
    var naissance = useRef<HTMLIonInputElement>(null);
    var sexe = useRef<HTMLIonSelectElement>(null);
    const [idPers, setIdPers] = useState(0);
    const ref = useRef(false);
    const modal = useRef<HTMLIonModalElement>(null);
    const page = useRef(undefined);
    const [presentingElement, setPresentingElement] = useState<HTMLElement | undefined>(undefined);


    useEffect(() => {
        setPresentingElement(page.current);
    }, []);

    const initialize = async (): Promise<void> => {
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
                let res: Personne[] = await ListePersonne(db);
                setListe(res);    
                await db.close();
                return;
            }
            catch (err) {
                console.log(`Error: ${err}`);
                return;
            }
    }

    useIonViewWillEnter(() => {
        initialize();

        if (ref.current === false) {
            initialize();
            ref.current = true;
        }
    });

    const updatePersonne = async (): Promise<void> => {
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
            const p: Personne = new Personne();
            p.nom = nom.current?.value as string;
            p.prenoms = prenoms.current?.value as string;
            p.dateNaissance = naissance.current?.value as string;
            p.sexe = sexe.current?.value as string;
            p.id = idPers;
            const update = UpdatePersonne(db, p);
            console.log("Requete update: "+update);
            InsertRequete(db, await update);
            // let res: Requete[] = await ListeAllRequete(db);
            //alert(res.length);
            initialize();
            await db.close();
            return;
        }
        catch (err) {
            console.log(`Error: ${err}`);
            return;
        }            
        
    }

    const deletePersonne = async (idPersonne: number): Promise<void> => {
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
            }
            if (!await (await db.isDBOpen()).result) {
                await db.open();
            }
            const p: Personne = new Personne();
            p.id = idPersonne;
            const suppr = DeletePersonne(db, p);
            console.log("Requete delete: " + suppr);
            InsertRequete(db, await suppr);
            // let res: Requete[] = await ListeAllRequete(db);
            initialize();
            await db.close();
            return;
        }
        catch (err) {
            console.log(`Error: ${err}`);
            return;
        }    
    }

    const getPersonne = async (id: number): Promise<void> => {
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
            setPersonne(await getPersonneById(db, id));
            console.log("Personne: " + personne);
            await db.close();
            return;
        }
        catch (err) {
            console.log(`Error: ${err}`);
            return;
        }        
    }

    function ModificationForm() {
        return (
            <IonModal isOpen={updateModal} ref={modal} presentingElement={presentingElement}>
                <IonHeader>
                    <IonToolbar color='primary'>
                        <IonTitle>Modification</IonTitle>
                    </IonToolbar>
                </IonHeader>
                <IonContent>
                    <div id="login">
                        <form>
                            <IonItem>
                                <IonLabel position="floating"> Nom</IonLabel>
                                <IonInput ref={nom} value={personne?.nom} type="text"></IonInput>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Prenoms</IonLabel>
                                <IonInput ref={prenoms} value={personne?.prenoms} type="text"></IonInput>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Date de naissance</IonLabel>
                                <br></br>
                                <IonInput ref={naissance} value={personne?.dateNaissance} type="date"></IonInput>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Sexe</IonLabel>
                                <IonSelect ref={sexe} interface="popover" value={personne?.sexe} placeholder="Selectionnez un sexe">
                                    <IonSelectOption value="Homme">Homme</IonSelectOption>
                                    <IonSelectOption value="Femme">Femme</IonSelectOption>
                                </IonSelect>
                            </IonItem>
                            <IonRow>
                                <IonCol className="ion-text-center">
                                    <IonButton color="danger" onClick={() => dismissModal()}>Annuler</IonButton>
                                    <IonButton onClick={updatePersonne}>Modifier</IonButton>
                                </IonCol>
                            </IonRow>
                            <span id="erreur"></span>
                        </form>
                    </div >
                </IonContent>
            </IonModal>
        );
    }

    function dismissModal() {
        // modal.current?.dismiss();
        window.location.reload();
    };

    function loadModal(id: any) {
        getPersonne(id);
        setUpdateModal(true);
        setIdPers(id);
    };

    // function loadDelete(id: any) {
    //     setIdPers(id);
    //     alert("idPers: "+idPers);
    //     deletePersonne();
    // };

    const allPersonne = list_.map(group => {
        console.log("Test");
        return (
            <IonItem>
                {/* <IonThumbnail slot="start">
                    <img alt="Silhouette of mountains"
                        src="https://ionicframework.com/docs/img/demos/thumbnail.svg" />
                </IonThumbnail> */}
                <IonLabel>
                    {group.nom}
                </IonLabel>
                <IonLabel>
                    {group.prenoms}
                </IonLabel>
                <IonLabel>
                    {group.dateNaissance}
                </IonLabel>
                <IonLabel>
                    {group.sexe}
                </IonLabel>
                <IonItem routerDirection="none" lines="none" detail={false} >
                    <IonButton fill="outline" color="success" onClick={() => loadModal(group.id)} >
                        <IonIcon icon={pencil}></IonIcon>
                    </IonButton>
                </IonItem>
                <IonItem routerDirection="none" lines="none" detail={false} >
                    <IonButton fill="outline" color="danger" onClick={() => deletePersonne(group.id)} >
                        <IonIcon icon={trashBin}></IonIcon>
                    </IonButton>
                </IonItem>
            </IonItem>        
        )
    })

    // const PersonneList=(()=>{
    //     // initialize();
    //     // setLoading(false);
    //     return (
    //         <IonPage>
    //             <IonItem lines="none">
    //                 <IonButtons slot="start">
    //                     <IonMenuButton></IonMenuButton>
    //                 </IonButtons>
    //                 <IonTitle>Liste de toutes les personnes enregistrées</IonTitle>
    //             </IonItem>
    //             <IonContent>
    //                 <IonList>
    //                     {allPersonne}
    //                 </IonList>
    //             </IonContent>
    //             <ModificationForm />
    //         </IonPage>
    //     );
    // });
    
    return (
        <>
        <IonPage ref={page}>
            <IonContent>
                <IonItem lines="none">
                    <IonButtons slot="start">
                        <IonMenuButton></IonMenuButton>
                    </IonButtons>
                    <IonTitle>Liste de toutes les personnes enregistrées</IonTitle>
                </IonItem>
                <IonList>
                    {allPersonne}
                </IonList>
            </IonContent>
        </IonPage>
        <ModificationForm />
        </>
    );
};

export default Liste;