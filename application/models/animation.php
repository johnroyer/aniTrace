<?php

/**
 * 
 **/
class Animation extends CI_Model
{
   
   private $uid;

   function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function setUid($uid)
   {
      $this->uid = $uid;
   }

   public function getList()
   {
      $this->db->order_by('sn', 'asc');
      $this->db->where('user_id', $this->uid);
      return $this->db->get('list')->result_array();
   }

   public function getAni($aniId)
   {
   }

   public function getName($aniId)
   {
   }

   public function getSub($aniId)
   {
   }

   public function getVol($aniId)
   {
   }

   public function setAni($aniId, $name, $sub, $vol)
   {
   }

   public function setName($name)
   {
   }

   public function setSub($sub)
   {
   }

   public function setVol($vol)
   {
   }

   public function newAni($name, $sub, $vol)
   {
   }
}
