<?php
  define("SITE_ADDR","http://localhost/Search_Engine");
  include("./include.php");
  $site_title = 'Afaan Oromoo search Engine';
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title; ?></title>
    <link rel="stylesheet" href="./main.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="top_header">
            <div id="logo">
               <h1><a href="<?php echo SITE_ADDR; ?>" Afaan Oromoo Search Engine></a></h1> 
            </div>
        </div>
        <div id="main" class="shadow-box">
            <div id="content">
            <center>
                <form action="" method="get">
                     <table>
                         <tr>
                             <td>
                                 <input type="text" name="gaaffii" placeholder="iddoo barbaaddii" autocomplete="off">
                             </td>
                             <td>
                                 <input type="submit" name="" value="Barbaadi">
                             </td>
                         </tr>
                     </table>
                </form>
                 </center>
                 <?php
                 // to check if keywords were provided
                 if(isset($_GET['gaaffii']) && $_GET['gaaffii']!=''){
                     //save the keywords from the url
                     $gaaffii=trim($_GET['gaaffii']);
                     //create a database query and words string
                     $query_string="select * from search_engine where  ";
                     $display_word="";
                     // separate each the keyword
                     $keywords=explode(" ", $gaaffii);
                     //print_r($keywords);
                     foreach($keywords as $word){
                       // echo $word;
                        $query_string.="keywords LIKE '%".$word."%'OR ";//.= to append our db to our initial
                         $display_word.=$word." ";
                     }
                     $query_string=substr($query_string, 0 ,strlen($query_string) -3 ); 
                       //connect to database
                       $conn=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
                       $query=mysqli_query($conn,$query_string);
                       $result_count=mysqli_num_rows($query);


                       //check to see if any results were returned
                       if($result_count>0)
                       {
                        //display search result count to the user
                        echo '</br><div class="right"><b><u>'.$result_count.' </u></b> tu argannoo argame </div>';
                        echo 'Gaaffiin keessaan : <i> '.$display_word.'</i><hr /><br />';
                

                        echo '<table class="search">';
                        // display search result to the user
                        while ($row=mysqli_fetch_assoc($query)){
                             echo '<tr>
                             <td><h3><a href=" '.$row['url'].'">'.$row['title'].'</a></h3></td>
                             </tr>
                             <tr>
                             <td>'.$row['description'].'</td>
                             </tr>
                             <tr>
                             <td><i>'.$row['url'].'</i></td>
                             </tr>';

                        }
                        echo '</table>';
                       }
                       else
                         echo ' firii homtuu hin jiru.waan wayyii barbaadaa malee';
                     //echo $query_string;
                 }
                 else
                  echo 'maaloo waan wayyii barbaadaa malee';


                 ?>
            </div>
            <div id="footer"></div>
        </div>
    </div>
    
</body>
</html>