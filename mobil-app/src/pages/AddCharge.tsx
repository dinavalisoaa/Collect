import { IonButton, IonCard, IonCardContent, IonCardHeader, IonCardTitle, IonContent, IonHeader, IonInput, IonItem, IonLabel, IonPage, IonTitle, IonToolbar } from "@ionic/react"
import { useEffect, useState } from "react"
import SessionManagement from "../components/SessionManage";
import { Collection } from "../model/Collection";
import { TypeCharge } from "../model/TypeCharge";

export default function AddCharge() {
    const [collect, setCollect] = useState(1);
    const [dateCharge, setDateCharge] = useState();
    const [montant, setMontant] = useState(0);
    const [charge, setCharge] = useState(0);

    const [typeCharge,setTypeCharge] = useState<any[]>();
    const [collects,setCollectes] = useState<any[]>();



    function addCharge( e: React.FormEvent<HTMLFormElement> ) {
        e.preventDefault();
        let obj = {
            collect : collect,
            dateCharge : dateCharge,
            montant : montant,
            typeCharge : charge
        }

        // new Charge(obj).save().then(()=>{
        //     new Charge({}).findAll()
        // });
    }

    useEffect(()=>{
        let typeCharge : TypeCharge = new TypeCharge({});
        typeCharge.findAll().then((result)=>{
            setTypeCharge(result);
        })

        let collects : Collection = new Collection({});
        collects.findAll().then((result)=>{
            setCollectes(result);
        })
    },[]);

    return (
        <IonPage>
            <IonHeader>
                <IonToolbar>
                <IonTitle>Ajout Charge</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <SessionManagement></SessionManagement>
                <IonCard>
                    <IonCardHeader>
                        <IonCardTitle>Ajout d'un collect</IonCardTitle>
                    </IonCardHeader>
                    <IonCardContent>
                        <form onSubmit={addCharge}>
                            <IonItem>
                                <IonLabel>Collect </IonLabel>
                                <select onSelect={(e:any) => setCollect(e.target.value)}>
                                    {collects?.map((element)=>{
                                        alert(JSON.stringify(element));
                                        return(<option value={element.id}>Collection du {element.dateCollect}</option>)
                                    })}
                                </select>
                            </IonItem>
                            <IonItem>
                                <IonLabel>Date de charge</IonLabel>
                                <IonInput type="date" value={dateCharge} onChange={(e:any) => setDateCharge(e.target.value)} required/>
                            </IonItem>
                            <IonItem>
                                <IonLabel>Type de charge</IonLabel>
                                <select onSelect={(e:any) => setCharge(e.target.value)}>
                                    {typeCharge?.map((element)=>{
                                        return(<option value={element.id}>{element.nom}</option>)
                                    })}
                                </select>
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Montant</IonLabel>
                                <IonInput type="number" value={montant} onChange={(e:any) => setMontant(e.target.value)} required/>
                            </IonItem>
                            <IonButton type="submit" expand="block">Confirmer</IonButton>
                        </form>
                    </IonCardContent>
                </IonCard>
            </IonContent>
        </IonPage>
    )
}