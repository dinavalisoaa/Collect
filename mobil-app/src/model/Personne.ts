import { SQLiteDBConnection } from "react-sqlite-hook";

export class Personne {
    id: number;
    nom: string;   
    prenoms: string;
    dateNaissance: string;
    sexe: string;

    public constructor() {
        this.id = 0;
        this.nom = "";
        this.prenoms = "";
        this.dateNaissance = "";
        this.sexe = "";
    }
}


// export const veriftabPersonne = async (db: SQLiteDBConnection) => {
//     const tab = await db.query("SELECT name FROM sqlite_master WHERE type='table' AND name='Personne';");
//     //const Val = await db.query("SELECT * FROM Personne");
//     const qValues = await tab.values?.length;
//     //console.log(Val.values);
//     if (qValues == 0) return false;
//     return true;
// }

export const ifExist = async (db: SQLiteDBConnection, p: Personne) => {
    const tab = await db.query("SELECT * FROM Personne WHERE nom=? AND prenoms=? AND dateNaissance=? AND sexe=?;", [p.nom, p.prenoms, p.dateNaissance, p.sexe]);
    const pers = await tab.values as Personne[];
    const qValues = pers.length;
    if (qValues == 0){
        return false;
    } 
    return true;
}

export const getLastId = async (db: SQLiteDBConnection) => {
    const tab = await db.query("SELECT * FROM Personne ORDER BY id DESC LIMIT 1");
    const pers = await tab.values as Personne[];
    const all = ListePersonne(db);
    let qValues: number = 0;
    if((await all).length == 0){
        qValues = 1;
    }
    else{
        qValues = pers[0].id;
    }
    return qValues;
}

export const InsertPersonne = async (db: SQLiteDBConnection, p: Personne) => {
    try {
        const id = await getLastId(db) + 2;
        const sql = "INSERT INTO Personne (id,nom,prenoms,dateNaissance,sexe) VALUES ("+ id + ",'" + p.nom +"','"+ p.prenoms +"','"+ p.dateNaissance +"','"+ p.sexe +"')";
        await db.run(sql);
        return sql;
    }
    catch (error: any) {
        console.log(error);
        return error;
    }
}

export const UpdatePersonne = async (db: SQLiteDBConnection, p: Personne) => {
    try {
        const sql = "UPDATE Personne SET nom='"+ p.nom +"',prenoms='"+ p.prenoms +"',dateNaissance='"+ p.dateNaissance +"',sexe='"+ p.sexe +"' WHERE id="+ p.id;
        await db.execute(sql);
        return sql;
    }
    catch (error: any) {
        console.log(error);
        return error;
    }
}

export const DeletePersonne = async (db: SQLiteDBConnection, p: Personne) => {
    try {
        const sql = "DELETE FROM Personne WHERE id=" + p.id;
        await db.execute(sql);
        return sql;
    }
    catch (error: any) {
        console.log(error);
        return error;
    }
}

export const ListePersonne = async (db: SQLiteDBConnection) => {
    const qValues = await db.query("SELECT * FROM Personne");
    const pers = await qValues.values as Personne[];
    console.log(pers);
    return pers;
}

export const getPersonneById = async (db: SQLiteDBConnection, id: number) => {
    const qValues = await db.query("SELECT * FROM Personne WHERE id = "+ id);
    const pers = await qValues.values as Personne[];
    return pers[0];
}



