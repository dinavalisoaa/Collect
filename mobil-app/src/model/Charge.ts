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
                alert("Calling a web service for " + JSON.stringify(this))
            },
            (error)=>{
                alert("Due to "+ JSON.stringify(error) + ". Adding to database for " + JSON.stringify(this))
            }
        )
    }
}