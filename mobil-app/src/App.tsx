import { Redirect, Route } from 'react-router-dom';
import {
  IonApp,
  IonIcon,
  IonLabel,
  IonRouterOutlet,
  IonTabBar,
  IonTabButton,
  IonTabs,
  setupIonicReact
} from '@ionic/react';
import { IonReactRouter } from '@ionic/react-router';
import { list, pencil, person, save, sync } from 'ionicons/icons';
/* Core CSS required for Ionic components to work properly */
import '@ionic/react/css/core.css';

/* Basic CSS for apps built with Ionic */
import '@ionic/react/css/normalize.css';
import '@ionic/react/css/structure.css';
import '@ionic/react/css/typography.css';

/* Optional CSS utils that can be commented out */
import '@ionic/react/css/padding.css';
import '@ionic/react/css/float-elements.css';
import '@ionic/react/css/text-alignment.css';
import '@ionic/react/css/text-transformation.css';
import '@ionic/react/css/flex-utils.css';
import '@ionic/react/css/display.css';

/* Theme variables */
import './theme/variables.css';
import DetailVehicule from './pages/DetailVehicule';
import InsertForm from './pages/InsertForm';
import { SQLiteHook, useSQLite } from 'react-sqlite-hook';
import { useState } from 'react';
import Liste from './pages/Liste';
import ListeRequete from './pages/ListeRequete';
import Synchronisation from './pages/Synchronisation';

interface JsonListenerInterface {
  jsonListeners: boolean,
  setJsonListeners: React.Dispatch<React.SetStateAction<boolean>>,
}
interface existingConnInterface {
  existConn: boolean,
  setExistConn: React.Dispatch<React.SetStateAction<boolean>>,
}

// Singleton SQLite Hook
export let sqlite: SQLiteHook;
// Existing Connections Store
export let existingConn: existingConnInterface;
// Is Json Listeners used
export let isJsonListeners: JsonListenerInterface;

setupIonicReact();

const App: React.FC = () => {
  const [existConn, setExistConn] = useState(false);
  existingConn = { existConn: existConn, setExistConn: setExistConn };

  sqlite = useSQLite();
  console.log(`$$$ in App sqlite.isAvailable  ${sqlite.isAvailable} $$$`);
  return(
    <IonApp>
      <IonReactRouter>
        <IonTabs>
          <IonRouterOutlet>
            <Route exact path="/vehicules/:idVehicule">
              <DetailVehicule />
            </Route>
            <Route exact path="/personnes">
              <Liste />
            </Route>
            <Route exact path="/requetes">
              <ListeRequete />
            </Route>
            <Route exact path="/synchronisation">
              <Synchronisation />
            </Route>
            <Route exact path="/InsertForm">
              <InsertForm />
            </Route>
            <Route exact path="/">
              <Redirect to="/InsertForm" />
            </Route>
          </IonRouterOutlet>

          <IonTabBar slot="bottom">
            <IonTabButton tab="liste" href="/personnes">
              <IonIcon icon={person} />
              <IonLabel>Liste</IonLabel>
            </IonTabButton>
            <IonTabButton tab="requete" href="/requetes">
              <IonIcon icon={list} />
              <IonLabel>Requete</IonLabel>
            </IonTabButton>
            <IonTabButton tab="synchronisation" href="/synchronisation">
              <IonIcon icon={sync} />
              <IonLabel>Synchronisation</IonLabel>
            </IonTabButton>
            <IonTabButton tab="form" href="/InsertForm">
              <IonIcon icon={save} />
              <IonLabel>Enregistrement</IonLabel>
            </IonTabButton>
          </IonTabBar>

        </IonTabs>
      </IonReactRouter>
    </IonApp>
  );
};

export default App;
