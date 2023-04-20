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
        
    }
}