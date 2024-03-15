const urlParams = new URLSearchParams(window.location.search);
const wikiId = urlParams.get('wikiId');

let ticket = [];


async function getResponse() {
    const response = await fetch(`${apiurl}` + 'Main/wikiById/'+ `${wikiId}` ,{
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
    console.log(data);
    return data;
    
}

async function fetchData() {
    try {
        
        const data = await getResponse();
        wiki = data;
        console.log(wiki);
        const wikiContainer = document.getElementById("ticketContainer");
        
        wikiContainer.innerHTML = "";
        const wikiItem = wiki.map((wiki) => {
            const tags = wiki.tags.split(',');
           
            return (
                `
                <div class="col-6" >   
                        <div class="card">
                            <div class="card-body d-flex flex-column gap-4">
                                    <div class="d-flex gap-2">
                                        <img src="${imgStore}${wiki.creatorImg}" class="w-px-40 h-auto rounded-circle" alt="" srcset="">
                                        <h5 class="mt-2 text-dark">${wiki.creatorName}</h5>
                                    </div>
                                    <p class="card-text text-2xl">${wiki.title}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-xl"><p>${wiki.content}</p></li>
                                
                            </ul>
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <p class="mt-1 text-dark" for="basic-icon-default-company"><i class='bx bx-caret-right'></i> Category</p>
                                    <div>
                                        <button class="btn btn-outline-info">${wiki.category}</button>
                                        
                                    </div>
                                </div>
                            
                                
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                <p class="mt-1 text-dark" for="basic-icon-default-company"><i class='bx bx-caret-right'></i> Tags</p>
                                    <div>
                                    ${
                                        tags.map((tag)=>{
                                            return(
                                                `
                                                <button class="btn btn-outline-dark">${tag}</button>
                                                `
                                            )
                                        }).join('')
                                    }
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div>
                    </div> 
                    <div class="col-4" >
                        <div class="card mb-4">
                        
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <button class="btn ">Profile Details</button>
                                        
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column gap-4">
                                    <div class="d-flex gap-2">
                                        <img src="${imgStore}${wiki.creatorImg}" class="w-px-40 h-auto rounded-circle" alt="" srcset="">
                                        <h5 class="mt-2 text-dark">${wiki.creatorName}</h5>
                                    </div>
                                    <p class="text-2xl">${wiki.creatorEmail}</p>
                                </div>
                                
                                
                                
                            </div>
                            
                            
                        </div>
                           
                    </div>
                `
            )   
        })
        ticketContainer.innerHTML= wikiItem
       
    } catch (error) {
        console.error('Error:', error);
    }
}




fetchData();