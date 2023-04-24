import { SQLite, SQLiteObject } from "@ionic-native/sqlite";

export class Database {
    public initDB(){
        const tableList = [
            `
                CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    email TEXT UNIQUE NOT NULL,
                    motDePasse TEXT NOT NULL
                )
            `,
            `
                CREATE TABLE IF NOT EXISTS collect (
                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    quantite INTEGER, 
                    dateCollect DATE, 
                    prixUnitaire DOUBLE, 
                    Produitid INTEGER NOT NULL, 
                    PlanningCollect INTEGER NOT NULL, 
                    Collecteurid INTEGER NOT NULL
                )
            `,
            `
                CREATE TABLE IF NOT EXISTS typecharge (
                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    nom TEXT NOT NULL UNIQUE
                )
            `,
            `
                CREATE TABLE IF NOT EXISTS charge (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    collectId INTEGER UNIQUE NOT NULL,
                    dateCharge TIMESTAMP,
                    typeCharge INTEGER,
                    montant DOUBLE
                )
            `,
            `
                CREATE TABLE IF NOT EXISTS Produit (
                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    nom TEXT, 
                    TypeProduitid INTEGER NOT NULL, 
                    Saisonid INTEGER NOT NULL, 
                    dureePeremption DOUBLE, 
                    modeConservation TEXT
                )
            `,
            `
                CREATE TABLE PlanningCollecte (
                    id INTEGER PRIMARY KEY AUTOINCREMENT, 
                    tonnage DOUBLE, 
                    dateDelai DATE, 
                    budget DOUBLE
                )
            `
        ];

        SQLite.create({
            name: 'collect.db',
            location: 'default'
        }).then((db: SQLiteObject) => {
            tableList.forEach((result)=>{
                    db.executeSql(result, []).then(() => {
                }).catch((error: Error) => {
                    alert(JSON.stringify(error))
                    console.error('Error creating table users', error);
                });
            })
        }).catch((error: Error) => {
            alert(JSON.stringify(error))
            console.error('Error creating SQLite database', error);
        });
    }
}