# Ikamai MLAB API PHP

class mirip php mongodb

```
$api = '';
$db = '';

$mongo = new MlabAPI($api,$db);
```

conto:
```
/*
  Insert One
*/
$dat = [
  'domain' => 'thekopet.com'
];
$iO = $mongo->insertOne('projects2',$dat);
print_r($iO);
```
