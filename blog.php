<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
	<!-- icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous" />
	<!-- bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

	<title>Travel Blog App</title>
    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box; /* box-model*/
  
}

body {
  font-family: "Poppins", sans-serif;
  background-color: #ebf2ff;
  background-image: url("travel.jpg");
  background-repeat: no-repeat;
  background-position: right top;
  background-attachment: fixed;
  background-size: 2460px 1080px;
}

.card-img-top {
  padding: 15px;
  height: 300px;
  width: auto;
}

.place__holder__image {
  width: 100%;
}




        </style>
</head>

<body onload="loadData()">
	<!--Navbar Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Add New Task</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label for="imageurl" class="form-label">Image URL</label>
							<input type="url" class="form-control" id="imageurl" aria-describedby="emailHelp" placeholder="https://images.hello.com/hello.png">
						</div>
						<div class="mb-3">
							<label for="title" class="form-label">Title</label>
							<input type="text" class="form-control" id="title" placeholder="Enter Your Place">
						</div>
						<div class="mb-3">
							<label for="type" class="form-label">Type</label>
							<input type="text" class="form-control" id="type" placeholder="Travel Blog">
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Description</label>
							<textarea rows="4" class="form-control" id="description"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveChanges()">Save Changes</button>
				</div>
			</div>
		</div>
	</div>
	<!--  card modal -->
	<div class="modal fade" id="showblog" tabindex="-1" aria-labelledby="showTaskLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body blog__modal__body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- navbar -->
	<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
		<div class="container-fluid"> <a class="navbar-brand  fw-bold text-primary" href="#l"> Travel Blog</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> 
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link active" aria-current="page" href="index.html">Home</a> 
					</li>
				</ul>
				<button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-plus"></i> Add New</button>
			</div>
		</div>
	</nav>
	<div class="container">
		<section>
			<div class="row blog__container mt-5 mb-3 ">
		        </div>
		</section>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<script>
        // targeting the parent element
const blogContainer = document.querySelector('.blog__container');
const blogModal = document.querySelector(".blog__modal__body");
// global 
let globalStore = [];

// -----------------------------------------------------
// a function for creating a new card
const newCard = ({
	id,
	imageUrl,
	blogTitle,
	blogType,
	blogDescription
}) => `<div class="col-lg-4 col-md-6" id=${id}>
<div class="card m-2">
  <div class="card-header d-flex justify-content-end gap-2">
    <button type="button" class="btn btn-outline-success" id="${id}" onclick="editCard.apply(this, arguments)"><i class="fas fa-pencil-alt" id="${id}" onclick="editCard.apply(this, arguments)"></i></button>
    <button type="button" class="btn btn-outline-danger" id="${id}" onclick="deleteCard.apply(this, arguments)"><i class="fas fa-trash-alt" id="${id}" onclick="deleteCard.apply(this, arguments)"></i></button>
  </div>
  <img
    src=${imageUrl}
    class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">${blogTitle}</h5>
    <p class="card-text">${blogDescription}</p>
    <span class="badge bg-primary">${blogType}</span>
  </div>
  <div class="card-footer text-muted">
    <button type="button" id="${id}" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
    data-bs-target="#showblog" onclick="openBlog.apply(this, arguments)">Open Blog</button>
  </div>
</div>
</div>`;

// --------------------------------------------------
const loadData = () => {

	// access localstorage
	// localStorage.getItem("blog") ===  localStorage.blog
	const getInitialData = localStorage.blog; // if null, then
	if (!getInitialData) return;

	// convert stringified-object to object
	const {
		cards
	} = JSON.parse(getInitialData);

	// map around the array to generate HTML card and inject it to DOM
	cards.map((blogObject) => {
		const createNewBlog = newCard(blogObject);
		blogContainer.insertAdjacentHTML("beforeend", createNewBlog);
		globalStore.push(blogObject);
	});
};

const updateLocalStorage = () => {
	localStorage.setItem("blog", JSON.stringify({
		cards: globalStore
	}))
}

//  function for save changes----------------------------------------

// create a function which will trigerred on clicking on save changes in the modal
const saveChanges = () => {
	const blogData = {
		id: `${Date.now()}`, // generating a unique id for each card
		imageUrl: document.getElementById('imageurl').value,
		blogTitle: document.getElementById('title').value,
		blogType: document.getElementById('type').value,
		blogDescription: document.getElementById('description').value
	};

	const createNewBlog = newCard(blogData);
	blogContainer.insertAdjacentHTML("beforeend", createNewBlog);

	globalStore.push(blogData);

	//  API  -> add t localStorage
	updateLocalStorage()
	// provide some unique identification, i.e key, here key is "blog", 

};

// function for deleting a card -------------------

const deleteCard = (event) => {
	// id
	event = window.event;
	const targetID = event.target.id;
	const tagname = event.target.tagName; // BUTTON OR I

	// assign the same id of card to button also

	// search the globalStore, remove the object which matches with the id
	globalStore = globalStore.filter((blogObject) => blogObject.id !== targetID);

	updateLocalStorage();

	// access DOM to remove them

	if (tagname === "BUTTON") {
		// task__container
		return blogContainer.removeChild(
			event.target.parentNode.parentNode.parentNode // col-lg-4
		);
	}

	// else
	// blog__container
	return blogContainer.removeChild(
		event.target.parentNode.parentNode.parentNode.parentNode // col-lg-4
	);
};

// function for editing
const editCard = (event) => {

	event = window.event;
	const targetID = event.target.id;
	const tagname = event.target.tagName;

	let parentElement;
	if (tagname === "BUTTON") {
		parentElement = event.target.parentNode.parentNode;

	} else {
		parentElement = event.target.parentNode.parentNode.parentNode;
	}

	let blogTitle = parentElement.childNodes[5].childNodes[1];
	let blogDescription = parentElement.childNodes[5].childNodes[3];
	let blogType = parentElement.childNodes[5].childNodes[5];
	let submitBtn = parentElement.childNodes[7].childNodes[1];
	// console.log(taskTitle, taskDescription, taskType);

	// setAttributes
	blogTitle.setAttribute("contenteditable", "true");

	blogDescription.setAttribute("contenteditable", "true");
	blogType.setAttribute("contenteditable", "true");
	submitBtn.setAttribute(
		"onclick",
		"saveEditChanges.apply(this, arguments)"
	);
	submitBtn.innerHTML = "Save Changes";

	//  modal removed
	submitBtn.removeAttribute("data-bs-toggle");
	submitBtn.removeAttribute("data-bs-target");

}

const saveEditChanges = (event) => {

	event = window.event;
	const targetID = event.target.id;
	const tagname = event.target.tagName;

	let parentElement;
	if (tagname === "BUTTON") {
		parentElement = event.target.parentNode.parentNode;

	} else {
		parentElement = event.target.parentNode.parentNode.parentNode;
	}

	let blogTitle = parentElement.childNodes[5].childNodes[1];
	let blogDescription = parentElement.childNodes[5].childNodes[3];
	let blogType = parentElement.childNodes[5].childNodes[5];
	let submitBtn = parentElement.childNodes[7].childNodes[1];

	const updatedData = {

		blogTitle: blogTitle.innerHTML,
		blogDescription: blogDescription.innerHTML,
		blogType: blogType.innerHTML,
	}

	// console.log(updatedData);
	globalStore = globalStore.map((blog) => {
		if (blog.id === targetID) {
			return {
				id: blog.id,
				imageUrl: blog.imageUrl,
				blogTitle: updatedData.blogTitle,
				blogType: updatedData.blogType,
				blogDescription: updatedData.blogDescription,
			};
		}
		return blog; // important statement
	});

	updateLocalStorage();

	blogTitle.setAttribute("contenteditable", "false");

	blogDescription.setAttribute("contenteditable", "false");
	blogType.setAttribute("contenteditable", "false");

	// modal added
	submitBtn.setAttribute("onclick", "openBlog.apply(this, arguments)");
	submitBtn.setAttribute("data-bs-toggle", "modal");
	submitBtn.setAttribute("data-bs-target", "#showblog");

	submitBtn.innerHTML = "Open Blog";

}

const htmlModalContent = ({
	id,
	blogTitle,
	blogDescription,
	imageUrl,
	blogType
}) => {
	const date = new Date(parseInt(id));
	return ` <div id=${id}>
   <img
   src=${imageUrl}
   alt="bg image"
   class="img-fluid place__holder__image mb-3 p-4"
   />
   <div class="text-sm text-muted ">Created on ${date.toDateString()}</div>
   <h2 class="my-5 mt-5" style="display:inline;">${blogTitle}</h2>
   <span class="badge bg-primary">${blogType}</span>
   <p class="lead mt-2">
   ${blogDescription}
   </p></div>`;
};

const openBlog = (event) => {

	event = window.event;
	const targetID = event.target.id;

	const getBlog = globalStore.filter(({
		id
	}) => id === targetID);
	// console.log(getBlog[0]);
	blogModal.innerHTML = htmlModalContent(getBlog[0]);
};



    </script>
</body>
</html>


