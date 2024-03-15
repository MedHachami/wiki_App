<?php

Class Category{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function allCategories(){
        $this->db->query("SELECT * FROM category");
        return $this->db->resultSet();
    }
    public function addNewCategory($data){
        $this->db->query("INSERT INTO category(name,description	) VALUES (:category_name , :category_description )");
        $this->db->bind(":category_name",$data['name']);
        $this->db->bind(":category_description",$data['description']);

        return $this->db->execute();
    }

    public function getCategoryById($id){
        $this->db->query("SELECT * FROM category where id = :id");
        $this->db->bind(":id" , $id);
        return $this->db->single();
    }

    public function editCategory($data){
        $this->db->query("UPDATE category SET name = :name, description = :description WHERE id = :id");
        $this->db->bind(":name" , $data["name"]);
        $this->db->bind(":description" , $data["description"]);
        $this->db->bind(":id" , $data["id"]);
        return $this->db->execute();
    }

    public function deleteCategory($data){
        $this->db->query("DELETE FROM category WHERE id = :id");
        $this->db->bind(":id" , $data["id"]);
        return $this->db->execute();
    }
    public function getNumOfCategory(){
        $this->db->query("SELECT id FROM category ;");
        
        $this->db->execute();
        return $this->db->rowCount();
    }
}