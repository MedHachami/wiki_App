<?php require APPROOT . '/views/inc/sideBarAdmin.php'; ?>

  <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">
    
  <?php require APPROOT . '/views/inc/adminNavBar.php'; ?>
    <!-- Main content -->
    <div class="flex-1 items-center justify-center h-full p-4">
       <!-- Main content -->
      <main>
        <!-- Content header -->
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
          <h1 class="text-2xl font-semibold">Dashboard</h1>
          
        </div>
        <!-- End Content header -->

        <!-- Content -->
        <div class="mt-2">
          <!-- State cards -->
          <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
            <!-- Value card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
              <div>
                <h6
                  class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                  Wiki's 
                </h6>
                <span class="text-xl font-semibold"><?php echo $data['numOfWikis'] ?></span>
                
              </div>
              <div>
                <span>
                  <svg
                    class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"
                    />
                  </svg>
                </span>
              </div>
            </div>

            <!--End  Value card -->

            <!-- Users card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
              <div>
                <h6
                  class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                  Users
                </h6>
                <span class="text-xl font-semibold"><?php echo $data['numOfUser'] ?></span>
                
              </div>
              <div>
                <span>
                  <svg
                    class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                    />
                  </svg>
                </span>
              </div>
            </div>
            <!-- Value card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
              <div>
                <h6
                  class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                  Tags
                </h6>
                <span class="text-xl font-semibold"><?php echo $data['numOfTag'] ?></span>
                
              </div>
              <div>
                <span>
                <svg 
                    xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                      stroke-width="1.5"
                       stroke="currentColor" 
                       class="w-12 h-12 text-gray-300 dark:text-primary-dark">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>

 

                </span>
              </div>
            </div>


            <!--End  Value card -->
            <!-- Value card -->
            <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
              <div>
                <h6
                  class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                  Categories
                </h6>
                <span class="text-xl font-semibold"><?php echo $data['numOfCategory'] ?></span>
                
              </div>
              <div>
                <span>
                <svg 
                    xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                      stroke-width="1.5"
                       stroke="currentColor" 
                       class="w-12 h-12 text-gray-300 dark:text-primary-dark">
                  <path stroke-linecap="round" 
                  stroke-linejoin="round" 
                  d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />

                </svg>

 

                </span>
              </div>
            </div>


            <!--End  Value card -->
           
            
          <!--End  State cards -->
          </div>
          <div class="chart-container mt-4">
            <div class="flex flex-col justify-center items-center	gap-8">
              <h1 class="text-xl">Wiki Per Category</h1>
              <canvas class="chartCanvas" id="chartDoughnut1" ></canvas>
            </div>
            <div class="flex flex-col justify-center items-center	gap-8">
              <h1 class="text-xl">Wiki Per Tag</h1>
              <canvas class="chartCanvas" id="chartDoughnut2" ></canvas>
            </div>
          </div>
        </div>
        
      </main>
          
          </div>
        </div>
      </div>
    </div>
    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php require APPROOT . '/views/inc/footerAdmin.php'; ?>

