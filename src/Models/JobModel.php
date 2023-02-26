<?php
namespace  App\Models;
use PDO;
use PDOException;

class JobModel
{

    private  PDO $db;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host='.DB_URL.';dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            print "DB Error: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    public function truncate(){
        $exec = $this->db->prepare("TRUNCATE TABLE hits");
        return $exec->execute();
    }
    public function insert(array $data){

        $insertData = [
            "jobId" => $data["job_id"],
            "jobTitle" => $data["job_title"],
            "dateTime" => $data["date_time"],
        ];
        $exec = $this->db->prepare("INSERT INTO hits (job_id, job_title, date_time) VALUES(:jobId, :jobTitle, :dateTime)");
        return $exec->execute($insertData);
    }


    public function getJobReport() :array|null{
        $sql = "SELECT job_title AS title, COUNT(*) AS hit_count, MIN(date_time) AS first_access, MAX(date_time) AS last_access 
        FROM hits 
        GROUP BY job_title 
        ORDER BY hit_count ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}