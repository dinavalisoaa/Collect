import { IonButton, IonContent, IonHeader, IonInput, IonItem, IonLabel, IonPage, IonTitle, IonToolbar } from '@ionic/react';
import { SQLiteDBConnection } from 'react-sqlite-hook';
import { sqlite } from '../App';
import { Requete } from '../model/Requete';

const Synchronisation: React.FC = () => {

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
                //await db.open();
            } else {
                db = await sqlite.createConnection("synchronisation", false, "no-encryption", 1, false);
            }
            if (!await (await db.isDBOpen()).result) {
                await db.open();
            }
            const qValues = await db.query("SELECT * FROM Requete WHERE Etat=0");
            var form = new FormData();
            let i = 0;
            let llas: string[] = [];
            qValues.values?.forEach(el => {
                let p: Requete = el;
                form.append("pers", (p.syntaxe) + ";;");
                form.append("ids", p.id + ";;");
                console.log(p.syntaxe)
                fetch("http://localhost:8080/sync", {
                    method: 'POST',
                    body: form
                }).then(res => res.json())./**then(data => data.data as number[]).*/then(async data => {
                    console.log(data.idRecu);
                    await db.execute("update Requete set etat = 1 where id=" + data.idRecu);
                    if (i == 0) {
                        console.log(data.datas);
                        for (let index = 0; index < data.datas.length; index++) {
                            // console.log("Syntaxe recuu: "+data.datas[index].syntaxe.replaceAll("?","'"));
                            const str = data.datas[index].syntaxe.replaceAll("?", "'");
                            if (str.match("insert into")) {
                                await db.run(str);
                            } else {
                                await db.execute(str);
                            }
                            fetch("http://localhost:8080/updateState/" + data.datas[index].id, {
                                method: 'PUT'
                            })
                        }
                    }
                    i++;

                });
                form = new FormData();
            },
            );
        }
        catch (err) {
            console.log(`Error: ${err}`);
            return;
        }

    }
    function traitementSynchro() {
        initialize();
     }

    return (
        <div>
            <IonPage>
                <IonHeader>
                    <IonToolbar color='primary'>
                        <IonTitle>Synchronisation des données</IonTitle>
                    </IonToolbar>
                </IonHeader>
                <IonContent>
                    <IonItem>
                        <IonLabel position="floating">IP</IonLabel>
                        {/* <IonInput ref={ip} type="text"></IonInput> */}
                    </IonItem>
                    <br></br>
                    <IonButton onClick={() => traitementSynchro()}>Synchroniser</IonButton>
                </IonContent>
            </IonPage>
        </div>
    );
};

export default Synchronisation;