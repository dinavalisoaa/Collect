import { NavContext } from "@ionic/react";
import { useContext, useCallback } from "react";

const ExploreContainer = () => {
	const {navigate} = useContext(NavContext);

	const redirect = useCallback(
		() => navigate("/login", 'back'),[navigate]
	)
	
	if(localStorage.getItem("admin") === null || localStorage.getItem("admin") === undefined){
		redirect();
	}

	return (
		<>
		</>
	);
};

export default ExploreContainer;
