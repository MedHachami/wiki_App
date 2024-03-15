
document.addEventListener("DOMContentLoaded", function () {
  

  // status dropdown
  const statusDropDown = document.getElementById("status");
  const tagDropDown = document.getElementById("tag");
  const priorityDropDown = document.getElementById("priority");
  
  const requestOptions = {
    method: 'GET',
    headers: {
        'Authorization': token, 
        'Content-Type': 'application/json'
       
    }
  }
  fetch(`${apiurl}` + 'Main/allCategories', requestOptions)
    .then(response => response.json())
    .then(data => {
        const categories = document.getElementById("categories");
        const categoryItem = data.map((category)=>{
            return(
                `
                <option value="${category.id}" >${category.name}</option>
                `
            )
        })

        categories.innerHTML += categoryItem;
        console.log(categories);
        
    })
    .catch(error => {
        console.log("Error fetching status options:"+ error);
        
    });

    fetch(`${apiurl}` + 'Main/allTags', requestOptions)
    .then(response => response.json())
    .then(data => {
        // console.log(data); 
        tagDropDown.innerHTML = "";
      let numOfTags = 0;
        data.forEach(option => {
          
            const optionElement = document.createElement("option");
            optionElement.value = option.id; 
            optionElement.text = option.name;   
            tagDropDown.appendChild(optionElement);
            numOfTags += 1;
        }); 
        $(tagDropDown).chosen();
        tagDropDown.setAttribute("tabindex", numOfTags);
    })
    .catch(error => {
        console.log("Error fetching status options:"+ error);
        
    });

});




function addWiki(ev){
  ev.preventDefault(); 
  const wikiName = document.getElementById("name").value;

  const tagDropDown = document.getElementById("tag");
  const tagValues = $(tagDropDown).val(); 

  const category = document.getElementById("categories").value; 
  const description = document.getElementById("description").value; 

  let wikiName_error =  document.getElementById("wikiName_error");
  let category_error =  document.getElementById("category_error");
  let description_error = document.getElementById("description_error");
  let tags_error = document.getElementById("tags_error");

  

    wikiName_error.textContent = '';
    description_error.textContent = '';
    tags_error.textContent = '';
    category_error.textContent = '';
   

  if(!wikiName){
    wikiName_error.textContent = "*Wiki Name required";
  }
  if(category === 'x'){
    category_error.textContent = "*Wiki Category required";
  }

  if(!description){
    description_error.textContent = "*description required";
  }
  if(tagValues.length == 0){
    tags_error.textContent = "*Tags are required";
  }
 
  if(wikiName_error.textContent === '' && description_error.textContent === '' && category_error.textContent === '' && tags_error.textContent === ''){

    
    const data ={
      "title": wikiName,
      "description":description ,
      "tags":tagValues,
      "category":category,
    }
   console.log(token);
   
    const requestOptions = {
      method: 'POST',
      headers: {
          'Authorization': token, 
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data),
    }
    fetch(`${apiurl}` + 'Main/newWiki', requestOptions)
      .then(response =>{
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        return response.json();
      })
      .then(data => {
        console.log(data);
          if(data.message){
            let alert = document.getElementById("alert1");
            alert.innerHTML = `${data.message}<span style="color: black;font-size: 24px;cursor: pointer;" onclick="hideAlert()">x</span>` ;
            
            setTimeout(() => {
              alert.classList.add('show');
               
            }, 2000);
            
          }

         
          
      })
      .catch(error => {
          console.log("Error fetching status options:"+ error);
          
      });
  
    
  }
  

}

 function hideAlert(){
    let alert = document.getElementById("alert1");
    alert.classList.remove('show');
 }