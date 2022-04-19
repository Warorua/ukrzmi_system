
  <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Article Content Entry Editor<small class="text-danger"> <i class="fa fa-asterisk" aria-hidden="true"></i> (Required)</small>
            </h3>
          </div>
          <div class="card-body">        
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" onclick="richText()" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Rich Text Editor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" onclick="rawCode()" href="#custom-content-above-profile"  role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Raw Code Editor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-messages-tab" data-toggle="pill" onclick="rawText()" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false">Raw Text Editor</a>
              </li>
             </ul>
            <div class="tab-custom-content">
              <p class="lead mb-0">Article Content Editor</p>
            </div>
            <div class="tab-content" id="custom-content-above-tabContent">
             
 <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
 <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Summernote
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="summernote" name="content">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>
            </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
</div>

 <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                CodeMirror
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo" name="content" class="p-3">
<div class="info-box bg-gradient-info">
  <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Bookmarks</span>
    <span class="info-box-number">41,410</span>
    <div class="progress">
      <div class="progress-bar" style="width: 70%"></div>
    </div>
    <span class="progress-description">
      70% Increase in 30 Days
    </span>
  </div>
</div>
              </textarea>
            </div>
           </div>
        </div>
        <!-- /.col-->
      </div>
</div>

 <div class="tab-pane fade" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
 <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
               Raw Text Editor
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="rawTextInput" style="width:100%; height:250px" name="content">Place some text here</textarea>
            </div>
            </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->            
</div>



            </div>
          </div>
          <!-- /.card -->
        </div>
<script>
     document.getElementById("codeMirrorDemo").removeAttribute("name"); 
    document.getElementById("rawTextInput").removeAttribute("name"); 
  function richText(){
    document.getElementById("summernote").name = "content";
    document.getElementById("codeMirrorDemo").removeAttribute("name"); 
    document.getElementById("rawTextInput").removeAttribute("name"); 
  }
  function rawCode(){
    document.getElementById("codeMirrorDemo").name = "content";
    document.getElementById("summernote").removeAttribute("name"); 
    document.getElementById("rawTextInput").removeAttribute("name"); 
  }
  function rawText(){
    document.getElementById("rawTextInput").name = "content";
    document.getElementById("codeMirrorDemo").removeAttribute("name"); 
    document.getElementById("summernote").removeAttribute("name"); 
  }
</script>