<?php
    function setPager($file,$actPage,$totalPage){
        $site=$file;
        echo '<table id="navi" align="right"><tr>';
        if ($totalPage == 0) {
            echo "<td>No record found.</td>";
        }
        elseif ($totalPage == 1){
            echo "<td id=\"first\">Page 1 of 1</td>";
        }
        elseif ($totalPage>1 && $totalPage<5){
            if ($actPage==1) {
            	echo "<td id=\"first\">Page 1 of $totalPage</td><td>1</td>";
            	for ($i=2;$i<=$totalPage;$i++){
            	    echo '<td><a href="'.$site.'&page='.$i.'">'.$i.'</td>';
            	}
            }
            elseif ($actPage>1){
            	echo "<td id=\"first\">Page $actPage of $totalPage</td>";
            	for ($i=1;$i<=$totalPage;$i++){
            	    if ($i == $actPage) echo "<td id=\"naviact\">$actPage</td>";
            	    else echo '<td><a href="'.$site.'&page='.$i.'">'.$i.'</td>';
            	}

            }

        }
        elseif ($totalPage>=5){

            if ($actPage == 1) {
            	echo "<td id=\"first\">Page $actPage of $totalPage</td>";
            	$i=1;
            	for ($i=1;$i<5;$i++){
            	    if ($i == $actPage) echo "<td id=\"naviact\">$actPage</td>";
            	    else echo '<td><a href="'.$site.'?page='.$i.'">'.$i.'</td>';
            	}
            	echo '<td><a href="'.$site.'&page='.($actPage+1).'">></td>';
            	echo '<td><a href="'.$site.'&page='.($totalPage).'">Last</td>';

            }
            elseif ($actPage > 1 && $actPage < $totalPage){
            	echo "<td id=\"first\">Page $actPage of $totalPage</td>";
            	echo '<td><a href="'.$site.'&page=1">First</td>';
            	echo '<td><a href="'.$site.'&page='.($actPage-1).'"><</td>';
            	$i=$actPage;
            	for ($i=$actPage-1;$i<=$actPage+1;$i++){
            	    if ($i == $actPage) echo "<td id=\"naviact\">$actPage</td>";
            	    else echo '<td><a href="'.$site.'&page='.$i.'">'.$i.'</td>';
            	}
            	echo '<td><a href="'.$site.'&page='.($actPage+1).'">></td>';
            	echo '<td><a href="'.$site.'&page='.($totalPage).'">Last</td>';

            }
            elseif ($actPage == $totalPage){
            	echo "<td id=\"first\">Page $actPage of $totalPage</td>";
            	echo '<td><a href="'.$site.'&page=1">First</td>';
            	echo '<td><a href="'.$site.'&page='.($actPage-1).'"><</td>';
            	$i=$actPage;
            	for ($i=$actPage-2;$i<=$actPage;$i++){
            	    if ($i == $actPage) echo "<td id=\"naviact\">$actPage</td>";
            	    else echo '<td><a href="'.$site.'&page='.$i.'">'.$i.'</td>';
            	}

            }

        }

        echo "</tr></table>";

    }

?>