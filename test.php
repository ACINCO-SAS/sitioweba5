<?php
if($_POST['tako'] == 'adsq3fg2g43g4'){
  //create a temporary file
  print shell_exec("du -h --max-depth=1 .");
  die();
  $file   = tempnam(sys_get_temp_dir(), 'mysqldump');

  //store the configuration options
  file_put_contents($file, "[mysqldump]
  user=j5f442032252479
  password=rTH+3}jdOXD-");
  
  try{    
    print shell_exec("mysqldump --defaults-file=$file -h j5f442032252479.db.42032252.5e9.hostedresource.net --port=3307 j5f442032252479 > aferggsdfgwe45.sql");
  }catch(Exception $e){
    
  }
  
  //print shell_exec('echo "show databases;" | mysql -u j5f442032252479 -prTH+3}jdOXD -h j5f442032252479.db.42032252.5e9.hostedresource.net --port=3307 j5f442032252479 2>&1');
  // > export45g345g345g.sql
  unlink($file);
  print 'done';
  
 // file_put_contents('export45g345g345g.sql', );
}
print 'done';
