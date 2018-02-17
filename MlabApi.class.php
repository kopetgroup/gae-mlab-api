<?php

/**
 * Ikamai Mlab v1
 * 18 Februari 2018
 */
class MlabAPI {
  private $api;
  private $db;
  function __construct($api,$db){
    $this->api = $api;
    $this->db = $db;
  }
  /*
    Delete
  */
  public function delete($col='',$q=[]){
    $d = json_decode(file_get_contents('https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?apiKey='.$this->api.'&q='.json_encode($q)));
    if($d){
      $oc = [];
      foreach($d as $o){
        $dx = '$oid';
        $id = $o->_id->$dx;
        $opts = array('http' =>
          array (
            'method' => 'DELETE',
            'header' =>
              'Content-type: application/json'."\n"
          )
        );
        $context  = stream_context_create($opts);
        $url = 'https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'/'.$id.'?apiKey='.$this->api;
        $result = @file_get_contents($url, false, $context);
        $oc[] = json_decode($result);
      }
      return $oc;
    }
  }
  /*
    Update Many
  */
  public function updateMany($col='',$q=[]){
    if(!empty($q)){
      if(isset($q[0]) && isset($q[1])){
        // Set the POST options
        $opts = array('http' =>
          array (
            'method' => 'PUT',
            'header' =>
              'Content-type: application/json'."\n",
            'content' => json_encode($q[1])
          )
        );
        $context  = stream_context_create($opts);
        $url = 'https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?m=true&apiKey='.$this->api.'&q='.json_encode($q[0]);
        $result = @file_get_contents($url, false, $context);
        return json_decode($result);
      }
    }else{
      return [];
    }
  }
  /*
    Update One
  */
  public function updateOne($col='',$q=[]){
    if(!empty($q)){
      if(isset($q[0]) && isset($q[1])){
        // Set the POST options
        $opts = array('http' =>
          array (
            'method' => 'PUT',
            'header' =>
              'Content-type: application/json'."\n",
            'content' => json_encode($q[1])
          )
        );
        $context  = stream_context_create($opts);
        $url = 'https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?apiKey='.$this->api.'&q='.json_encode($q[0]);
        $result = @file_get_contents($url, false, $context);
        return json_decode($result);
      }
    }else{
      return [];
    }
  }
  /*
    Insert One
  */
  public function insertMany($col='',$data=[]){
    if(!empty($data)){
      // Set the POST options
      $opts = array('http' =>
        array (
          'method' => 'POST',
          'header' =>
            'Content-type: application/json'."\n",
          'content' => json_encode($data)
        )
      );
      $context  = stream_context_create($opts);
      $url = 'https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?apiKey='.$this->api;
      $result = @file_get_contents($url, false, $context);
      return json_decode($result);
    }else{
      return [];
    }
  }
  /*
    Insert One
  */
  public function insertOne($col='',$data=[]){
    if(!empty($data)){
      // Set the POST options
      $opts = array('http' =>
        array (
          'method' => 'POST',
          'header' =>
            'Content-type: application/json'."\n",
          'content' => json_encode([$data])
        )
      );
      $context  = stream_context_create($opts);
      $url = 'https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?apiKey='.$this->api;
      $result = @file_get_contents($url, false, $context);
      return json_decode($result);
    }else{
      return [];
    }
  }
  /*
    count
  */
  public function count($col='',$q=[]){
    if(empty($q)){
      $dat = file_get_contents('https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?c=true&apiKey='.$this->api);
    }else{
      $dat = file_get_contents('https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?c=true&apiKey='.$this->api.'&q='.json_encode($q));
    }
    if($dat==''){
      $dat = '{}';
    }
    return json_decode($dat);
  }
  /*
    skip,limit,projection,sort
  */
  public function find($col='',$q=[],$o=[]){
    //projection
    $f = '';
    if(!empty($o)){
      if(isset($o['projection'])){
        $f = '&f='.json_encode($o['projection']);
      }
    }
    //limit
    $l = '';
    if(!empty($o)){
      if(isset($o['limit'])){
        $l = '&l='.json_encode($o['limit']);
      }
    }
    //skip
    $s = '';
    if(!empty($o)){
      if(isset($o['skip'])){
        $s = '&sk='.json_encode($o['skip']);
      }
    }
    //sort
    $srt = '';
    if(!empty($o)){
      if(isset($o['sort'])){
        $srt = '&s='.json_encode($o['sort']);
      }
    }
    if(empty($q)){
      $dat = file_get_contents('https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?apiKey='.$this->api.$f.$l.$s.$srt);
    }else{
      $dat = file_get_contents('https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?apiKey='.$this->api.'&q='.json_encode($q).$f.$l.$s.$srt);
    }
    if($dat==''){
      $dat = '{}';
    }
    return json_decode($dat);
  }
  /*
   (array) q
  */
  public function findOne($col='',$q=[]){
    if(empty($q)){
      $dat = file_get_contents('https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?fo=true&apiKey='.$this->api);
    }else{
      $dat = file_get_contents('https://api.mlab.com/api/1/databases/'.$this->db.'/collections/'.$col.'?fo=true&apiKey='.$this->api.'&q='.json_encode($q));
    }
    if($dat==''){
      $dat = '{}';
    }
    return json_decode($dat);
  }
}
?>
