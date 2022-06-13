const username = document.querySelector('.username input').value;
if((username.length) > 0){
	fetch(BASE_URL + "check_username/"  + username).then(onResponseUsername).then(onUsername);
}

function onResponseUsername(response) {
	return response.json();
}


function onUsername(json){
	
	if(json.gia_presente == true){
		document.querySelector('.username span').textContent = "Username già presente";
	}

	const password = document.querySelector('.password input').value;
	const confirm_password = document.querySelector('.confirm_password input').value;

	if((password.length) > 0 && (confirm_password.length) > 0){

		if((password.length) < 8){
			document.querySelector('.password span').textContent = "Caratteri password insufficienti";
		}
		else if(!/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,16}$/.test(password)) {
				document.querySelector('.password span').textContent = "La password non rispetta le specifiche richieste";
		}
	}
}