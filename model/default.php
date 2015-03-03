<?php

namespace Model;

class HomePage
{
    public $db;
   
    function __construct($db) 
    {
        $this->db = $db;
    }
    
    function getAllArticles($arrays)
    {
        $sql = 'SELECT *, articles.id AS articles_id FROM articles LEFT JOIN users ON articles.author = users.fb_id ORDER BY articles.id DESC LIMIT :offset, :limit';
        
        $q = $this->db->query($sql, $arrays);
               
        return $q;
    }
    
    function getNumOfArticles() 
    {
        $sql = 'SELECT * FROM articles';
        $stmt = $this->db->numOfRows($sql);
        
        return $stmt; 
    }
    
    function getComments($arrays)
    {
        $sql = 'SELECT * FROM comments WHERE article_id = :id';
        $stmt = $this->db->numOfRows($sql, $arrays);
        
        return $stmt;
    }
}

$homepage = new HomePage($db);

// create some global depo
function makeNiceTitleInUrl($title)
{
    $url = str_replace(array(' '), array('-'), mb_strtolower($title));
            
    return urlencode($url);
}