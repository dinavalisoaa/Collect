import { SQLite, SQLiteObject } from '@ionic-native/sqlite';
// import { SQLitePorter } from '@ionic-native/sqlite-porter';

export class User {
    login : any;
    password : any;

    constructor(login: any, password : any) {
        // Creation de la table user si existe
        // SQLite.create({
        //     name: 'collect.db',
        //     location: 'default'
        // }).then((db: SQLiteObject) => {
        //     db.executeSql(
        //         `
        //             INSERT INTO users(email, motDePasse) VALUES (?,?)
        //         `
        //         , ['admin@gmail.com','admin']).then((resutl) => {
        //             alert(JSON.stringify(resutl));
        //     }).catch((error: Error) => {
        //         alert(JSON.stringify(error))
        //         console.error('Error creating table users', error);
        //     });
        // }).catch((error: Error) => {
        //     alert(JSON.stringify(error))
        //     console.error('Error creating SQLite database', error);
        // });
        this.login = login;
        this.password = password;
    }

    /**
     * tryLogin
     */
    public async tryLogin() {
        // selection dans la base
        let db = await SQLite.create({
            name: 'collect.db',
            location: 'default' 
        })

        let result = await db.executeSql("SELECT id,email FROM users WHERE email=? AND motDePasse=?",[this.login, this.password]);

        alert(JSON.stringify(result.rows));
        let user = {
            id : "1",
            nom : "Aina",
            login : "admin@gmail.com",
            password : "admin"
        }
        if(this.login === user.login && this.password === user.password){
            localStorage.setItem("admin",JSON.stringify({id : user.id, nom : user.nom}));
            return true;
        }
        return false;
    }
}