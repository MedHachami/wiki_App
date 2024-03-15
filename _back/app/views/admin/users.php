<?php require APPROOT . '/views/inc/sideBarAdmin.php'; ?>

<div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">

    <?php require APPROOT . '/views/inc/adminNavBar.php'; ?>
    <!-- Main content -->
    <div class="flex-1 items-center justify-center flex-1 h-full p-4">
        <!-- Main content -->
        <main>
            <!-- Content header -->
            <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
                <h1 class="text-2xl font-semibold">Manage Users</h1>

            </div>
            <!-- End Content header -->

            <!-- Content -->

            <!--End  Content -->
            <div class="w-full my-12 ">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Users
                </p>
                <div class="overflow-auto bg-white rounded-md dark:bg-darker">
                    <table id="notbannedUsers" class="min-w-full leading-normal m-b-8">
                        <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b border-gray-200  text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Id
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-200  text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Full Name
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-200  text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-5 py-3 border-b border-gray-200 text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Actions

                            </th>

                        </tr>
                        </thead>

                    </table>
                </div>

            </div>
            <div class="w-full my-12 ">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Banned Users
                </p>
                <div class="overflow-auto bg-white rounded-md dark:bg-darker">
                    <table id="bannedUsers" class="min-w-full leading-normal m-b-8">
                        <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b border-gray-200  text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Id
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-200  text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Full Name
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-200  text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-5 py-3 border-b border-gray-200 text-left text-xs font-semibold text-white-600 uppercase tracking-wider">
                                Actions

                            </th>

                        </tr>
                        </thead>

                    </table>
                </div>

            </div>




            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <form action="<?php echo URLROOT . '/Admin/manageUser' ?>" method="POST">
                        <input type="hidden" id="nuserId" name="nuserId" >
                        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 top-5 border border-gray-200  bg-white rounded-md dark:bg-darker">
                            <button type="button" onclick="hideModal()" class="absolute top-3 left-1 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Banne this user?</h3>
                                <button name="banne"  type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Yes, I'm sure
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="popup-modal2" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <form action="<?php echo URLROOT . '/Admin/manageUser' ?>" method="POST">
                        <input type="hidden" id="buserId" name="buserId" >
                        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 top-5 border border-gray-200  bg-white rounded-md dark:bg-darker">
                            <button type="button" onclick="hideModal2()" class="absolute top-3 left-1 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Retrieve this user?</h3>
                                <button  type="submit" name="cancel_banne" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Yes, I'm sure
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </main>





    </div>
</div>
</div>
</div>

<!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
<script>
    $(document).ready(function() {
        var endpoint = 'http://localhost/med_hachami_wiki/admin/notBannedUsers';
        fetch(endpoint)
            .then(response => response.json())
            .then(data => {

                
                data.forEach(wiki => {
                    wiki.actions = '' +
                        `<button href="#" onclick="toggleModal(${wiki.id})" class="delete-link"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg></button>`;
                });



                $('#notbannedUsers').DataTable({
                    paging: false,
                    searching: true,
                    ordering: true,
                    info: false,
                    data: data, // Pass the fetched data to DataTable
                    columns: [
                        { data: 'id', className: 'py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' },
                        { data: 'full_name', className: 'py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' },
                        { data: 'email', className: 'py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' },
                        { data: 'actions', className: 'flex justify-center gap-2 py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' }, // Static Actions column
                    ],
                    autoWidth: false,
                });

                $('#notbannedUsers_filter input')
                    .addClass('py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500')
                    .attr('placeholder', 'creator  Or wiki title ...');
                $('label')
                    .addClass('text-sm text bg-white dark:bg-darker');

            })
            .catch(error => console.log('Error fetching data:', error));
    });



    function toggleModal(id) {
        var modal = document.getElementById('popup-modal');
        modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
        var userId = document.getElementById("nuserId");
        userId.value = id;
        
    }

    function hideModal() {
        var modal = document.getElementById('popup-modal');
        modal.style.display = 'none';

    }


    // Archived Wiki

    $(document).ready(function() {
        var endpoint = 'http://localhost/med_hachami_wiki/admin/bannedUsers';
        fetch(endpoint)
            .then(response => response.json())
            .then(data => {

                console.log(data);
                data.forEach(wiki => {
                    wiki.actions = '' +
                        `<button href="#" onclick="toggleModal2(${wiki.id})" class="delete-link"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg></button>`;
                });



                $('#bannedUsers').DataTable({
                    paging: false,
                    searching: true,
                    ordering: true,
                    info: false,
                    data: data, // Pass the fetched data to DataTable
                    columns: [
                        { data: 'id', className: 'py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' },
                        { data: 'full_name', className: 'py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' },
                        { data: 'email', className: 'py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' },
                        { data: 'actions', className: 'flex justify-center gap-2 py-5 border-b border-gray-200 text-sm bg-white dark:bg-darker' }, // Static Actions column
                    ],
                    autoWidth: false,
                });

                $('#bannedUsers_filter input')
                    .addClass('py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500')
                    .attr('placeholder', 'creator  Or wiki title ...');
                $('label')
                    .addClass('text-sm text bg-white dark:bg-darker');

            })
            .catch(error => console.log('Error fetching data:', error));
    });

    function toggleModal2(id) {
        var modal = document.getElementById('popup-modal2');
        modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
        var userId = document.getElementById("buserId");
        userId.value = id;
        console.log(id);
    }

    function hideModal2() {
        var modal = document.getElementById('popup-modal2');
        modal.style.display = 'none';

    }


</script>
<?php require APPROOT . '/views/inc/footerAdmin.php'; ?>

