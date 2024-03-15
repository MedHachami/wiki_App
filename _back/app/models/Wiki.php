<?php

Class Wiki{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllWikis(){
        $this->db->query("
                SELECT
                DISTINCT wiki.*,
                user.id as creatorId,
                user.full_name as creatorName,
                user.imgUrl as creatorImg,
                category.name as category,
                GROUP_CONCAT(DISTINCT tag.name) as tags
            FROM
                wiki
            JOIN category ON wiki.category_id = category.id
            INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
            INNER JOIN tag ON wiki_tag.tag_id = tag.id
            INNER JOIN user ON wiki.created_by = user.id
            AND wiki.status = :status
            GROUP BY
                wiki.id,
                wiki.title,
                wiki.content,
                wiki.created_at,
                creatorId,
                creatorName,
                creatorImg,
                category,
                status
            ORDER BY wiki.updated_at desc

        ");
        $this->db->bind(":status" , 0);
        return $this->db->resultSet();
    }
    public function getAllArchivedWikis(){
        $this->db->query("
                SELECT
                DISTINCT wiki.*,
                user.id as creatorId,
                user.full_name as creatorName,
                user.imgUrl as creatorImg,
                category.name as category,
                GROUP_CONCAT(DISTINCT tag.name) as tags
            FROM
                wiki
            JOIN category ON wiki.category_id = category.id
            INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
            INNER JOIN tag ON wiki_tag.tag_id = tag.id
            INNER JOIN user ON wiki.created_by = user.id
            AND wiki.status = :status
            GROUP BY
                wiki.id,
                wiki.title,
                wiki.content,
                wiki.created_at,
                creatorId,
                creatorName,
                creatorImg,
                category,
                status
            ORDER BY wiki.updated_at desc

        ");
        $this->db->bind(":status" , 1);
        return $this->db->resultSet();
    }
    public function getMyWiki($userId){
        $this->db->query("
        SELECT
        DISTINCT wiki.*,
        user.id as creatorId,
        user.full_name as creatorName,
        user.imgUrl as creatorImg,
        category.name as category,
        GROUP_CONCAT(DISTINCT tag.name) as tags
    FROM
        wiki
    JOIN category ON wiki.category_id = category.id
    INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
    INNER JOIN tag ON wiki_tag.tag_id = tag.id
    INNER JOIN user ON wiki.created_by = user.id
    AND user.id=:creatorId
    GROUP BY
        wiki.id,
        wiki.title,
        wiki.content,
        wiki.created_at,
        creatorId,
        creatorName,
        creatorImg,
        category,
        status;
        
        ");
        $this->db->bind(":creatorId" , $userId);
        return $this->db->resultSet();
    }
    public function addWiki($data , $userId){
        $this->db->query("INSERT INTO wiki (title, content, created_by, category_id)
                  VALUES (:title, :content, :created_by, :category_id)");

        $this->db->bind(':title',$data['title']);
        $this->db->bind(':content',$data['description']);
        $this->db->bind(':created_by',$userId);
        $this->db->bind(':category_id',$data['category']);
        

        $insertedWiki = $this->db->execute();
        if($insertedWiki){
            $this->db->query("SELECT id FROM wiki ORDER BY id DESC LIMIT 1;");
            $lastWikiId = $this->db->single()->id;
            foreach ($data['tags'] as $tagId) {
                $this->db->query("INSERT INTO wiki_tag(wiki_id, tag_id) VALUES (:wiki_id, :tag_id) ");
                $this->db->bind(':wiki_id',$lastWikiId);
                $this->db->bind(':tag_id',$tagId);
                $wiki_tag = $this->db->execute();
            }
            return $wiki_tag;
        }else{
            return false;
        }
        
        
    }

    public function editMyWiki($data){
        $this->db->query("UPDATE wiki SET title = :title , content = :content , updated_at = NOW() WHERE id = :id");
        $this->db->bind(":title" , $data['title']);
        $this->db->bind(":content" , $data['content']);
        // $this->db->bind(":updated_at" , );
        $this->db->bind(":id" , $data['wikiId']);
        return $this->db->execute();
    }

    public function archiveWiki($id){
        $this->db->query("UPDATE wiki SET status = :status WHERE id = :id");
        $this->db->bind(":status" ,1);
        $this->db->bind(":id" ,$id);
        return $this->db->execute();
    }

    public function retrieveWiki($id){
        $this->db->query("UPDATE wiki SET status = :status WHERE id = :id");
        $this->db->bind(":status" ,0);
        $this->db->bind(":id" ,$id);
        return $this->db->execute();
    }

    

    public function deleteMyWiki($wikiId){
        $this->db->query("DELETE FROM wiki WHERE wiki.id = :wikiId");
        $this->db->bind(":wikiId" , $wikiId);
        return $this->db->execute();
    }

    public function getWikiById($wikiId){
        $this->db->query("
        SELECT
        DISTINCT wiki.*,
        user.id as creatorId,
        user.email as creatorEmail,
        user.full_name as creatorName,
        user.imgUrl as creatorImg,
        category.name as category,
        GROUP_CONCAT(DISTINCT tag.name) as tags
    FROM
        wiki
    JOIN category ON wiki.category_id = category.id
    INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
    INNER JOIN tag ON wiki_tag.tag_id = tag.id
    INNER JOIN user ON wiki.created_by = user.id
    AND wiki.id=:wikiId
    GROUP BY
        wiki.id,
        wiki.title,
        wiki.content,
        wiki.created_at,
        creatorId,
        creatorName,
        creatorImg,
        category,
        status;
        
        ");
        $this->db->bind(":wikiId" , $wikiId);
        return $this->db->resultSet();
    }

    public function getWikiByCategory($categoryId){
        $this->db->query("
                SELECT
                DISTINCT wiki.*,
                user.id as creatorId,
                user.full_name as creatorName,
                user.imgUrl as creatorImg,
                category.name as category,
                GROUP_CONCAT(DISTINCT tag.name) as tags
            FROM
                wiki
            JOIN category ON wiki.category_id = category.id
            INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
            INNER JOIN tag ON wiki_tag.tag_id = tag.id
            INNER JOIN user ON wiki.created_by = user.id
            AND wiki.status = :status
            AND wiki.category_id = :category_id
            GROUP BY
                wiki.id,
                wiki.title,
                wiki.content,
                wiki.created_at,
                creatorId,
                creatorName,
                creatorImg,
                category,
                status
            ORDER BY wiki.updated_at desc

        ");
        $this->db->bind(":status" , 0);
        $this->db->bind(":category_id" , $categoryId);
        return $this->db->resultSet();
    }

    public function getWikiByTag($tag){
        $this->db->query("
                SELECT
                DISTINCT wiki.*,
                user.id as creatorId,
                user.full_name as creatorName,
                user.imgUrl as creatorImg,
                category.name as category,
                GROUP_CONCAT(DISTINCT tag.name) as tags
            FROM
                wiki
            JOIN category ON wiki.category_id = category.id
            INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
            INNER JOIN tag ON wiki_tag.tag_id = tag.id
            INNER JOIN user ON wiki.created_by = user.id
            AND wiki.status = :status
            AND tag.id = :tag_id
            GROUP BY
                wiki.id,
                wiki.title,
                wiki.content,
                wiki.created_at,
                creatorId,
                creatorName,
                creatorImg,
                category,
                status
            ORDER BY wiki.updated_at desc

        ");
        $this->db->bind(":status" , 0);
        $this->db->bind(":tag_id" , $tag);
        return $this->db->resultSet();
    }

    public function getWikiByCategoryAndTag($category , $tag){
        $this->db->query("
                SELECT
                DISTINCT wiki.*,
                user.id as creatorId,
                user.full_name as creatorName,
                user.imgUrl as creatorImg,
                category.name as category,
                GROUP_CONCAT(DISTINCT tag.name) as tags
            FROM
                wiki
            JOIN category ON wiki.category_id = category.id
            INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
            INNER JOIN tag ON wiki_tag.tag_id = tag.id
            INNER JOIN user ON wiki.created_by = user.id
            AND wiki.status = :status
            AND tag.id = :tag_id
            AND  wiki.category_id = :category_id
            GROUP BY
                wiki.id,
                wiki.title,
                wiki.content,
                wiki.created_at,
                creatorId,
                creatorName,
                creatorImg,
                category,
                status
            ORDER BY wiki.updated_at desc

        ");
        $this->db->bind(":status" , 0);
        $this->db->bind(":tag_id" , $tag);
        $this->db->bind(":category_id" , $category);
        return $this->db->resultSet();
    }

    public function getwikiPerCategory(){
        $this->db->query("
        SELECT category.name as category, COUNT(wiki.id) as wikiCount
         FROM category
          LEFT JOIN wiki ON category.id = wiki.category_id
           GROUP BY category.id, category.name;
        
        ");
        return $this->db->resultSet();
    }

    public function getwikiPerTags(){
        $this->db->query("
                SELECT
            tag.name as tag,
            COUNT(wiki.id) as wikiCount
        FROM
            tag
        LEFT JOIN  wiki_tag ON tag.id = wiki_tag.tag_id
        LEFT JOIN  wiki ON wiki_tag.wiki_id = wiki.id
        GROUP BY
            tag.id, tag.name;

        
        ");
        return $this->db->resultSet();
    }

    public function getNumOfWiki(){
        $this->db->query("SELECT id FROM wiki WHERE status = :status ;");
        $this->db->bind(":status",0);
        $this->db->execute();
        return $this->db->rowCount();
    }
}