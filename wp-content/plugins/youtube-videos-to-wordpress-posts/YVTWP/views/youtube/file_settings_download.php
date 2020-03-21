<?php if($resultWriteFile){ ?>
<p style="margin-top: 10px">
    <?php _e('Your file settings is located at => ', 'YVTWP-lang'); echo $file_path; ?>
</p>
<p style="margin-top: 10px">
    <?php _e('If you have any problem downloading the file, you can access it directly using FTP on the path above.', 'YVTWP-lang').$file_path ?>
</p>
<p style="margin-top: 10px">
    <a style="margin: 50px auto;display: block;max-width: 250px" class="btn btn-primary btn-lg" href="<?php echo $file_url ?>" download="<?php echo $file_name ?>">
        <?php _e('Click here to download', 'YVTWP-lang') ?> 
    </a>
</p>

<script type="text/javascript">
    
    var link = document.createElement('a');
    link.href = '<?php echo $file_url ?>';
    link.download = '<?php echo $file_name ?>';
    document.body.appendChild(link);
    link.click();

</script>
<?php } else{ ?>

<div style="max-width: 800px;margin: 50px auto;color: red;font-weight: 800;font-size: 16px">
    <?php _e('Error while writing to the uploads directory, make sure you have that the directory is writable and the user has access to it.', 'YVTWP-lang'); ?>
    
    <p style="margin-top: 20px">
        Directory path => <?php echo $upload_dir['basedir']; ?>
    </p>
</div>

<?php } ?>