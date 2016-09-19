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

    $limit = 10; //number of results you want shown

    if(isset($_REQUEST["current"])){
        $offset = 10*($_REQUEST["current"]-1); //last number of previous set
    //        $limitStart = ((10*$_REQUEST["current"])-9);
    //        $limitEnd = (10*$_REQUEST["current"]);
    }
    else{
        $offset = 1;
    }

    if(empty($search)){
        $query = "SELECT * FROM STREETS LIMIT $offset, $limit";
        $countquery = mysqli_query($connector, "SELECT COUNT(*) FROM STREETS", MYSQLI_STORE_RESULT);
        $countquery = mysqli_fetch_assoc($countquery);
        $total = $countquery["COUNT(*)"];
//        echo $countquery["COUNT(*)"];
//print_r($cq);
//        mysqli_free_result($countquery);

        // LIMIT 10
    }
    else{
        $query = "SELECT * FROM STREETS WHERE area = '$search';";
        $query .= "SELECT * FROM STREETS WHERE area_id = '$search';";
        $query .= "SELECT * FROM STREETS WHERE streetname = '$search';";
        $query .= "SELECT * FROM STREETS WHERE pscdukfrm = '$search';";
        $query .= "SELECT * FROM STREETS WHERE pscdusfrm = '$search';";


        $countquery = mysqli_query($connector, "SELECT COUNT(*) FROM STREETS WHERE area LIKE '%$search%';"); //= '$search';");
        $countquery = mysqli_fetch_assoc($countquery)["COUNT(*)"];
        $total = $countquery;
        $countquery = mysqli_query($connector, "SELECT COUNT(*) FROM STREETS WHERE area_id LIKE '%$search%';");//= '$search';");
        $countquery = mysqli_fetch_assoc($countquery)["COUNT(*)"];
        $total = $total + $countquery;
        $countquery = mysqli_query($connector, "SELECT COUNT(*) FROM STREETS WHERE streetname LIKE '%$search%';"); //= '$search';");
        $countquery = mysqli_fetch_assoc($countquery)["COUNT(*)"];
        $total = $total + $countquery;
        $countquery = mysqli_query($connector, "SELECT COUNT(*) FROM STREETS WHERE pscdukfrm LIKE '%$search%';"); //= '$search';");
        $countquery = mysqli_fetch_assoc($countquery)["COUNT(*)"];
        $total = $total + $countquery;
        $countquery = mysqli_query($connector, "SELECT COUNT(*) FROM STREETS WHERE pscdusfrm LIKE '%$search%';"); //= '$search';");
        $countquery = mysqli_fetch_assoc($countquery)["COUNT(*)"];
        $total = $total + $countquery;
    }

    $count = 0;

//    echo $query;
//    $result = mysqli_multi_query($connector, $query);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
<!--        <link rel="stylesheet" type="text/css" href= "styles.css">-->
        <link rel="stylesheet" href="normalize.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href= "styles.css">
        <title>Search Results</title>
    </head>
    <body>
        <form id="logout" action="logout.php">
            <input type="submit" value="Sign Out" id="logoutlink" style="visibility: visible"/>
        </form>
        <div id="headerbar">
            <a href="home.php" >
                <img class="logo" src="images/flag.gif" alt="home">
                <h4 class="header"> NGA Addressing </h4>
            </a>
        </div>
        <div id="resultbody">
            <h1 class="subheader"> Search Results </h1>
            <?php
                if($search){
                    echo "<h5 class='subheader'>Showing Results for $search</h5>";
                }
                else{
                    echo "<h5 class='subheader'>Showing All Possible Results</h5>";
                }
                echo "<h5 class='subheader'>Found $total</h5>";

            ?>
            <form id="resultsearch" action="results.php" method="get">
                <input id="searchtype" type="search" name="search" placeholder="Search"/>
                <button id="searchsubmit" type="submit" value="search">&nbsp;</button>
            </form>
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
//                    if(isset($_REQUEST["current"])){
//                        $limitStart = ((10*$_REQUEST["current"])-9);
//                        $limitEnd = (10*$_REQUEST["current"]);
//                    }
                    if(mysqli_multi_query($connector, $query)) {
//                        for ($index = 0; $index <= $limitEnd; $index++) {
//                            while ($index >= $limitStart) {
                        do {
                            if ($result = mysqli_store_result($connector)) {
                                $count = $count + mysqli_num_rows($result);
                                while ($row = mysqli_fetch_row($result)) {
                                    $pscduk = str_split($row[8]);
                                    $pscdus = str_split($row[9]);
//                                    print_r($pscduk);
                                    $uk = "{$pscduk[0]}{$pscduk[1]}&nbsp;{$pscduk[2]}{$pscduk[3]}{$pscduk[4]}&nbsp;{$pscduk[5]}{$pscduk[6]}";
                                    $us = null;
                                    if (count($pscdus) == 7) {
                                        $us = "{$pscdus[0]}{$pscdus[1]}&nbsp;{$pscdus[2]}{$pscdus[3]}{$pscdus[4]}&nbsp;{$pscdus[5]}{$pscdus[6]}";
                                    } else if (count($pscdus) == 8) {
                                        $us = "{$pscdus[0]}{$pscdus[1]}&nbsp;{$pscdus[2]}{$pscdus[3]}{$pscdus[4]}&nbsp;{$pscdus[5]}{$pscdus[6]}{$pscdus[7]}";
                                    }
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
                                <td>{$uk}</td>
                                <td>{$us}</td>
                            </tr>\n";
                                }
                                mysqli_free_result($result);
                            }
                        } while (mysqli_more_results($connector) && mysqli_next_result($connector));
//                        }
//                    }
                    }
//                    echo "limit start $limitStart";
//                    echo "limit end $limitEnd";
                    ?>
                </tbody>
            </table>
            <?php mysqli_close($connector); ?>
        </div>

        <div class="text-center">
            <ul class="pagination">
                <?php
                $pages = round($total/10, 0);
//                    $count/10;

                if(isset($_REQUEST["current"])){
                    $current = $_REQUEST["current"];
                }
                else {
                    $current = 1;
                }
                $prev = $current - 1;
                $next = $current + 1;

                if($pages==1){
                    echo "<li class='disabled'><a href='#'>Previous</a></li>";
                    echo "<li class='disabled'><a href='#'>1</a></li>";
                    echo "<li class='disabled'><a href='#'>Next</a></li>";
                }
                else if($pages>1){

                    if($current!=1){
                        if($pages>6){
                            echo "<li><a href=\"results.php?search=$search&current=1\">First</a></li>";
                        }
                        echo "<li class='previous'><a href=\"results.php?search=$search&current=$prev\">Previous</a></li>";

                    }
                    else{
                        echo "<li class='disabled'><a href='#'>Previous</a></li>";
                    }


                    if($current<3){
                        $i=1;
                        $pages > 5 ? $max = 6 : $max = $current + 3;
                    }
                    else if($current>2){
                        $i=$current-2;
                        $max = $current + 3;
                    }
                    else if($current > $pages-5){
                        $i = $pages-5;
                        $max = $pages;
                    }

                    for($i; $i<=$pages && $i<$max; $i++){
                        if($i == $current){
                            echo "<li class='active'><a href='#'>$i</a></li>";
                        }
                        else{
                            echo "<li><a href=\"results.php?search=$search&current=$i\">$i</a></li>";
                        }
                    }

                    if($current == $pages){
                        echo "<li class='disabled'><a href='#'>Next</a></li>";
                    }
                    else{
                        echo "<li class='next'><a href=\"results.php?search=$search&current=$next\">Next</a></li>";
                        if($pages>6){
                            echo "<li><a href=\"results.php?search=$search&current=$pages\">Last</a></li>";
                        }
                    }
                }

                ?>
                <!--                 class="active" used to highlight what page youre on-->
            </ul>
        </div>

        <p id="footer"> Microsystems International &copy;</p>
    </body>
</html>