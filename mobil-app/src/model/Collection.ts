import { SQLite } from "@ionic-native/sqlite"

export class Collection {
    produit : any
    dateCollect : any
    quantite : any
    prixUnitaire : any 
    planningCollect : any 
    Collecteurid : any

    constructor(parameters : any) {

        this.produit = parameters.produit
        this.dateCollect = parameters.dateCollect
        this.quantite = parameters.quantite
        this.prixUnitaire = parameters.prixUnitaire
        this.planningCollect = parameters.planningCollect
        this.Collecteurid = parameters.Collecteurid
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
            await db.executeSql(`INSERT INTO collect(Produitid,dateCollect, quantite, prixUnitaire, PlanningCollect, Collecteurid) values (?,?,?,?,?,?)`,[this.produit, this.dateCollect, this.quantite, this.prixUnitaire, this.planningCollect, this.Collecteurid]);
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
            let result = await db.executeSql("SELECT * FROM collect",[]);
            for (let index = 0; index < result.rows.length; index++) {
                produits.push(result.rows.item(index));
            }
        } catch (error) {
            alert("Error : " + JSON.stringify(error));
        }
        
        return produits;
    }
}