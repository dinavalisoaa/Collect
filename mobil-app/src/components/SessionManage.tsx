import { NavContext, useIonToast } from "@ionic/react";
import { useContext, useCallback, useEffect } from "react";

const SessionManagement = () => {
	const {navigate} = useContext(NavContext);
	const [present] = useIonToast();

	const redirect = useCallback(
		() => navigate("/login", 'back'),[navigate]
	)
	
	const presentToast = (position: 'top' | 'middle' | 'bottom') => {
		present({
			message: 'Deconnecter',
			duration: 1500,
			position: position
		});
	};

	useEffect(()=> {
		const intervalId = setInterval(()=>{
			console.log(localStorage.getItem("admin"))
			if(localStorage.getItem("admin") === null){
				presentToast("bottom");
				redirect();
			}
		},2000);

		return () => {
			clearInterval(intervalId);
		}
	},[])
	

	return (
		<>
		</>
	);
};

export default SessionManagement;
