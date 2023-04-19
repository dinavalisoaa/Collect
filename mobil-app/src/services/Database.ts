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
                    label TEXT NOT NULL
                )
            `,
            `
                CREATE TABLE IF NOT EXISTS charge (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    collectId INTEGER UNIQUE NOT NULL,
                    dateCollect TIMESTAMP,
                    typeCharge INTEGER,
                    montant DOUBLE
                )
            `
        ];

        SQLite.create({
            name: 'collect.db',
            location: 'default'
        }).then((db: SQLiteObject) => {
            tableList.forEach((result)=>{
                    db.executeSql(result, []).then(() => {
                    // alert(JSON.stringify())
                    alert("executed "+ result);
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