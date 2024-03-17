<?php
require_once './lib/constants.php';
require_once './lib/database.php';
require_once './lib/helpers.php';

$formData=array();
$formMsg="";
//handling form submission and updating
if(isset($_POST['btnSave']) && $_POST['btnSave']=='save')
{
    $formData=sanitizeFormData($_POST);
    //now handling the logo upload
    $logoUrl="";
    $logoFile=null;

    //now checking logo file if exist
    if(isset($_FILES['logo']['error']) && $_FILES['logo']['error']==0)
    {
        $logoFile=$_FILES['logo'];

        if(move_uploaded_file($logoFile['tmp_name'],PUBLIC_UPLOAD_PATH.'/'.$logoFile['name']))
        {
            $logoUrl=PUBLIC_UPLOAD_URL.'/'.$logoFile['name'];

        }
    }

    $secondary_logoUrl="";
    $secondary_logoFile=null;

    //now checking secondary_logo file if exist
    if(isset($_FILES['secondary_logo']['error']) && $_FILES['secondary_logo']['error']==0)
    {
        $secondary_logoFile=$_FILES['secondary_logo'];

        if(move_uploaded_file($secondary_logoFile['tmp_name'],PUBLIC_UPLOAD_PATH.'/'.$secondary_logoFile['name']))
        {
            $secondary_logoUrl=PUBLIC_UPLOAD_URL.'/'.$secondary_logoFile['name'];

        }
    }
    $updateQuery=sprintf("UPDATE `company` SET `title`='%s',`slogan`='%s',`description`='%s',`email`='%s',`secondary_email`='%s',`address`='%s',`secondary_address`='%s',`phone`='%s',`secondary_phone`='%s',`logo`='%s',`secondary_logo`='%s',`facebook_url`='%s',`twitter_url`='%s',`instagram_url`='%s',`snapchat_url`='%s',`meta_title`='%s',`meta_description`='%s',`meta_keywords`='%s' WHERE 1",
    $formData['title'],$formData['slogan'],$formData['description'],$formData['email'],$formData['secondary_email'],$formData['address'],$formData['secondary_address'],$formData['phone'],$formData['secondary_phone'],$logoUrl,$secondary_logoUrl,$formData['facebook_url'],$formData['twitter_url'],$formData['instagram_url'],$formData['snapchat_url'],$formData['meta_title'],$formData['meta_description'],$formData['meta_keywords']);
    //echo $updateQuery;
    $rowAffected=runDMLQuery($updateQuery);
    if($rowAffected!=-1)
    {
       $formMsg="Company profile sucessfully updated";
    }
    else
    {
        $formMsg="Company profile update failed";
    }

}
$companyData=runSelectQuery("select * from company where id=1");
$companyData=$companyData[0];

//print_r($companyData);
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
    <title>Company Profile</title>
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
                        <h1 class="m-0">Starter Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-lg-8">
                            <?php if(!empty($formMsg)) { ?>
                                <div class="alert alert-success">
                                    <?php echo $formMsg; ?>
                                </div>
                            <?php } ?>
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">Update Company Profile</h5>
                                </div>
                                <div class="card-body">



                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input value="<?php echo $companyData['title']; ?>" type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="slogan">Slogan</label>
                                                <input value="<?php echo $companyData['slogan']; ?>" type="text" class="form-control" id="slogan" name="slogan" placeholder="Enter slogan">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"><?php echo $companyData['description']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input value="<?php echo $companyData['email']; ?>" type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="secondary_email">Secondary Email</label>
                                                <input value="<?php echo $companyData['secondary_email']; ?>" type="email" class="form-control" id="secondary_email" name="secondary_email" placeholder="Enter secondary email">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input value="<?php echo $companyData['address']; ?>" type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                                            </div>
                                            <div class="form-group">
                                                <label for="secondary_address">Secondary Address</label>
                                                <input value="<?php echo $companyData['secondary_address']; ?>" type="text" class="form-control" id="secondary_address" name="secondary_address" placeholder="Enter secondary address">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input value="<?php echo $companyData['phone']; ?>" type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="secondary_phone">Secondary Phone</label>
                                                <input value="<?php echo $companyData['secondary_phone']; ?>" type="tel" class="form-control" id="secondary_phone" name="secondary_phone" placeholder="Enter secondary phone">
                                            </div>

                                            <div class="form-group">
                                                <label for="facebook_url">Facebook URL</label>
                                                <input value="<?php echo $companyData['facebook_url']; ?>" type="text" class="form-control" id="facebook_url" name="facebook_url" placeholder="Enter Facebook URL">
                                            </div>
                                            <div class="form-group">
                                                <label for="twitter_url">Twitter URL</label>
                                                <input value="<?php echo $companyData['twitter_url']; ?>" type="text" class="form-control" id="twitter_url" name="twitter_url" placeholder="Enter Twitter URL">
                                            </div>
                                            <div class="form-group">
                                                <label for="instagram_url">Instagram URL</label>
                                                <input value="<?php echo $companyData['instagram_url']; ?>" type="text" class="form-control" id="instagram_url" name="instagram_url" placeholder="Enter Instagram URL">
                                            </div>
                                            <div class="form-group">
                                                <label for="snapchat_url">Snapchat URL</label>
                                                <input value="<?php echo $companyData['snapchat_url']; ?>" type="text" class="form-control" id="snapchat_url" name="snapchat_url" placeholder="Enter Snapchat URL">
                                            </div>

                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" name="btnSave" value="save" class="btn btn-primary">Save</button>
                                        </div>



                                </div>
                            </div><!-- /.card -->
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body">

                                    <button type="submit" name="btnSave" value="save" class="btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5>Logos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <?php if(isset($companyData['logo']) && !empty($companyData['logo'])) { ?>
                                        <figure>
                                            <img class="w-100" src="<?php echo $companyData['logo']; ?>" alt="<?php echo $companyData['title']; ?>">
                                        </figure>
                                        <?php } ?>
                                        <div class="input-group">
                                            <div class="custom-file">

                                                <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*">
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="secondary_logo">Secondary Logo</label>
                                        <?php if(isset($companyData['secondary_logo']) && !empty($companyData['logo'])) { ?>
                                            <figure>
                                                <img class="w-100" src="<?php echo $companyData['logo']; ?>" alt="<?php echo $companyData['title']; ?>">
                                            </figure>
                                        <?php } ?>
                                        <div class="input-group">
                                            <div class="custom-file">

                                                <input type="file" class="form-control-file" id="secondary_logo" name="secondary_logo" accept="image/*">
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5>Home page meta details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input value="<?php echo $companyData['meta_title']; ?>" type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>

                                        <textarea class="form-control" id="meta_description" name="meta_description" placeholder="Enter meta description" cols="30" rows="5"><?php echo $companyData['meta_description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input value="<?php echo $companyData['meta_keywords']; ?>" type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keywords">
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </form>
                <!-- /.row -->
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
