<?php
$api = '';
$db = '';

$mongo = new MlabAPI($api,$db);

/*
  Delete
*/
$iO = $mongo->delete('projects2',[]);
print_r($iO);
die();

/*
  UpdateMany
*/
$dat = [
  [
    'domain' => 'd2'
  ],
  [
    '$set' => ['username' => 'kovet']
  ]
];
$iO = $mongo->updateMany('projects2',$dat);
print_r($iO);
die();

/*
  UpdateOne
*/
$dat = [
  [
    'domain' => 'd1'
  ],
  [
    '$set' => ['username' => 'kovet']
  ]
];
$iO = $mongo->updateOne('projects2',$dat);
print_r($iO);
die();

/*
  Insert Many
*/
$dat = [
  [
    'domain' => 'd1'
  ],
  [
    'domain' => 'd2'
  ]
];
$iO = $mongo->insertMany('projects2',$dat);
print_r($iO);

/*
  Insert One
*/
$dat = [
  'domain' => 'thekopet.com'
];
$iO = $mongo->insertOne('projects2',$dat);
print_r($iO);

/*
  Find One
*/
$one = $mongo->findOne('projects2',[]);
$one = $mongo->findOne('projects2',['username' => 'arizoa']);
print_r($one);

/*
  Find Many
*/
$many = $mongo->find('projects2',[]);
$many = $mongo->find('projects2',
  [
    'username' => 'rizoa',
    //'clusterkw' => 'cluster-5'
  ],
  [
    'projection' => [
      'domain' => 1,
      'username' => 1,
      '_id' => 0
    ],
    'limit' => 1,
    //'skip' => 0,
    'sort' => ['domain' => 1],
  ]
);
print_r($many);


/*
  Count
*/
$count = $mongo->count('projects2',[]);
$count = $mongo->count('projects2',['status' => 'deindex']);
echo $count;



?>
