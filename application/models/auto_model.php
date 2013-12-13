<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auto_Model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function search($table, $column, $part)
    {
        $array = array();
        
        $query = $this->db->query("SELECT `$column` FROM `$table` WHERE `$column` LIKE '%$part%'");
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
            {
                $array[] = $row->$column;
            }
        }
        
        return $array;
    }
}
?>