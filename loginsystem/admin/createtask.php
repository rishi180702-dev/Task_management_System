<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
//Code for Updation 
if(isset($_POST['update']))
{
    $tname=$_POST['tname'];
    $id=$_POST['id'];
    $tstatus=$_POST['tstatus'];
    $tdeadline=$_POST['tdeadline'];
  
$taskid=$_GET['tid'];
    $msg=mysqli_query($con,"INSERT INTO tasks (tname, id, tstatus, tdeadline) VALUES (?, ?, ?, ?)");

if($msg)
{
    echo "<script>alert('Profile updated successfully');</script>";
       echo "<script type='text/javascript'> document.location = 'manage-tasks.php'; </script>";
}
}

// Define variables and initialize with empty values
$tname = $id = $tstatus = $tdeadline = "";
$tname_err = $id_error = $tstatus_err = $tdeadline_err = "";
 
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $id = $_POST["id"];
    
    // Validate name
    $input_tname = trim($_POST["tname"]);
    if(empty($input_tname)){
        $tname_err = "Please enter a name.";
    } elseif(!filter_var($input_tname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $tname_err = "Please enter a valid name.";
    } else{
        $tname = $input_tname;
    }
   
    $tstatus = $_POST["tstatus"];
    $tdeadline = $_POST["tdeadline"];
      

       
    
    // Check input errors before inserting in database
    if(empty($id_err)  &&  empty($tname_err)  &&  empty($tstatus_err) && empty($tdeadline_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO tasks (tname, id, tstatus, tdeadline) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siss", $param_tname,  $param_id, $param_tstatus,$param_tdeadline);
            
            
            
            $param_tname= $tname;
            $param_id = $id;         
            $param_tstatus = $tstatus;
            $param_tdeadline = $tdeadline;
                                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: manage-tasks.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($con);
}
?>
 
 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit Profile | Registration and Login System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
            <body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Assign Task</h2>
                    <p>Please fill this form and assign an task to employee and maintain a record database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                            <label>Employee id</label>
                            <input type="text" name="id" class="form-control <?php echo (!empty($id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $id; ?>">
                            <span class="invalid-feedback"><?php echo $id_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" name="tname" class="form-control <?php echo (!empty($tname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tname; ?>">
                            <span class="invalid-feedback"><?php echo $tname_err;?></span>
                        </div>                        
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="tstatus" class="form-control <?php echo (!empty($tstatus_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tstatus; ?>">
                            <span class="invalid-feedback"><?php echo $tstatus_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="date" name="tdeadline"  class="form-control" <?php echo (!empty($tdeadline_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tdeadline; ?>">
                            <span class="invalid-feedback"><?php echo $tdeadline_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="manage-tasks.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>


                    </div>
                </main>
          <?php include('../includes/footer.php');?>
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
