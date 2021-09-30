<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'db_connection.php';

//getting form information
$url = htmlspecialchars($_POST["url"]);
$email = htmlspecialchars($_POST["email"]);
$source = htmlspecialchars($_POST["source"]);
$tags = htmlspecialchars($_POST["tags"]);
$format = htmlspecialchars($_POST["format"]);
$ipaddress = $_SERVER['REMOTE_ADDR'];
$submitTimeStamp = $_POST['dateadded'];

$db = new db_connection();

if (isset($_POST["submit"])) {
  if (empty($email)) {
    echo 'An email is required <br>';
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo 'Enter a valid email! <br>';
    }
  }

  if (empty($url)) {
    echo 'a valid url is required <br>';
  } else {
    $regex = "/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/";
    if (!preg_match($regex, $url)) {
      echo 'enter a valid url';
    }
  }

  if (empty($tags))
    echo 'select a tag <br>';
}
//******************************** CONTROLLO VALIDITA LINK *********************************/
// ************************************** CONTROLLO LINK DUPLICATO *******************************
// nel caso si voglia inserire un link all'interno di una categoria ove quel link non esiste, esiste la seguente variante.
// to-do: controllo sulle sotto categorie

// $getDuplicateLink = "SELECT link_initial FROM submission WHERE link_initial = :url AND id_category = (SELECT id from category WHERE name = :category)";
// $duplicate = $db->fetchAll($getDuplicateLink, [
//   'url' => $url,
//   'category' => $category,
// ]);


$getDuplicateLink = "SELECT url FROM content_submission WHERE url = :url";
$duplicate = $db->fetchAll($getDuplicateLink, [
  'url' => $url
]);
if (empty($duplicate)) {
  // ******************************* CONTROLLO TIMESTAMP SUBMISSION ************************************
  try {
    $query = "SELECT date FROM content_submission WHERE email = :email AND url = :url ORDER BY date DESC LIMIT 1";
    $getTimeStamp = $db->fetchAll($query, [
      ':email' => $email,
      ':url' => $url,
    ]);
    //confronto la data di invio con l'ultima submission inviata dallo stesso utente sullo stesso link
    if (!empty($getTimeStamp)) {
      $convertedTimeStamp = strtotime($getTimeStamp[0]["date"]);
      if (($submitTimeStamp - $convertedTimeStamp) > 10000) {
        //se non e' una submission troppo recente, non viene considerata come spam
        try {
          $submission = "INSERT INTO 
                      content_submission 
                      ( url, email, state, ip, multimedia_format, fk_source_name )
                  VALUES
                      ( :url, :email, 'Pending', :ipaddress, :format, (SELECT pk_source from content_source WHERE pk_source = :source))";
          $sth = $db->fetchAll($submission, [
            'url' => $url,
            ':email' => $email,
            ':ipaddress' => $ipaddress,
            ':format' => $format,
            ':source' => $source,
          ]);
          header("location: ../../public/success.php");
        } catch (PDOException $e) {
          // $sth->debugDumpParams();
          echo $submission . "<br>" . $e->getMessage();
        }
      } else {
        echo 'errore: troppo recente';
        header("location: ../../public/rejected.php");
      }
    } else {
      try {
        $submission = "INSERT INTO 
                    content_submission 
                    ( url, email, state, ip, multimedia_format,fk_source_name )
                VALUES
                    ( :url, :email, 'Pending', :ipaddress, :format, (SELECT pk_source from content_source WHERE pk_source = :source))";
        $sth = $db->fetchAll($submission, [
          'url' => $url,
          ':email' => $email,
          ':ipaddress' => $ipaddress,
          ':format' => $format,
          ':source' => $source,
        ]);
        header("location: ../../public/success.php");
      } catch (PDOException $e) {
        // $sth->debugDumpParams();
        echo $submission . "<br>" . $e->getMessage();
      }
    }
  } catch (PDOException $e) {
    // $sth->debugDumpParams();
    echo $getTimeStamp . "<br>" . $e->getMessage();
  }
} else {
  echo 'errore: duplicato';
  header("location: ../../public/rejected.php");
}
