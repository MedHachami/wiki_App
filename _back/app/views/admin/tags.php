<?php require APPROOT . '/views/inc/sideBarAdmin.php'; ?>

  <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">
    
  <?php require APPROOT . '/views/inc/adminNavBar.php'; ?>
    <!-- Main content -->
    <div class="flex-1 items-center justify-center flex-1 h-full p-4">
       <!-- Main content -->
      <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
          <h1 class="text-2xl font-semibold">Manage Tags</h1>
                
            <button  onclick="toggleModal()" class="w-24 inline-flex items-center px-8 py-2 text-xl font-medium text-center  text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
                
        </div>
        <!-- End Content header -->

        <!-- Content -->
        <div class="mt-2">
          <!-- State cards -->
          <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
        <?php foreach($data['tags']as $tag) { ?>
    
          <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow bg-white rounded-md dark:bg-darker dark:border-gray-700">
            <span style="position: relative;left: 90%;top:8px;font-size: 18px;color: #fff;z-index: 100;cursor: pointer;display: none;"onclick="closeDropDown(<?php echo $tag->id ?>)" id="closeBtn-<?php echo $tag->id ?>">X</span>
  
            <div class="flex justify-end px-4 pt-4 dropdownContainer">

                <button id="dropdownButton-<?php echo $tag->id ?>" onclick="openDropDown(<?php echo $tag->id ?>)" data-dropdown-toggle="dropdown" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                      <span class="sr-only">Open dropdown</span>
                      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                          <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                      </svg>
                  </button>
                  <!-- Dropdown menu -->
                  <div id="dropdown" data-dropdown-id="<?php echo $tag->id ?>" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    
                      <ul class="py-2" aria-labelledby="dropdownButton">
                      
                      <li >
                          <a href="#" onclick="toggleModal2(event,<?php echo $tag->id ?>)" class="block  px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a href="#">
                      </li>
                      
                      <li>
                          <a href="#" onclick="deleteModal(event,<?php echo $tag->id ?>)" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                      </li>
                      </ul>
                  </div>
              </div>
              <div class="flex flex-col items-center pb-10 bg-white rounded-md dark:bg-darker">
                  <h5 class="mb-1 text-xl font-medium text-gray-900 text-white"><?php echo $tag->name ?></h5>
                  <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo $tag->description ?></span>
                 
              </div>
              
          </div>
          
        <?php } ?>
          

            
          </div>
        </div>
        <!--End  Content -->
        <!---Add modal-->
        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden ">

            <form >
                
                <div class="form fixed top-1/2 left-1/2 transform -translate-x-1/2 top-5 border border-gray-200  bg-white rounded-md dark:bg-darker">
                    <button type="button" onclick="hideModal()" class="absolute top-3 left-1 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <div class="mb-5">
                            <label for="category" class="block mb-2 font-bold text-gray-600 uppercase">Tag Name</label>
                            <div class="relative border border-gray-300 text-gray-800 bg-white shadow-lg">
                                
                                <input type="text" id="name" class="appearance-none w-full py-1 px-2 bg-white" name="name" placeholder="Enter the name">
                                
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="category" class="block mb-2 font-bold text-gray-600 uppercase">Tag Description</label>
                            <div class="relative border border-gray-300 text-gray-800 bg-white shadow-lg">
                                
                                <input type="text" id="description" class="appearance-none w-full py-1 px-2 bg-white" name="description" placeholder="Enter the description">
                                
                            </div>
                        </div>
                        <button name="submit" onclick="addNewTag(event)" type="submit"  class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Add
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <!---End add modal-->
        <!---Edit modal-->
        <div id="popup-modal2" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden ">

            <form >
                <input type="hidden" id="tagId" name="tagId" >
                <div class="form fixed top-1/2 left-1/2 transform -translate-x-1/2 top-5 border border-gray-200  bg-white rounded-md dark:bg-darker">
                    <button type="button" onclick="hideModal2()" class="absolute top-3 left-1 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <div class="mb-5">
                            <label for="category" class="block mb-2 font-bold text-gray-600 uppercase">Tag Name</label>
                            <div class="relative border border-gray-300 text-gray-800 bg-white shadow-lg">
                                
                                <input type="text" id="nameEdit" class="appearance-none w-full py-1 px-2 bg-white" name="name" placeholder="Enter the name">
                                
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="category" class="block mb-2 font-bold text-gray-600 uppercase">Tag Description</label>
                            <div class="relative border border-gray-300 text-gray-800 bg-white shadow-lg">
                                
                                <input type="text" id="descriptionEdit" class="appearance-none w-full py-1 px-2 bg-white" name="description" placeholder="Enter the description">
                                
                            </div>
                        </div>
                        <button name="submit" onclick="editTag(event)" type="submit"  class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Edit
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <!---End Edit modal-->
        <!--Delete modal-->
        <div id="popup-modal3" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <form>
                        <input type="hidden" id="tagIdDele" name="tagIdDele" >
                        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 top-5 border border-gray-200  bg-white rounded-md dark:bg-darker">
                            <button type="button" onclick="hideModal3()" class="absolute top-3 left-1 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this tag?</h3>
                                <button onclick="deleteTag(event)" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Yes, I'm sure
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!---end delete modal-->

      </main>
          
          </div>
        </div>
      </div>
    </div>
    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->

    
<script src="<?php echo URLROOT . "/js/tag.js" ?>"></script>
<?php require APPROOT . '/views/inc/footerAdmin.php'; ?>