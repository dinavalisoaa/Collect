import { IonButton, IonContent, IonInput, IonItem, IonLabel, IonPage, NavContext, useIonToast } from '@ionic/react';
import { useCallback, useContext, useState } from 'react';
import { User } from '../model/User';
import './Login.css';

const Login: React.FC = () => {

	
	const [email, setEmail] = useState('');
	const [password, setPassword] = useState('');
	const [present] = useIonToast();
	const {navigate} = useContext(NavContext);

	const redirect = useCallback(
		() => navigate("/add-collect", 'root'),[navigate]
	)

	const presentToast = (position: 'top' | 'middle' | 'bottom') => {
		present({
			message: 'Verifier votre login ou mot de passe',
			duration: 1500,
			position: position
		});
	};

	const handleLogin = (e: React.FormEvent<HTMLFormElement>) => {
		e.preventDefault();

		let user = new User(email, password);

		if(!user.tryLogin()){
			presentToast("bottom");
		} else {
			redirect();
		}
	}

	return (
		<IonPage>
			<IonContent fullscreen>
				<form onSubmit={handleLogin}>
					<IonItem>
						<IonLabel position="floating">Email</IonLabel>
						<IonInput type="email" value={email} onIonChange={e => setEmail(e.detail.value!)} required/>
					</IonItem>
					<IonItem>
						<IonLabel position="floating">Password</IonLabel>
						<IonInput type="password" value={password} onIonChange={e => setPassword(e.detail.value!)} required />
					</IonItem>
					<IonButton type="submit" expand="block">Login</IonButton>
				</form>
			</IonContent>
		</IonPage>
	);
};

export default Login;
