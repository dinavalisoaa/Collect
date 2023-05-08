import { SQLite } from "@ionic-native/sqlite";

export class TypeCharge {
    id : any
    nom : any

    constructor(data : any){
        this.id = data.id;
        this.nom = data.nom;
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
            await db.executeSql("INSERT INTO typecharge(nom) values (?)",[this.nom]);
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

        let typeCharges = [];
        try {
            let result = await db.executeSql("SELECT * FROM typecharge",[]);
            for (let index = 0; index < result.rows.length; index++) {
                typeCharges.push(result.rows.item(index));
            }
        } catch (error) {
            alert("Error tc : "+JSON.stringify(error));
        }
        
        return typeCharges;
    }
}