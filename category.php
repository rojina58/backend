
<?php 
require_once('./lib/database.php');
$uploadDir=PUBLIC_UPLOAD_PATH;
$formMsg="";
$allUsersData=array();
$idUserData=array();
$action="";
$id=0;
if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
{
    $id=$_REQUEST['id'];

}
if(isset($_REQUEST['action']) && !empty($_REQUEST['action']))
{
    $action=$_REQUEST['action'];

    switch($action)
    {
        case 'edit':
            //select user by id to preload details of selected user
            $idUserData=runSelectQuery("select * from users where id=".$id);
            $idUserData=$idUserData[0];
            break;

        case 'store':
            //edit operation
            //used to save result
            //insert operation
            //print_r([$_POST,$_FILES]);
            $id=$_POST['txtid'];
            $title=$_POST['txttitle'];
            $description=$_POST['txtdescription'];
            $thumb=$_POST['txtthumb'];
            $banner=$_POST['txtbanner'];
            $imgAvatarUrl="";
            $imgAvatarFile=null;

            //now checking avatar file if exist
            if(isset($_FILES['imgAvatar']['error']) && $_FILES['imgAvatar']['error']==0)
            {
                $imgAvatarFile=$_FILES['imgAvatar'];
                //image uploades sucessfully
                //now moving image to $uploadDir
                if(move_uploaded_file($imgAvatarFile['tmp_name'],$uploadDir.'/'.$imgAvatarFile['name']))
                {
                    $imgAvatarUrl=PUBLIC_UPLOAD_URL.'/'.$imgAvatarFile['name'];

                }
            }
            if($id<1)
                $sqlQuery=sprintf("insert into genre(id,title,description,thumb,banner,avatar) values('%s','%s','%s','%s','%s','%s')",$id,$title,$description,$thumb,$banner,$imgAvatarUrl);
            else
            {
                if(empty($imgAvatarUrl))
                    $sqlQuery=sprintf("update genre set title='%s',description='%s',thumb='%s',banner='%s' where id='%d'",$title,$description,$thumb,$banner,$id);
                else
                    $sqlQuery=sprintf("update genre set title='%s',description='%s',thumb='%s',banner='%s',avatar='%s' where id='%d'",$title,$description,$thumb,$banner,$imgAvatarUrl,$id);
            }

            //echo $sqlQuery;
            if(runDMLQuery($sqlQuery)!=-1)
            {
                $formMsg="User saved sucessfully";
            }
            else
            {
                $formMsg="User save operation failed";
            }

            break;

        case 'delete':
            //delete operation
            if(runDMLQuery("delete from users where id=".$id)!=-1)
            {
                $formMsg="User Deleted sucessfully";
            }
            else
            {
                $formMsg="User Delete operation failed";
            }

            break;
    }
}

//now pulling data
$allUsersData=runSelectQuery("select * from genre");
?>
<?php
require_once './lib/constants.php';
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>
    <?php require_once './partials/style-partial.php'; ?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <?php require_once './partials/navbar-partial.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php require_once './partials/sidebar-partial.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Genre Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Create/Update Genre</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="txtName"> Title</label>
                                                <input type="text" class="form-control" name="txtName" value="<?php if(isset($idUserData['title'])) echo $idUserData['title']; ?> " id="txtName" placeholder="Enter genre title">
                                            </div>
                                            <div class="form-group">
                                                <label for="txtdes"> Description</label>
                                                <input type="text" class="form-control"name="txtdes" id="txtdes" value="<?php if(isset($idUserData['description'])) echo $idUserData['description']; ?> " placeholder="Enter genre description">
                                            </div>
                                            <div class="form-group">
                                                <label for="imgAvatar">Avatar</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"  name="imgAvatar" id="imgAvatar">
                                                        <label class="custom-file-label" for="imgAvatar">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="imgAvatar">Avatar</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"  name="imgAvatar" id="imgAvatar">
                                                        <label class="custom-file-label" for="imgAvatar">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <?php if(isset($idUserData[' Thumb'])){ ?>
                                                <figure>
                                                    <img width="200" src="<?php echo $idUserData[' Thumnail'];  ?>" alt="<?php echo $row['name']; ?>">
                                                    <figcaption><?php echo $row['name']; ?></figcaption>
                                                </figure>
                                            <?php } ?>
                                        </div>
                                       
                                       

                                    </div>




                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="<?php if(isset($idUserData['id'])) echo $idUserData['id']; ?> " >
                                    <input type="hidden" name="action" value="store" >
                                    <button type="submit" class="btn btn-primary" name="btnSave" id="btnSave" value="save">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col-md-6 -->

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <?php if(!empty($formMsg)) { ?>
                            <div class="alert alert-success">
                                <?php echo $formMsg; ?>
                            </div>
                        <?php } ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">All genres</h5>
                            </div>
                            <div class="card-body">


                                <table id="userDataTable" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td> ID</td>
                                        <td class="w-25"> Title</td>
                                        <td colspan="w-25"> Description</td>
                                      <!--  <td>Password</td>-->
                                        <td> Thumb</td>
                                        <td> Banner</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($allUsersData))
                                    {
                                        foreach ($allUsersData as $row)
                                        { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td><?php echo $row['thumb']; ?></td>
                                                <td><?php echo $row['banner']; ?></td>
                                               <!-- <td><?php /*echo $row['password']; */?></td>-->
                                                <td><img width="80" src="<?php if(isset($row['thumb'])) echo $row['thumb']; else echo BASE_URL.'/assets/images/placeholderimg.png'; ?>" alt="<?php echo $row['title']; ?>"></td>
                                                <td>
                                                    <a class="btn btn-secondary" href="users.php?action=edit&id=<?php echo $row['id']; ?>">
                                                        <i class="fa fa-pen"></i>&nbsp;Edit
                                                    </a>
                                                    <a class="btn btn-danger form-action-delete" href="users.php?action=delete&id=<?php echo $row['id']; ?>">
                                                       <i class="fa fa-trash"></i>&nbsp;Delete
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php }

                                    }
                                    else
                                    { ?>
                                        <tr>
                                            <td colspan="6"> No Genre to display, Please add some genres</td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?php require_once './partials/contrtolsidebar-partial.php'; ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php require_once './partials/footer-partial.php'; ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php require_once './partials/script-partial.php'; ?>


</body>
</html>