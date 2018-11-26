
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>  
<body style="margin:20px auto">  
<div class="container">
<div class="row header" style="text-align:center;color:green">
<h2><font color="white">Recettes</font></h2>
</div>
<table id="myTable" class="table table-striped" >  
        <thead>  
          <tr>  
            <th>Recette</th>  
            <th>Auteur</th>  
          </tr>  
        </thead>  
        <tbody>  
          <?php
$this->_t = 'Recettes';

foreach($recette as $rec) :
            ?>
                <tr>
                    <td><a href="ContenuRecette?id=<?php print_r(urlencode($rec->getTitre()));?>"> <img src="./files/<?php echo $rec->getImage();?>" alt="" width ="170em" height ="200em"  /></a></td>
                    <td><h1><?php echo $rec->getTitre(); ?></h1></td>
                </tr>


<?php endforeach; ?>
                </tbody>
                </table>
        </tbody>  
      </table>  
      </div>
</body>  
<script>
$(document).ready(function(){
    $('#myTable').dataTable({
        "lengthMenu": [[2, 5, 10, -1], [2, 5, 10, "All"]]
    })

});
</script>
</html>  