<!DOCTYPE html>
<html>
<head>
    <title>Edit Tim</title>
</head>
<body>
    <h1>Edit Tim</h1>
    <?php echo validation_errors(); ?>

    <?php echo form_open('admin/edit_tim/'.$tim['id_tim']); ?>
    <label for="nama_tim">Nama Tim</label>
    <input type="text" name="nama_tim" value="<?php echo $tim['nama_tim']; ?>">
    <br><br>
    <input type="submit" value="Update">
    <?php echo form_close(); ?>
</body>
</html>
