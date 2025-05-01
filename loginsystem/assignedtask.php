<?php session_start();
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Profile | Registration and Login System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4">Assigned Tasks</h1>
                    <?php 
$taskid=$_SESSION['id'];
$query=mysqli_query($con,"select * from tasks where id='$taskid' and tstatus='pending'");
while($result=mysqli_fetch_array($query))
{?>
                                
                        <div class="card mb-4">
                     
                            <div class="card-body">
                                
                                <table class="table table-bordered">
                                           
                                   <tr>
                                    <th>Task Details</th>
                                       <td><?php echo $result['tname'];?></td>
                                   </tr>
                                  
                                   <tr>
                                       <th>Status</th>
                                       <td colspan="3"><?php echo $result['tstatus'];?></td>
                                   </tr>
                                     <tr>
                                       <th>Deadline</th>
                                       <td colspan="3"><?php echo $result['tdeadline'];?></td>
                                   </tr>
                                                                
                                        <tr>
                                       <th>Reg. Date</th>
                                       <td colspan="3"><?php echo $result['posting_date'];?></td>
                                   </tr>
                                                            
                                   <tr>
                                       <th>Action</th>
                                       <td colspan="3"><a href='taskcom.php?tid="<?php echo $result['tid']?>" ' >Complete</a></td>
                                   </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<?php } ?>

                    </div>
                </main>
          
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
