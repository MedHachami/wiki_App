<?php

Class Main extends Controller{

    private $tagModel;
    private $categoryModel;
    private $wikiModel;
    

    public function __construct(){
       $this->tagModel = $this->model("Tag");
       $this->categoryModel = $this->model("Category");
       $this->wikiModel = $this->model("Wiki");

    }
    public function index(){
        return;
    }

    public function allTags(){
        // AuthMiddleware::authenticate();
        $tags = $this->tagModel->allTags();
        echo json_encode($tags);
    }

    public function allCategories(){
        // AuthMiddleware::authenticate();
        $categories = $this->categoryModel->allCategories();
        echo json_encode($categories);
    }

    public function newWiki(){
        $decodeToken = AuthMiddleware::authenticate();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);
            if ($data !== null && !empty($data['title']) && !empty($data['description'])
                 && !empty($data['tags'])  && !empty($data['category']) 
                ) {
                    $userId = $decodeToken->id;
                    // $userId = 2;
                    $addedWiki =$this->wikiModel->addWiki($data , $userId);
                    if($addedWiki){
                        echo json_encode(['message' => 'Wiki Added Succe']);
                    }
                    else{
                        echo json_encode(['error' => 'Addition Failed']);
                    } 
                
            }
            else {
               
                http_response_code(400); 
                echo json_encode(['error' => 'Invalid JSON payload']);
            }
        }
       
    }

    public function allWikis(){
        // AuthMiddleware::authenticate();
        $wikis = $this->wikiModel->getAllWikis();
        echo json_encode($wikis);
    }

    public function filter($category = 'all' , $tag = 'all'){
        // AuthMiddleware::authenticate();
        switch (true) {
            case ($category === 'all' && $tag === 'all'):
                $wikis = $this->wikiModel->getAllWikis();
                echo json_encode($wikis);
                break;
            case ($category === 'all' && $tag != 'all'):
                $wikis = $this->wikiModel->getWikiByTag($tag);
                echo json_encode($wikis);
                break;
            case ($category != 'all' && $tag === 'all'):
                $wikis = $this->wikiModel->getWikiByCategory($category);
                echo json_encode($wikis);
                break;
            case ($category != 'all' && $tag != 'all'):
                $wikis = $this->wikiModel->getWikiByCategoryAndTag($category , $tag);
                echo json_encode($wikis);
                break;
            default:
                # code...
                break;
        }
    }


    public function myWiki($userId){
        AuthMiddleware::authenticate();
        $myWiki = $this->wikiModel->getMyWiki($userId);
        echo json_encode($myWiki);
    }

    public function editWiki($wikiId){
        AuthMiddleware::authenticate();
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);
            if ($data !== null && !empty($data['title']) && !empty($data['content']) && !empty($data['wikiId'])
                 
                ) {
                    $editedWiki =$this->wikiModel->editMyWiki($data );
                    if($editedWiki){
                        echo json_encode(['message' => 'Wiki edited Succe']);
                    }
                    else{
                        echo json_encode(['error' => 'editing Failed']);
                    } 
                
            }
            else {
               
                http_response_code(400); 
                echo json_encode(['error' => 'Invalid JSON payload']);
            }
        }

    }

    public function deleteWiki($wikiId){
        AuthMiddleware::authenticate();
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            

            $deletedWiki =$this->wikiModel->deleteMyWiki($wikiId);
            if($deletedWiki){
                echo json_encode(['message' => 'Wiki deleted Succe']);
            }
            else{
                echo json_encode(['error' => 'delete Failed']);
            } 
                
            
        }
    }

    public function wikiById($wikiId){
        // AuthMiddleware::authenticate();
        $wiki = $this->wikiModel->getWikiById($wikiId);
        echo json_encode($wiki);
    }
   
    

}