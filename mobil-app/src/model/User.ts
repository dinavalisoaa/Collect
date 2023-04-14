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
        if(this.login === "admin@gmail.com" && this.password === "admin"){
            return true;
        }
        return false;
    }
}