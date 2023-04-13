import { IonButton, IonContent, IonInput, IonItem, IonLabel, IonPage, IonText, IonToast, useIonToast } from '@ionic/react';
import { SQLite } from 'cordova-sqlite-storage';
import { useState } from 'react';
import './Login.css';

const Login: React.FC = () => {

	
	const [email, setEmail] = useState('');
	const [password, setPassword] = useState('');
	const [present] = useIonToast();

	const presentToast = (position: 'top' | 'middle' | 'bottom') => {
		present({
			message: 'Verifier votre login ou mot de passe',
			duration: 1500,
			position: position
		});
	};

	const handleLogin = (e: React.FormEvent<HTMLFormElement>) => {
		e.preventDefault();

		if (email === 'example@example.com' && password === 'password') {
			// Login successful
		} else {
			// Login failed
			presentToast('bottom')
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
