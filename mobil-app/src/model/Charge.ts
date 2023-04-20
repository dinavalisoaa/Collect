import { SQLite, SQLiteObject } from '@ionic-native/sqlite/ngx';
import { SQLitePorter } from '@ionic-native/sqlite-porter/ngx';
export class Charge {
    collect : any
    dateCharge : any
    montant : any

    constructor(parameters : any) {
        this.collect = parameters.collect
        this.dateCharge = parameters.dateCharge
        this.montant = parameters.montant
    }

    /**
     * save
     */
    public save() {
        fetch("http://localhost:8080").then(
            ()=>{
                console.log(this.collect);
                // alert("Calling a web service for " + JSON.stringify(this))
            },
            (error)=>{
                console.log(this.montant+" ARIRAY");
              
                // alert(  "Due to "+ JSON.stringify(error) + ". Adding to database for " + JSON.stringify(this))
            }
        )
    }
}