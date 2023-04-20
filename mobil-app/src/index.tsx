import React, { HTMLAttributes } from 'react';
import { createRoot } from 'react-dom/client';
import App from './App';
import * as serviceWorkerRegistration from './serviceWorkerRegistration';
import reportWebVitals from './reportWebVitals';
import { defineCustomElements as jeepSqlite, applyPolyfills, JSX as LocalJSX } from "jeep-sqlite/loader";
import { Capacitor } from '@capacitor/core';
import { CapacitorSQLite, SQLiteConnection, SQLiteDBConnection } from '@capacitor-community/sqlite';
type StencilToReact<T> = {
  [P in keyof T]?: T[P] & Omit<HTMLAttributes<Element>, 'className'> & {
    class?: string;
  };
};

declare global {
  export namespace JSX {
    interface IntrinsicElements extends StencilToReact<LocalJSX.IntrinsicElements> {
    }
  }
}

applyPolyfills().then(() => {
  jeepSqlite(window);
});
window.addEventListener('DOMContentLoaded', async () => {
  console.log('$$$ in index $$$');
  const platform = Capacitor.getPlatform();
  const sqlite: SQLiteConnection = new SQLiteConnection(CapacitorSQLite)
  try {
    if (platform === "web") {
      const jeepEl = document.createElement("jeep-sqlite");
      document.body.appendChild(jeepEl);
      await customElements.whenDefined('jeep-sqlite');
      await sqlite.initWebStore();
    }
    const ret = await sqlite.checkConnectionsConsistency();
    console.log(ret);
    const isConn = (await sqlite.isConnection("synchronisation", false)).result;
    console.log(isConn);
    var db: SQLiteDBConnection
    if (ret.result && isConn) {
      db = await sqlite.retrieveConnection("synchronisation", false);
    } else {
      db = await sqlite.createConnection("synchronisation", false, "no-encryption", 1, false);
    }
    console.log(db);
    let q1 = `
        DROP TABLE Personne`;
    let q2 = `
        DROP TABLE Requete`;
    await db.open();
    let q = `
        CREATE TABLE IF NOT EXISTS Personne (
          id INTEGER PRIMARY KEY,
          nom VARCHAR(255) NOT NULL,
          prenoms VARCHAR(255),
          dateNaissance VARCHAR(255),
          sexe VARCHAR(255)
        );`
    let qSynchro = `
      CREATE TABLE IF NOT EXISTS Requete (
        id INTEGER PRIMARY KEY,
        syntaxe VARCHAR(255),
        etat INTEGER
      );`

      
    await db.execute(q);
    await db.execute(qSynchro);
    await db.close();
    await sqlite.closeConnection("synchronisation", false);

// -----------------------------------------------------------------------------------------------------------

    const container = document.getElementById('root');
    const root = createRoot(container!);
    root.render(
      <React.StrictMode>
        <App />
      </React.StrictMode>
    );

    // If you want your app to work offline and load faster, you can change
    // unregister() to register() below. Note this comes with some pitfalls.
    // Learn more about service workers: https://cra.link/PWA
    serviceWorkerRegistration.unregister();

    // If you want to start measuring performance in your app, pass a function
    // to log results (for example: reportWebVitals(console.log))
    // or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
    reportWebVitals();
  } catch(err){
    console.log(`Error: ${err}`);
    throw new Error(`Error: ${err}`);
  }
});