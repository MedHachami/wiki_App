let categories;
async function getResponse() {
    const response = await fetch(`${apiurl}` + 'Main/allCategories' ,{
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
  async function fetchAndStoreCategoriesData() {
    try {
      const data = await getResponse();
      categories = data;
      console.log(categories);
      displayWiki(categories);
      
    } catch (error) {
      console.error('Error:', error);
    }
  }




function displayWiki(categories) {
    const ticketContainer = document.getElementById("categoriesConatiner");
    categoriesConatiner.innerHTML = "";

    const categoryItem = categories.map((category) =>{
        return `
        <div class=" flex md:flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl categories-card ">
        <div class="p-6">
          
          <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal ">
            ${category.name}
          </h5>
          <p class="block font-sans text-base antialiased font-light leading-relaxed text-inherit description">
          ${category.description}
          </p>
        </div>
        <div class="p-6 pt-0">
          <a href="Category.html?categoryId=${category.id}" class=" category-btn">
            <button
              class="flex items-center gap-2 px-4 py-2 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
              type="button">
              Explore Wikis
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
              </svg>
            </button>
          </a>
        </div>
    </div> 
        
        
        `
    })

    categoriesConatiner.innerHTML = categoryItem;

    
        
  }

  fetchAndStoreCategoriesData()