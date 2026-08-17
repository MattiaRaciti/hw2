let i = 0;
let cells = [];

fetch(BASE_URL + "favorites/list").then(onResponseFavorite).then(onFavorite);

fetch(BASE_URL + "get_like_number").then(onResponseLikeNumber).then(onLikeNumber);

function onResponseLikeNumber(response) {
  console.log('Response received');
  return response.json();
}
  
function onLikeNumber(json){
	let likes = 0;
	
	if(json.success == true){
		for(const element of json.content){
			likes++;
		}
	}
	console.log("Likes: " + likes);

	const header_view = document.querySelector('#links');
	
	const header = document.createElement('a2');

	var header_text = document.createTextNode("Your collection has " + likes + " likes");

	header.appendChild(header_text);
	header_view.appendChild(header);
	header.classList.add('favorites_text');
}

function onResponseFavorite(response) {
  console.log('Response received');
  return response.json();
}

function onFavorite(json){
	
	const library = document.querySelector('#library-view');
	library.innerHTML = '';
	const error_view = document.querySelector('#error-view');
	error_view.innerHTML = '';
	
	if(json.length != 0){
		for(const element of json){
			const cover_url = element.url;
			
			const block = document.createElement('div');
			const favorite_button = document.createElement('a');
			
			favorite_button.setAttribute('data-index', element.id);
			block.setAttribute('data-index', element.id);
			
			block.classList.add('block');
			favorite_button.classList.add('favorite_button');
			
			var favorite_button_text = document.createTextNode("Remove from favorites");
			favorite_button.appendChild(favorite_button_text);
			
			const img = document.createElement('img');
			img.src = cover_url;
			
			block.appendChild(img);
			block.appendChild(favorite_button);
				
			library.appendChild(block);
			i++;
		}
		
		const celle = document.querySelectorAll('.favorite_button');
		for (const cella of celle)
		{
			cella.addEventListener("click", seleziona);
		}
	}
	else{
		const error_view = document.querySelector('#error-view');
		error_view.innerHTML = '';
		
		const error = document.createElement('span');
		var error_text = document.createTextNode("You haven't saved any favorite images yet");
		
		error.appendChild(error_text);
		error.classList.add('error');
		error_view.appendChild(error);
	}
	
}


function seleziona(event){
	cells = document.querySelectorAll('div');
	buttons = document.querySelectorAll('.favorite_button');
	
	let i = 0;
	for (const button of buttons)
	{
		button.setAttribute('data-index_array', i);
		i++;
	}
	
	const container = event.currentTarget;
	
	let indiceDaSegnareDatabase = parseInt(container.dataset.index);
	let indiceDaSegnare = parseInt(container.dataset.index_array);
	
	cells[indiceDaSegnare+1].remove();
	
	fetch(BASE_URL + "remove_favorite/" + indiceDaSegnareDatabase);
	
	cells = document.querySelectorAll('div');
	
	for (const button of buttons)
	{
		button.removeAttribute('data-index_array');
	}
}
