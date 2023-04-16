import { IonButton, IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from "@ionic/react"
import { useState } from "react"
import { Link } from "react-router-dom";
import SessionManagement from "../components/SessionManage";
import { Collection } from "../model/Collection";

export default function AddCollect() {
    const [produit, setProduit] = useState(1);
    const [dateCollect, setDate] = useState();
    const [pointCollect, setPointCollect] = useState(1);
    const [quantite, setQuantite] = useState(0);
    const [pu, setPU] = useState(0);

    function addCollect( e: React.FormEvent<HTMLFormElement> ) {
        e.preventDefault();

        let obj = {
            produit : produit,
            dateCollect : dateCollect,
            point : pointCollect,
            quantite : quantite,
            pu : pu,
            collectionerId : localStorage.getItem("adminId")
        }

        new Collection(obj).save();
    }

    return (
        <IonPage>
            <IonHeader>
                <IonToolbar>
                <IonTitle>Ajouter une collect</IonTitle>
                </IonToolbar>
            </IonHeader>
            <IonContent fullscreen>
                <SessionManagement></SessionManagement>
                <form onSubmit={addCollect}>
                    <div>
                        <label>Produit</label>
                        <select onSelect={(e:any) => setProduit(e.target.value)}>
                            <option value={1}>Manioc</option>
                        </select>
                    </div>
                    <div>
                        <label>Date</label>
                        <input type="date" value={dateCollect} onChange={(e:any) => setDate(e.target.value)} required/>
                    </div>
                    <div>
                        <label>Prix Unitaire</label>
                        <input type="number" value={pu} onChange={(e:any) => setPU(e.target.value)} required/>
                    </div>
                    <div>
                        <label>Quantite</label>
                        <input type="number" value={quantite} onChange={(e:any) => setQuantite(e.target.value)} required/>
                    </div>
                    <div>
                        <label>Point de collect</label>
                        <select onSelect={(e:any) => setPointCollect(e.target.value)}>
                            <option value={1}>Andavamamba</option>
                        </select>
                    </div>
                    <IonButton type="submit" expand="block">Login</IonButton>
                </form>
                <Link to="/add-charge"> Ajouter une charge </Link>
            </IonContent>
        </IonPage>
    )
}