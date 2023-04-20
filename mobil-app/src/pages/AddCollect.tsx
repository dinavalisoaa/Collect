import { IonButton, IonCard, IonCardContent, IonCardHeader, IonCardTitle, IonContent, IonHeader, IonIcon, IonInput, IonItem, IonLabel, IonPage, IonSelect, IonSelectOption, IonTitle, IonToolbar } from "@ionic/react"
import { addOutline } from "ionicons/icons";
import { useState } from "react"
import { useForm } from "react-hook-form";
import { Link } from "react-router-dom";
import SessionManagement from "../components/SessionManage";
import { Collection } from "../model/Collection";

export default function AddCollect() {
    const [produit, setProduit] = useState(1);
    const [dateCollect, setDate] = useState();
    const [pointCollect, setPointCollect] = useState(1);
    const [quantite, setQuantite] = useState(0);
    const [pu, setPU] = useState(0);

    function addCollect(e: React.FormEvent<HTMLFormElement>) {
        e.preventDefault();

        let obj = {
            produit: produit,
            dateCollect: dateCollect,
            point: pointCollect,
            quantite: quantite,
            pu: pu,
            collectionerId: localStorage.getItem("adminId")
        }

        new Collection(obj).save();
    }
    const { control, handleSubmit } = useForm();

    const registerUser = (data: any) => {
        console.log(pu);
        //     addEnchere();
        //     // setOk(true);
        //   }
        //   useEffect(() => {
        //     log();

        //   }, []);
    }

    return (
        <IonPage>
            <IonHeader>
                <IonToolbar>
                    <IonTitle>Collect</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <SessionManagement></SessionManagement>
                <IonCard>
                    <IonCardHeader>
                        <IonCardTitle>Ajout d'un collect</IonCardTitle>
                    </IonCardHeader>
                    <IonCardContent>
                        <form onSubmit={addCollect}>
                            <IonItem>
                                <IonLabel>Produit</IonLabel>
                                <IonSelect name="CategorieId" value={produit} placeholder="Categorie" onIonChange={(e: any) => { setProduit((e.target.value)); }}>
                                    <IonSelectOption value={1}>BLLA</IonSelectOption>

                                </IonSelect>
                              
                            </IonItem>
                            <IonItem>
                                <IonLabel>Date</IonLabel>
                                <IonInput type="date" value={dateCollect} onIonChange={(e: any) => setDate(e.target.value)} className="text-center" required />
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Prix Unitaire</IonLabel>
                                <IonInput type="number" value={pu} onIonChange={(e: any) => setPU(e.target.value)} required />
                            </IonItem>
                            <IonItem>
                                <IonLabel position="floating">Quantite</IonLabel>
                                <IonInput type="number" value={quantite} onIonChange={(e: any) => setQuantite(e.target.value)} required />
                            </IonItem>
                            <IonItem>
                                <IonLabel>Point de collect</IonLabel>
                                <IonSelect name="CategorieId" value={produit} placeholder="Categorie" onIonChange={(e: any) => { setPointCollect((e.target.value)); }}>
                                    <IonSelectOption value={1}>BLLA</IonSelectOption>

                                </IonSelect>
                              
                            </IonItem>
                            <IonButton type="submit" expand="block">
                                <IonIcon icon={addOutline} />Add
                            </IonButton>
                        </form>
                    </IonCardContent>
                </IonCard>
                {/* <Link to="/add-charge"> Ajouter une charge </Link> */}
            </IonContent>
        </IonPage>
    )
}