<form method="POST" action="../model/comment_process.php" enctype="multipart/form-data">
    <input type="hidden" name="id_post" value="<?php echo $this->getId(); ?>">
    <div class="mb-3">
        <label for="message<?php echo $this->getId(); ?>" class="form-label">Message</label>
        <textarea type="text" name="message" class="form-control" id="message<?php echo $this->getId(); ?>"></textarea>
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupFile01<?php echo $this->getId(); ?>">Upload</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="">
        <input type="file" name="image" class="form-control" id="inputGroupFile01<?php echo $this->getId(); ?>"  accept='image/png, image/jpeg, image/jpg' autocomplete="off" >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
