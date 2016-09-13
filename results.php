<?php
    include("config.php");

    if (isset($_REQUEST["search"]))
    {
        $search = $_REQUEST["search"];
    }
    else
    {
        $search = null;
    }

    if(empty($search)){
        $query = "SELECT * FROM STREETS";
        // LIMIT 10
    }
    else{
        $query = "SELECT * FROM STREETS WHERE area = '$search';";
        $query .= "SELECT * FROM STREETS WHERE area_id = '$search';";
        $query .= "SELECT * FROM STREETS WHERE streetname = '$search';";
        $query .= "SELECT * FROM STREETS WHERE pscdukfrm = '$search';";
        $query .= "SELECT * FROM STREETS WHERE pscdusfrm = '$search';";

//        $query = "SELECT * FROM STREETS WHERE area LIKE '%$search%';";
//        $query .= "SELECT * FROM STREETS WHERE area_id LIKE '%$search%';";
//        $query .= "SELECT * FROM STREETS WHERE streetname LIKE '%$search%';";
//        $query .= "SELECT * FROM STREETS WHERE pscdukfrm LIKE '%$search%';";
//        $query .= "SELECT * FROM STREETS WHERE pscdusfrm LIKE '%$search%';";
    }

//    echo $query;
//    $result = mysqli_multi_query($connector, $query);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href= "styles.css">
        <link rel="stylesheet" href="normalize.css">
<!--        <script type="text/javascript" src="scripts.js" async></script>-->
        <title>Search Results</title>
    </head>
    <body>
        <div id="login">
            <form action="logout.php">
                <input type="submit" value="Sign Out" id="logout"/>
            </form>
        </div>
        <div id="headerbar">
            <a href="home.php" >
                <img class="logo" src="images/flag.gif" alt="home">
                <h4 class="header"> NGA Addressing </h4>
            </a>
        </div>
        <div id="resultbody">
            <h1 class="subheader"> Search Results </h1>
            <table class="results">
                <thead>
                <tr>
                    <th>State ID</th>
                    <th>LGA</th>
                    <th>LGA ID</th>
                    <th>Area</th>
                    <th>Area ID</th>
                    <th>Area No.</th>
                    <th>Street Name</th>
                    <th>Street ID</th>
                    <th>Post Code (UK)</th>
                    <th>Post Code (US)</th>
                </tr>
                </thead>
                <tbody>
                    <?php
//                    $result = mysqli_query($connector, "SELECT * FROM STREETS");
                    if(mysqli_multi_query($connector, $query)){
                        do{
                            if($result = mysqli_store_result($connector)){
                                while( $row = mysqli_fetch_row($result)) {
                                    echo
                                    "<tr>
                                    <td>{$row[0]}</td>
                                    <td>{$row[1]}</td>
                                    <td>{$row[2]}</td>
                                    <td>{$row[3]}</td>
                                    <td>{$row[4]}</td>
                                    <td>{$row[5]}</td>
                                    <td>{$row[6]}</td>
                                    <td>{$row[7]}</td>
                                    <td>{$row[8]}</td>
                                    <td>{$row[9]}</td>
                                </tr>\n";
                                }
                                mysqli_free_result($result);
                            }
                        } while (mysqli_more_results($connector) && mysqli_next_result($connector));

                    }

                    ?>
                </tbody>
            </table>
            <?php mysqli_close($connector); ?>
        </div>
        <p id="footer"> Microsystems International &copy;</p>
    </body>
</html>