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

   public function getList($all = 0)
   {
      $this->db->order_by('sn', 'asc');
      $this->db->where('user_id', $this->uid);
      if( $all == 0 ){
        $this->db->where('(
               (`buy` = 0 and `vol` = 0)
            or (`buy` > `vol` or `finished` = 0)
        )');
      }
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
      $result = $this->getRow($aniId);
      return $result[0]['vol'];
   }

   public function getBuy($aniId)
   {
      $result = $this->getRow($aniId);
      return $result[0]['buy'];
   }

   public function getFinished($aniId)
   {
      $result = $this->getRow($aniId);
      return $result[0]['finished'];
   }

   public function getRow($aniId)
   {
      $this->db->where( array(
         'sn' => $aniId,
         'user_id' => $this->uid
      ) );
      return $this->db->get('list')->result_array();
   }

   public function setAni($aniId, $name='', $sub='', $vol=0, $buy=0, $link='')
   {
      $vol = intval( $vol );
      $buy = intval( $buy );
      $vol = $vol >= 0 ? $vol : 0;
      $buy = $buy >= 0 ? $buy : 0;
      $this->db->where('sn', $aniId);
      $this->db->where('user_id', $this->uid);
      $data = array(
         'name' => $name,
         'sub' => $sub,
         'vol' => $vol,
         'buy' => $buy,
         'link' => $link
      );
      return $this->db->update('list', $data );
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

   public function setFinished($aniId)
   {
      $finished = $this->getFinished($aniId);
      $finished = ( $finished + 1 ) % 2;  // Swap between 0 and 1
      $this->db->where('user_id', $this->uid);
      $this->db->where('sn', $aniId);
      $this->db->update('list', array('finished' => $finished) );
      return $finished;
   }

   public function buyDown($aniId)
   {
      $buy = $this->getBuy($aniId);
      if( $buy > 0 ){
         $buy -= 1;
      }else{
         $buy = 0;
      }
      $this->setBuy($aniId, $buy);
   }

   public function buyUp($aniId)
   {
      $this->setBuy($aniId, $this->getBuy($aniId) + 1 );
   }

   public function newAni($name, $sub='', $link='')
   {
      $data = array(
         'user_id' => $this->uid,
         'name' => $name,
         'sub' => $sub,
         'vol' => 0,
         'buy' => 0,
         'link' => $link
      );
      $this->db->insert('list', $data);
      return $this->db->insert_id();
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
