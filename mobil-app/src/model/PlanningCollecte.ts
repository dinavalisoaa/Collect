import { SQLite } from "@ionic-native/sqlite";

export class PlanningCollecte {
    id : any 
    tonnage : any 
    dateDelai :any 
    budget : any

    constructor(parameters : any) {
        this.id = parameters.id;
        this.tonnage = parameters.tonnage;
        this.dateDelai = parameters.dateDelai;
        this.budget = parameters.budget;
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
            await db.executeSql("INSERT INTO PlanningCollecte(tonnage,dateDelai, budget) values (?,?,?)",[this.tonnage, this.dateDelai, this.budget]);
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