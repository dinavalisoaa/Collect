export class Collection {
    produit : any
    dateCollect : any
    point : any
    quantite : any
    pu : any 
    collectionerId : any

    constructor(parameters : any) {
        this.produit = parameters.produit
        this.dateCollect = parameters.dateCollect
        this.point = parameters.pointCollect
        this.quantite = parameters.quantite
        this.pu = parameters.pu
        this.collectionerId = parameters.collectionerId
    }

    /**
     * save
     */
    public save() {
        fetch("http://localhost:8080").then(
            ()=>{
                alert("Calling a web service")
            },
            (error)=>{
                alert("Due to "+ JSON.stringify(error) + ". Adding to database")
            }
        )
    }
}