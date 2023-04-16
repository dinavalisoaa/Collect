import { Redirect, Route } from 'react-router-dom';
import { IonApp, IonContent, IonRouterOutlet, setupIonicReact } from '@ionic/react';
import { IonReactRouter } from '@ionic/react-router';
import Home from './pages/Home';

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
import Login from './pages/Login';
import AddCollect from './pages/AddCollect';
import AddCharge from './pages/AddCharge';
import SidebarMenu from './components/Menu';

setupIonicReact();

const App: React.FC = () => { 
	const handleDeconnection = ()=>{
		localStorage.removeItem("admin");
	}

  	return (
		<IonApp>
			<SidebarMenu onDeconnexion={handleDeconnection} />
			<IonContent>
				<IonReactRouter>
					<IonRouterOutlet id="main-content">
						<Route exact path="/home">
							<Home />
						</Route>
						<Route exact path="/add-collect">
							<AddCollect />
						</Route>
						<Route exact path="/add-charge">
							<AddCharge />
						</Route>
						<Route exact path="/login">
							<Login />
						</Route>
						<Route exact path="/">
							<Redirect to="/login" />
						</Route>
					</IonRouterOutlet>
				</IonReactRouter>
			</IonContent>
		</IonApp>
	)
};

export default App;
