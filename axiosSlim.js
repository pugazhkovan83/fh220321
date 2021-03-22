import React from "react";
import Axios from "axios";

const clickEvent = () => {
	Axios.post("http://localhost:8080/register", {
		firstName: "Finn",
		lastName: "Williams",
	}).then(
		(response) => {
			console.log(response);
		},
		(error) => {
			console.log(error);
		}
	);
};

const AxiosSlim = () => {
	return <button onClick={clickEvent}>click</button>;
};

export default AxiosSlim;
