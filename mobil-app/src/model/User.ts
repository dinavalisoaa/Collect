export class User {
    login : any;
    password : any;

    constructor(login: any, password : any) {
        // Creation de la table user si existe
        this.login = login;
        this.password = password;
    }

    /**
     * tryLogin
     */
    public tryLogin() {
        // selection dans la base
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