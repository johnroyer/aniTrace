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
      $this->db->where( array(
         'sn' => $aniId,
         'user_id' => $this->uid
      ) );
      $result = $this->db->get('list')->result_array();
      return $result[0]['vol'];
   }

   public function getBuy($aniId)
   {
      $this->db->where( array(
         'sn' => $aniId,
         'user_id' => $this->uid
      ) );
      $result = $this->db->get('list')->result_array();
      return $result[0]['buy'];
   }

   public function setAni($aniId, $name, $sub, $vol)
   {
   }

   public function setName($aniId, $name)
   {
   }

   public function setSub($aniId, $sub)
   {
   }

   public function setVol($aniId, $vol)
   {
      $this->db->where('sn', $aniId);
      $this->db->where('user_id', $this->uid);
      return $this->db->update('list', array('vol' => $vol) );
   }

   public function volDown($aniId)
   {
      $vol = $this->getVol($aniId);
      if( $vol > 0 ){
         $vol -= 1;
      }else{
         $vol = 0;
      }
      $this->setVol($aniId, $vol);
   }

   public function volUp($aniId)
   {
      $this->setVol($aniId, $this->getVol($aniId) + 1 );
   }

   public function setBuy($aniId, $vol)
   {
      $this->db->where('sn', $aniId);
      $this->db->where('user_id', $this->uid);
      return $this->db->update('list', array('buy' => $vol) );
   }

   public function newAni($name, $sub)
   {
      $data = array(
         'user_id' => $this->uid,
         'name' => $name,
         'sub' => $sub,
         'vol' => 0,
         'buy' => 0
      );
      $this->db->insert('list', $data);
   }

   public function deleteAni($aniId)
   {
      $data = array(
         'sn' => $aniId
      );
      $this->db->where('user_id', $this->uid);
      $this->db->delete('list', $data);
   }
}
