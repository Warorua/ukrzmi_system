
<div class="card">
                      <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
          <h3 class="card-title">Post time</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <div class="form-group">
                  <label>Post article on:</label>
                    <div class="input-group date" id="postdatetime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="postDate" data-target="#postdatetime" value="<?php echo $data['post_date'] ?>" placeholder="From" />
                        <div class="input-group-append" data-target="#postdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
      </div>
        <!-- /.card-body -->
      </div>