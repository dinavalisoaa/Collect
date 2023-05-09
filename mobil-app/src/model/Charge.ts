import { SQLite } from "@ionic-native/sqlite"

export class Charge {
    collect : any
    dateCharge : any
    montant : any
    typeCharge : any

    constructor(parameters : any) {
        this.collect = parameters.collect
        this.dateCharge = parameters.dateCharge
        this.montant = parameters.montant
        this.typeCharge = parameters.typeCharge
    }

    /**
     * save
     */
    public async save() {
        let db = await SQLite.create({
            name: 'collect.db',
            location: 'default' 
        })

        try {
            await db.executeSql("INSERT INTO charge(collectId, dateCharge, typeCharge, montant) VALUES (?,?,?,?)",[this.collect, this.dateCharge, this.typeCharge, this.montant]);
        } catch (error) {
            alert(JSON.stringify(error));
        }
    }

    /**
     * findAll
     */
    public async findAll() {
        let db = await SQLite.create({
            name: 'collect.db',
            location: 'default' 
        })

        const charges = [];
        try {
            let charge = await db.executeSql("SELECT * FROM charge",[]);
            for (let index = 0; index < charge.rows.length; index++) {
                charges.push(charge.rows.item(index));
            }
        } catch (error) {
            alert(JSON.stringify(error));
        }

        return charges;
    }
}