import { SQLite } from "@ionic-native/sqlite"

export class Produit {
    id : any
    nom : any 
    TypeProduitid : any 
    Saisonid : any
    dureePeremption : any
    modeConservation : any


    constructor(data : any){
        this.id = data.id;
        this.nom = data.nom;
        this.TypeProduitid = data.TypeProduitid;
        this.Saisonid = data.Saisonid;
        this.dureePeremption = data.dureePeremption;
        this.modeConservation = data.modeConservation;
    }
    
    /**
     * create
     */
    public async create() {
        let db = await SQLite.create({
            name: 'collect.db',
            location: 'default' 
        })

        try {
            await db.executeSql("INSERT INTO produit(nom,TypeProduitid, Saisonid, dureePeremption, modeConservation) values (?,?,?,?,?)",[this.nom, this.TypeProduitid, this.Saisonid, this.dureePeremption, this.modeConservation]);
        } catch (error) {
            alert(JSON.stringify(error));
        }
    }

    /**
     * find
     */
    public async findAll() {
        let db = await SQLite.create({
            name: 'collect.db',
            location: 'default' 
        })

        let produits = [];
        try {
            let result = await db.executeSql("SELECT * FROM produit",[]);
            for (let index = 0; index < result.rows.length; index++) {
                produits.push(result.rows.item(index));
            }
        } catch (error) {
            alert(JSON.stringify(error));
        }
        
        return produits;
    }
}