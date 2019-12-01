<h3>Le code couleur suivant vous permet de gérer les attestations des donneurs :</h3>
<span  class='yellow'></span><p class="expliq">Le montant du don est inférieur à 40€ .</p>
<span  class='gray'></span><p class="expliq">L'attestation n'a pas encore été envoyée .</p>
<span  class='green'></span><p class="expliq">L'attestation a été envoyée .</p>

<div class="wrap">
	<h1>Gérer les donneurs</h1>

    <?php
    
    global $wpdb ; 
    
    $table_name = $wpdb->prefix . "donneur";
  
    $results = $wpdb->get_results( "SELECT * FROM $table_name " );  
 /*    CREATE TABLE IF NOT EXISTS `wp_mira`.`t1` (
        `col` VARCHAR(16) NOT NULL
    ) 
 */
    echo"
    <style>
    .expliq{
        display: inline;
        margin-right:15px
    }
    .yellow {
        height: 14px;
        width: 14px;
        background-color: #FAD05D;
        border-radius: 50%;
        display: inline-block;
      }
    .green {
        height: 14px;
        width: 14px;
        background-color: #0DA72D;
        border-radius: 50%;
        display: inline-block;
      }
    .gray {
        height: 14px;
        width: 14px;
        background-color: gray;
        border-radius: 50%;
        display: inline-block;
      }
    #customers {
    font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid black;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #FAD05D;
    color: #242357;
    }
    </style>
    </head>
    <body>

    <table id='customers'>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Adresse</th>
        <th>Code postal</th>
        <th>N Téléphone</th>
        <th>Montant(€)</th>
        <th>Date</th>
        
        <th style='text-align:center' colspan='2'>Status</th>
    </tr>
    "; 
   

//show action if the status is 0


    foreach($results as $result)
    {
        $time = $result->date ;
        $date = DateTime::createFromFormat("Y-m-d H:i:s",$time )->format("d/m/Y");
       if( $result->status==0 && $result->montant >= 40 )
        {
           $color = 'gray'; 
                 
        }elseif( $result->status==1 && $result->montant >= 40 )
        {
            $color ='green';
        }elseif($result->montant < 40)
        {
            $color = 'yellow';
        }

       echo"<tr>
            <td>".$result->lname."</td>
            <td>".$result->fname."</td>
            <td>".$result->email."</td>
            <td>".$result->city.' ,'.$result->ad1."</td>
            <td>".$result->codepostal."</td>
            <td>".$result->gsm."</td>
            <td>".$result->montant."</td>
            <td>".$date."</td>
            <td><span  data-id='$result->id' class='bullet $color'></span></td>
            ";
            if( $result->status==0 &&  $result->montant >= 40 )
            {
            echo"<td><button data-id='$result->id' id='btn' class='validate'>Envoyée</button></td> ";
            }elseif($result->montant < 40)
            {
                echo"<td>moins de 40€</td>";
            }
            else
                        echo "<td>ok !</td>";
        
            echo "</tr>";
       
    }
    echo"
    </table>";
;  
    ?>
    
</div>