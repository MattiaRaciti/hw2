const content = '';

addEventListener('submit', search);

let urls = [];
let jsons = [];

let username;

function search(event){
	
	const content = document.querySelector('#content').value;
	
	
	if(content) {
		const tipo = document.querySelector('#tipo').value;
		
		if(tipo == "image") {
			const text = encodeURIComponent(content);
			console.log('Eseguo ricerca elementi riguardanti: ' + text);
			
			fetch(BASE_URL + "search_image/" + text).then(onResponse).then(onJson);
		}
		
		if(tipo == "user") {
			const text = encodeURIComponent(content);
			console.log('Eseguo ricerca elementi riguardanti: ' + text);
			
			fetch(BASE_URL + "search_user/" + text).then(onResponseUser).then(onJsonUser);
		}
		
		event.preventDefault();
	}	
	else {
		alert("Inserisci il testo per cui effettuare la ricerca");
	}
}


function onResponse(response) {
  return response.json();
}


function onJson(json){
	const header_view = document.querySelector('#header-view');
	header_view.innerHTML = '';
	
	const library = document.querySelector('#library-view');
	library.innerHTML = '';
	
	for(let i = 0; i < 15; i++){
		const cover_url = json.value[i].thumbnailUrl;
		
		urls[i] = json.value[i].thumbnailUrl;
		jsons[i] = json;
		
		const block = document.createElement('div');
		const favorite_button = document.createElement('a');
		
		block.setAttribute('data-index', i);
		favorite_button.setAttribute('data-index', i);
		
		block.classList.add('block');
		favorite_button.classList.add('favorite_button');
		
		var favorite_button_text = document.createTextNode("Aggiungi ai preferiti");
		favorite_button.appendChild(favorite_button_text);
		
		const img = document.createElement('img');
		img.src = cover_url;
		
		block.appendChild(img);
		block.appendChild(favorite_button);
		
		library.appendChild(block);
	}
	
	const celle = document.querySelectorAll('.favorite_button');
	for (const cella of celle)
	{
		cella.addEventListener("click", seleziona);
	}
}

function seleziona(event){
	buttons = document.querySelectorAll('.favorite_button');
	
	let n = 0;
	for (const button of buttons)
	{
		button.setAttribute('data-index_array', n);
		n++;
	}
	
	const container = event.currentTarget;
	
	let indiceDaSegnareDatabase = parseInt(container.dataset.index);
	let indiceDaSegnare = parseInt(container.dataset.index_array);
	
	buttons[indiceDaSegnare].classList.remove('favorite_button');
	
	buttons[indiceDaSegnare].removeEventListener("click", seleziona);
	
	let testoDaRimuovere = buttons[indiceDaSegnare].childNodes[0];
	
	buttons[indiceDaSegnare].removeChild(testoDaRimuovere);
	
	buttons[indiceDaSegnare].classList.add('favorite_added');
	
	var favorite_added_text = document.createTextNode("Aggiunto ai preferiti!");
	buttons[indiceDaSegnare].appendChild(favorite_added_text);
	
	
	const imageUrl = urls[indiceDaSegnareDatabase]
	const formData = new FormData();
	formData.append("url", 1);
	fetch(BASE_URL + "add_favorite/" + encodeURI(urls[indiceDaSegnareDatabase].substring(31))).then(onResponseFavorite).then(onFavorite);
	
}

function onResponseUser(response) {
	return response.json();
}

function onJsonUser(json){
	const header_view = document.querySelector('#header-view');
	header_view.innerHTML = '';
	
	const library = document.querySelector('#library-view');
	library.innerHTML = '';
	
	if(json.success == true){
		for(const element of json.content){
			const username = element.username;
			const created_at = element.created_at;
			
			const block = document.createElement('div');
			const favorite_button = document.createElement('a');
			
			favorite_button.setAttribute('data-index', username);
			block.setAttribute('data-index', username);
			
			block.classList.add('user_block');
			favorite_button.classList.add('favorite_button');
			
			var username_text = document.createTextNode("UTENTE: " + username + "\n" +
														"ISCRITTO DAL: " + created_at.substring(0, 10));
			
			var favorite_button_text = document.createTextNode("Visualizza Preferiti");
			
			favorite_button.appendChild(favorite_button_text);
			
			const img = document.createElement('img');
			img.src = ("./img/default_user.jpg");
			block.appendChild(img);
			
			block.appendChild(username_text);
			block.appendChild(favorite_button);
				
			library.appendChild(block);
			
			const celle = document.querySelectorAll('.favorite_button');
			for (const cella of celle)
			{
				cella.addEventListener("click", visualizzaCollezione);
			}
		}
	}
	else
	{
		const header_view = document.querySelector('#header-view');
		header_view.innerHTML = '';
		
		const error = document.createElement('span');
		var error_text = document.createTextNode("Nessun utente trovato");
		
		error.appendChild(error_text);
		error.classList.add('error');
		header_view.appendChild(error);
	}
	
}

function visualizzaCollezione(){
	const container = event.currentTarget;
	let username = container.dataset.index;
	
	fetch(BASE_URL + "view_collection/" + username).then(onResponseFavoriteUser).then(onFavoriteUser);
}

function onResponseFavoriteUser(response){
	return response.json();
}

function onFavoriteUser(json){
	const library = document.querySelector('#library-view');
	library.innerHTML = '';
	
	if(json.success == true){
		if(json.like_presente == false){
			const header_view = document.querySelector('#header-view');
			
			console.log(json.success);
			console.log(json.like_presente);
			console.log(json);
			
			const header = document.createElement('h1');
			var header_text = document.createTextNode("Preferiti di " + json.content[0].username + ": ");
			header.appendChild(header_text);
			header_view.appendChild(header);
			
			const like_button = document.createElement('a');
			like_button.classList.add('like_button');
			var like_text = document.createTextNode("Mi Piace");
			like_button.appendChild(like_text);
			header_view.appendChild(like_button);
			
			const like_button_selected = document.querySelector('.like_button');
			
			
			like_button_selected.setAttribute('data-index', json.content[0].username);
			like_button_selected.addEventListener("click", sendLike);
			
			for(const element of json.content){
				const cover_url = element.url;
				
				const block = document.createElement('div');
				
				block.setAttribute('data-index', element.id);
				
				block.classList.add('collection');
				
				const img = document.createElement('img');
				img.src = cover_url;
				
				block.appendChild(img);
					
				library.appendChild(block);
			}		
		}
		else
		{
			const header_view = document.querySelector('#header-view');
			
			const header = document.createElement('h1');
			var header_text = document.createTextNode("Preferiti di " + json.content[0].username + ": ");
			header.appendChild(header_text);
			header_view.appendChild(header);
			
			const like_button = document.createElement('a');
			like_button.classList.add('undo_like');
			var like_text = document.createTextNode("Non mi piace più");
			like_button.appendChild(like_text);
			header_view.appendChild(like_button);
			
			const like_button_selected = document.querySelector('.undo_like');
			
			
			like_button_selected.setAttribute('data-index', json.content[0].username);
			like_button_selected.addEventListener("click", undoLike);
			
			for(const element of json.content){
				const cover_url = element.url;
				
				const block = document.createElement('div');
				
				block.setAttribute('data-index', element.id);
				
				block.classList.add('collection');
				
				const img = document.createElement('img');
				img.src = cover_url;
				
				block.appendChild(img);
					
				library.appendChild(block);
			}
		}
	}
	else{
		const error_view = document.querySelector('#header-view');
			
			const error = document.createElement('h1');
			var error_text = document.createTextNode(json.username + " non ha ancora salvato alcuna immagine preferita");
			error.appendChild(error_text);
			error_view.appendChild(error);
			error.classList.add('error');
	}
}

function sendLike(){
	console.log("Like ricevuto!");
	const like_button_selected = document.querySelector('.like_button');
	let username = like_button_selected.dataset.index;
	like_button_selected.removeEventListener("click", sendLike);
	
	fetch(BASE_URL + "add_like/" + username).then(onResponseLike);
	
	like_button_selected.classList.remove('like_button');
	
	let testoDaRimuovere = like_button_selected.childNodes[0];
	
	like_button_selected.removeChild(testoDaRimuovere);
	
	like_button_selected.classList.add('undo_like');
	
	var undo_like_text = document.createTextNode("Non mi piace più");
	
	like_button_selected.appendChild(undo_like_text);
	
	like_button_selected.setAttribute('data-index', username);
	
	like_button_selected.addEventListener("click", undoLike);
}

function undoLike(){
	console.log("Undo_like ricevuto!");
	const like_button_selected = document.querySelector('.undo_like');
	let username = like_button_selected.dataset.index;
	like_button_selected.removeEventListener("click", undoLike);
	
	fetch(BASE_URL + "undo_like/" + username).then(onResponseUndoLike);
}

function onResponseUndoLike(){
	const like_button_selected = document.querySelector('.undo_like');
	let username = like_button_selected.dataset.index;
	like_button_selected.removeEventListener("click", undoLike);
	like_button_selected.classList.remove('undo_like');
	
	let testoDaRimuovere = like_button_selected.childNodes[0];
	
	like_button_selected.removeChild(testoDaRimuovere);
	
	like_button_selected.classList.add('like_button');
	
	var like_text = document.createTextNode("Mi Piace");
	
	like_button_selected.appendChild(like_text);
	
	like_button_selected.setAttribute('data-index', username);
	
	like_button_selected.addEventListener("click", sendLike);
}

function onResponseLike(){
	
}

function onResponseFavorite(){
	
}

function onFavorite(){
	
}


