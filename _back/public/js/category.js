function openDropDown(categoryId){
    const dropdown = document.querySelector(`[data-dropdown-id="${categoryId}"]`);
    const btnClicke =document.getElementById(`dropdownButton-${categoryId}`);
    const closeBtn = document.getElementById(`closeBtn-${categoryId}`);
    
    btnClicke.classList.add("hidden");
    dropdown.classList.remove("hidden");
    closeBtn.style.display = "block";
}
function closeDropDown(categoryId){
    const dropdown = document.querySelector(`[data-dropdown-id="${categoryId}"]`);
    const btnClicked =document.getElementById(`dropdownButton-${categoryId}`);
    const closeBtn = document.getElementById(`closeBtn-${categoryId}`);
    btnClicked.classList.remove("hidden");
    dropdown.classList.add("hidden");
    closeBtn.style.display = "none";
}


function toggleModal() {
    var modal = document.getElementById('popup-modal');
    modal.style.display = modal.style.display === 'none' ? 'block' : 'none';


}

function hideModal() {
    var modal = document.getElementById('popup-modal');
    modal.style.display = 'none';

}


function addNewCategory(ev){
    ev.preventDefault();
    const nameInput = document.getElementById("name");
    const descriptionInput = document.getElementById("description");

    const name = nameInput.value;
    const description = descriptionInput.value;
    const data = {
        name: name,
        description: description
    }
    fetch('http://localhost/med_hachami_wiki/admin/categories', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(data) 
    })
    .then(response => response.json())
    .then(data => {
        window.location.reload();
    })
    .catch(err => console.error('Error:', err));

}

// edit modal
function toggleModal2(ev,categoryId) {
    ev.preventDefault();
    
    var modal = document.getElementById('popup-modal2');
    modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
    if(modal.style.display === 'block'){
        closeDropDown(categoryId);
        fetch('http://localhost/med_hachami_wiki/admin/category/'+categoryId, {
        method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            const nameEdit = document.getElementById('nameEdit');
            nameEdit.value = data.name;
            const descriptionEdit = document.getElementById('descriptionEdit');
            descriptionEdit.value = data.description;
            document.getElementById('categoryId').value = data.id;
        

        })
        .catch(err => console.error('Error:', err));
    }
    



}

function hideModal2() {
    var modal = document.getElementById('popup-modal2');
    modal.style.display = 'none';

}

function editCategory(ev){
    ev.preventDefault();
    const id = document.getElementById("categoryId").value;
    const nameEdit = document.getElementById("nameEdit").value;
    const descriptionEdit = document.getElementById("descriptionEdit").value;

    const data ={
        id: id,
        name: nameEdit,
        description: descriptionEdit
    }
    

    fetch('http://localhost/med_hachami_wiki/admin/categories', {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(data) 
    })
    .then(response => response.json())
    .then(data => {
        window.location.reload();
    })
    .catch(err => console.error('Error:', err));

}


// delete modal
function deleteModal(ev,categoryId) {
    ev.preventDefault();
    
    var modal = document.getElementById('popup-modal3');
    modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
    const categoryIdInput = document.getElementById("categoryIdDele");
    categoryIdInput.value = categoryId;

}

function hideModal3() {
    var modal = document.getElementById('popup-modal3');
    modal.style.display = 'none';

}

function deleteCategory(event)
{
    event.preventDefault();
    const id = document.getElementById("categoryIdDele").value;
    const data = {
        id: id,
    }
    fetch('http://localhost/med_hachami_wiki/admin/categories', {
    method: 'DELETE',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(data) 
    })
    .then(response => response.json())
    .then(data => {
        window.location.reload();
    })
    .catch(err => console.error('Error:', err));
}

