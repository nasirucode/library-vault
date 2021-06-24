<!-- Login -->
<?php //$id = $_POST['id'];?>
<div class="modal fade" id="viewbook">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>ABOUT BOOK</b></h4>
            </div>
            <div class="modal-body">
            <?php
            if(isset($_POST['book-id-submit'])){
                $bid = $_POST['book-id'];
                $sql = "SELECT * FROM books where id = '$bid'";
                $query = $conn->query($sql);
                $s = $query->fetch_assoc();
                echo $s['about'];
            } 
            
            ?>
            </div>
        </div>
    </div>
</div>