



function diffTime(dateString) {
    const dateObject = new Date(dateString);
    const currentTime = new Date();

    const timeDifference = currentTime - dateObject; 
    const timeInMinutes = timeDifference / (1000 * 60);

    if (timeInMinutes < 60) {
        return `${Math.floor(timeInMinutes)} minute${Math.floor(timeInMinutes) !== 1 ? 's' : ''}`;
    } else {
        const hours = Math.floor(timeInMinutes / 60);
        const remainingMinutes = Math.floor(timeInMinutes % 60);
        const hoursText = hours > 1 ? 'hours' : 'hour';
        const minutesText = remainingMinutes > 0
            ? `${remainingMinutes} minute${remainingMinutes !== 1 ? 's' : ''}`
            : '';

        return `${hours} ${hoursText}${minutesText ? ` and ${minutesText}` : ''}`;
    }
}

//My wiki
async function getWiResponse() {
    const response = await fetch(`${apiurl}` + 'Main/myWiki/'+`${id}` ,{
      method: 'GET',
      headers: {
          'Authorization': token, 
          'Content-Type': 'application/json'
      }
    
    });
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    
    return data;
  }
  
  
  async function fetchAndStoreMyWikiData() {
    try {
      const data = await getWiResponse();
      wikiData = data;
      displayMyWiki(wikiData);
      
    } catch (error) {
      console.error('Error:', error);
    }
  }
  
  
  function displayMyWiki(wikis){
    const ticketContainer = document.getElementById("ticketContainer");
          ticketContainer.innerHTML = "";
          const ticketItem = wikis.map((wiki) => {
             let tags = wiki.tags.split(',');
             
             
            
              return (
                  `
                  <div class="col-sm-12  col-lg-3 mb-4 w-full">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex  align-items-center">
                              <div class="avatar-online">
                                  <img src="${imgStore}${wiki.creatorImg}" alt class="w-px-40 h-auto rounded-circle" />
                                 
                              </div>
                              <div class="d-flex flex-wrap md:flex-col upd-del-Btn " >
                                  <button
                                  type="button"
                                  class="btn btn-primary"
                                  data-bs-toggle="modal"
                                  data-bs-target="#smallModal"
                                  onclick="insertDataModal(${wiki.id}, '${wiki.title}','${wiki.content}');"
                                  style="background-color: transparent;width: 20px;"
                                  >
                                      <i class='bx bxs-dashboard' ></i>
                                  </button>
                                  <button
                                  type="button"
                                  class="btn btn-primary"
                                  data-bs-toggle="modal"
                                  data-bs-target="#deletModal"
                                  onclick="insertDataModal2(${wiki.id});"
                                  style="background-color: transparent;width: 20px;"
                                  >
                                  <i class='bx bx-trash-alt' ></i>
                                  </button>
  
                              </div>
                              
                              <h5 class="card-title mt-4 p-2" onclick="navigateTo('${wiki.id}')" style="cursor: pointer;" >${wiki.title}</h5>
                              
                              
                          </div>
                          <p class="card-text">
                          ${wiki.content}
                          </p>
                          <div class="d-flex ">
                              ${
                                  tags.map((tag)=>{
                                      return`
                                      <span class="badge bg-label-dark btn btn-outline-dark ms-2">${tag}</span>
                                      `
                                  }).join('')
                              }
                              
                          </div>
                          <div class="d-flex justify-content-between">
                              <div class="align-items-bottom">
                                  
                              </div>
                              
                          </div>
                        </div>
                      </div>
                      
                      </div>
                  
                  `
              )   
          })
          if(wikis.length === 0) {
              let nodata = document.createElement("h2");
              nodata.textContent = "You have no wiki's";
              nodata.classList.add("text-dark"); 
              ticketContainer.appendChild(nodata);
              
              
          }else{
              ticketContainer.innerHTML= ticketItem;
          }
  }
  
  fetchAndStoreMyWikiData();





function insertDataModal(wikiId, title , desc){
    const ticketName =document.getElementById("title");
    ticketName.innerHTML = title;

    const name =document.getElementById("name");
    name.value = title;
    
    const content = document.getElementById("content");
    content.value = desc;
    
    let saveBtn = document.getElementById("saveBtn");
    
    saveBtn.addEventListener('click' ,(event)=>{
        event.preventDefault();
        let smallModal = document.getElementById("smallModal");
        let fade = document.querySelector(".modal-backdrop");
        fade.style.display = "none";
        smallModal.style.display = 'none';
        
        updateWiki(name.value ,content.value , wikiId);
    });
    
}

function insertDataModal2(wikiId){
    let saveBtn = document.getElementById("deleteSaveBtn");
   
    saveBtn.addEventListener('click' ,(event)=>{
        event.preventDefault();
        let smallModal = document.getElementById("deletModal");
        let fade = document.querySelector(".modal-backdrop ");
        fade.style.display = "none";
        smallModal.style.display = 'none';

        deleteWiki(wikiId);
        
    });
}

function updateWiki(name , content , wikiId){
    let data={
        wikiId: wikiId,
        title:name,
        content:content
    }
    fetch(`${apiurl}` + 'Main/editWiki/' +`${wikiId}`,{
        method: 'PUT',
        headers: {
            'Authorization': token, 
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
    })
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
        alert.textContent = "Updated successfully" ;
        alert.classList.add('show');
        setTimeout(() => {
            alert.classList.remove('show');
        }, 4000);
        fetchAndStoreMyWikiData();
        }

        
        
        
    })
    .catch(error => {
        console.log("Error fetching status options:"+ error);
        
    });
}

function deleteWiki(wikiId){
    console.log(wikiId);
    fetch(`${apiurl}` + 'Main/deleteWiki/'+`${wikiId}`,{
        method: 'DELETE',
        headers: {
            'Authorization': token, 
            'Content-Type': 'application/json'
        }
    })
    .then(response =>{
    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }
    
    return response.json();
    })
    .then(data => {
    console.log(data);
        if(data.message){
        
        let alert = document.getElementById("alert2");
        alert.textContent = "Deleted successfully" ;
        alert.classList.add('show');
        setTimeout(() => {
            alert.classList.remove('show');
        }, 4000);
        
        fetchAndStoreMyWikiData();
        }

        
        
    })
    .catch(error => {
        console.log("Error fetching status options:"+ error);
        
    });
}

