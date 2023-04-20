import { SQLiteDBConnection } from "react-sqlite-hook";

export class Requete {
    id: number;
    syntaxe: string;
    etat: number;

    public constructor() {
        this.id = 0;
        this.syntaxe = "";
        this.etat = 0;
    }
}

export const InsertRequete = async (db: SQLiteDBConnection, sql: string) => {
    try {
        await db.run("INSERT INTO Requete (syntaxe, etat) VALUES (?,?)", [sql, 0]);
        return "OK";
    }
    catch (error: any) {
        console.log(error);
        return error;
    }
}

export const ExecuteRequete = async (db: SQLiteDBConnection, sql: string) => {
    try {
        await db.run(sql);
        alert(sql);
        return "OK";
    }
    catch (error: any) {
        console.log(error);
        return error;
    }
}

export const ListeAllRequete = async (db: SQLiteDBConnection) => {
    const qValues = await db.query("SELECT * FROM Requete");
    const req = await qValues.values as Requete[];
    console.log(req);
    return req;
}

export const getAllRequeteNonSynchro = async (db: SQLiteDBConnection) => {
    const qValues = await db.query("SELECT * FROM Requete where etat = 0");
    const req = await qValues.values as Requete[];
    console.log(req);
    return req;
}

export const UpdateState = async (db: SQLiteDBConnection, id: number) => {
    const tab = await db.execute("UPDATE Requete set etat=1 WHERE id=" + id);
}

// export const ListePersonneNonSynchroniser = async (db: SQLiteDBConnection) => {
//     const qValues = await db.query("SELECT * FROM Personne WHERE Etat=0;");
//     const pers = await qValues.values as Personne[];
//     return pers;
// }



