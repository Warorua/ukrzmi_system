
<div class="card card-primary card-outline">
                        <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
            <h3 class="card-title">
              <i class="fa fa-sitemap"></i>
              Article Meta Information
            </h3>
          </div>
          <div class="card-body">        

            <div class="tab-content" id="custom-content-above-tabContent">
<div class="form-group">
                  <label>Meta Title</label>

                  <div class="input-group">
                    <input type="text" name="meta_title" class="form-control" placeholder="Meta Title">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-random"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
 </div>
 <div class="form-group">
                  <label>Meta Description</label>

                  <div class="input-group">
                    <input type="text" name="meta_desc" class="form-control" placeholder="Meta Description">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-random"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
 </div>          
   <div class="form-group">
                  <label>Meta Keywords</label>
                  <select class="select2" multiple="multiple" name="meta_keywords" data-placeholder="Enter keywords" style="width: 100%;">
                  <?php
$stmt = $conn->prepare("SELECT DISTINCT tag_1, tag_2, tag_3 FROM news");
$stmt->execute();
$author_select = $stmt->fetchAll();
foreach($author_select as $row){
    echo '
    <option value="'.$row['tag_1'].'">'.$row['tag_1'].'</option>
    <option value="'.$row['tag_2'].'">'.$row['tag_2'].'</option>
    <option value="'.$row['tag_3'].'">'.$row['tag_3'].'</option>
    ';
}
                    ?>
                  </select>
                </div> <!-- /.form group -->
          </div>
          </div>
          <!-- /.card -->
        </div>
