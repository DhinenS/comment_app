<div class="container">
 
  <form action="<?php echo base_url('dashboard'); ?>" method="post">
      <?php 
        $comment_error = form_error('comment_status');
       
        if( !empty( $comment_error) ) {
            echo "<div style='color:red;'>$comment_error</div>";
        }
    ?>
     <a href="<?php echo base_url('logout')?>" class="btn btn-danger btn-flat" style="float: right;">Sign out</a>
    <div class="form-group">
      <label for="comment">Comment:</label>
      <textarea class="form-control" name="comment_status" rows="5" id="comment"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="comment_submit" value="submit" />
    </div>
  </form>
  <?php $this->load->view('comment_list',array('comment'=>$comments)); ?>
</div>
