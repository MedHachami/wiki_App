<?php

Class Admin extends Controller{

    private $categoryModel;
    private $tagsModel;

    private $wikiModel;
    private $userModel;

    public function __construct(){
       if(!adminIsLoggedIn()){
            $this->view('auth');
       }
       $this->categoryModel = $this->model('Category');
       $this->tagsModel = $this->model('Tag');
       $this->wikiModel = $this->model('Wiki');
       $this->userModel = $this->model('User');
    }
    public function index(){
        $numOfUser = $this->userModel->getNumOfUsers();
        $numOfWiki = $this->wikiModel->getNumOfWiki();
        $numOfTag = $this->tagsModel->getNumOfTag();
        $numOfCategory = $this->categoryModel->getNumOfCategory();
        $data=[
            'numOfWikis'=>$numOfWiki,
            'numOfUser'=>$numOfUser,
            'numOfTag'=>$numOfTag,
            'numOfCategory'=>$numOfCategory
        ];
          return $this->view('admin/index' , $data);
    }

    public function categories(){
        $categories = $this->categoryModel->allCategories();
        $data=[
            'categories'=>$categories
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            
            $postData=[
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $addCategory = $this->categoryModel->addNewCategory($postData);
            if($addCategory){
                
                echo json_encode(["message"=>"category added successfully"]);
            }else{
                echo json_encode(["error"=>"error creating category"]);
            }
        }else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $editedCategory = $this->categoryModel->editCategory($postData);
            if($editedCategory){
                
                echo json_encode(["message"=>"category edited successfully"]);
            }else{
                echo json_encode(["error"=>"error editing category"]);
            }
        }
        else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                
            ];
            $deletedCategory = $this->categoryModel->deleteCategory($postData);
            if($deletedCategory){
                
                echo json_encode(["message"=>"category deleted successfully"]);
            }else{
                echo json_encode(["error"=>"error deleting category"]);
            }
        }
        else{
            return $this->view("admin/categories" , $data);
        }
        
    }
    public function tags(){

        $tags = $this->tagsModel->allTags();
        $data=[
            'tags'=>$tags
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            
            $postData=[
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $addedTag = $this->tagsModel->addNewTag($postData);
            if($addedTag){
                
                echo json_encode(["message"=>"tag added successfully"]);
            }else{
                echo json_encode(["error"=>"error creating tag"]);
            }
        }else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $editedtag = $this->tagsModel->editTag($postData);
            if($editedtag){
                
                echo json_encode(["message"=>"tag edited successfully"]);
            }else{
                echo json_encode(["error"=>"error editing tag"]);
            }
        }
        else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                
            ];
            $deletedTag = $this->tagsModel->deleteTag($postData);
            if($deletedTag){
                
                echo json_encode(["message"=>"tag deleted successfully"]);
            }else{
                echo json_encode(["error"=>"error deleting tag"]);
            }
        }
        else{
            return $this->view("admin/tags" , $data);
        }
        
    }

    public function wiki(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['retrieve'])) {
            $wikiId = $_POST['archiWikiID'];
            
            $archiveWiki = $this->wikiModel->retrieveWiki($wikiId);

        }else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['archive'])) {
            $wikiId = $_POST['wikiID'];
            $archiveWiki = $this->wikiModel->archiveWiki($wikiId);

        }
        $this->view("admin/wiki");
    }

    // consommation
    public function allWikis(){
        
        $wikis = $this->wikiModel->getAllWikis();
        echo json_encode($wikis);
    }
    // consommation
    public function archivedWik(){
        $wikis = $this->wikiModel->getAllArchivedWikis();
        echo json_encode($wikis);
    }

    public function category($id){
        $category = $this->categoryModel->getCategoryById($id);
        echo json_encode($category);

    }

    public function tag($id){
        $tag = $this->tagsModel->getTagyById($id);
        echo json_encode($tag);

    }

    public function wikiPerCategory(){
        
        $wikis = $this->wikiModel->getwikiPerCategory();
        echo json_encode($wikis);
    }

    public function wikiPerTags(){
        
        $wikis = $this->wikiModel->getwikiPerTags();
        echo json_encode($wikis);
    }

    

    
    

    public function manageUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['banne'])){
            $userModel = $this->userModel->banne($_POST['nuserId']);
            

        }else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_banne'])){
            $userModel = $this->userModel->unBanned($_POST['buserId']);
        }
        return $this->view("admin/users");
    }

    public function notBannedUsers(){
        $users = $this->userModel->getNotBannedUsers();
        echo json_encode($users);
    }

    public function bannedUsers(){
        $users = $this->userModel->getBannedUsers();
        echo json_encode($users);
    }
    
   
    
   
    

}