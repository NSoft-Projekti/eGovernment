<?php

$sql1= mysql_query("select * from post inner join subcategory on post.idsubcategory=subcategory.idsubcategory
				                      where post.idpost_type='3' ");
$maxidpost=0;
$maxvotecount= 0;
while($row=mysql_fetch_assoc($sql1)){
    $idsubcategory=$row['idsubcategory'];
    $sql2=mysql_query("select * from post where idsubcategory=$idsubcategory");

    while ($row2=mysql_fetch_assoc($sql2)){
        $idpost=$row2['idpost'];

        $sql3=mysql_query("select count(votevalue) as votecount ,vote.idpost,post.content from vote inner join post on vote.idpost=post.idpost where vote.idpost=$idpost ");
        while($row3=mysql_fetch_assoc($sql3)){
            $votecount=$row3['votecount'];


            if($votecount>$maxvotecount){
                $maxvotecount=$votecount;
                $maxidpost=$row3['idpost'];

            }
        }

    }

}
if($maxidpost>0){
    $sql4=mysql_query("select * from post where idpost=$maxidpost");
    $row4=mysql_fetch_assoc($sql4);
    $idpost=$row4['idpost'];



    echo ' <div class="entry"><p>'.$row4["content"].'</p></div>';
    echo '<p class="links"><a href="suggestionDetails.php?id='.$idpost.'" class="right">Pročitaj više</a></p></br>';


}
else
    echo 'Nema nista izglasano!!!!!!!!!!!!';
?>