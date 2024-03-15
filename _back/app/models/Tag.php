<?php

Class Tag{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function allTags(){
        $this->db->query("SELECT * FROM tag");
        return $this->db->resultSet();
    }
    public function addNewTag($data){
        $this->db->query("INSERT INTO tag(name,description	) VALUES (:category_name , :category_description )");
        $this->db->bind(":category_name",$data['name']);
        $this->db->bind(":category_description",$data['description']);

        return $this->db->execute();
    }

    public function getTagyById($id){
        $this->db->query("SELECT * FROM tag where id = :id");
        $this->db->bind(":id" , $id);
        return $this->db->single();
    }

    public function editTag($data){
        $this->db->query("UPDATE tag SET name = :name, description = :description WHERE id = :id");
        $this->db->bind(":name" , $data["name"]);
        $this->db->bind(":description" , $data["description"]);
        $this->db->bind(":id" , $data["id"]);
        return $this->db->execute();
    }

    public function deleteTag($data){
        $this->db->query("DELETE FROM tag WHERE id = :id");
        $this->db->bind(":id" , $data["id"]);
        return $this->db->execute();
    }

    public function getNumOfTag(){
        $this->db->query("SELECT id FROM tag ;");
        
        $this->db->execute();
        return $this->db->rowCount();
    }
}