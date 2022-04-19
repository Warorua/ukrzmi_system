<div class="cardBlock">
<div class="row d-flex justify-content-between">
  <div class="col-md-9">
<h2 style="margin-left:-8px" class="newsHead">Featured Interviews</h2>
  </div>
  <div class="col-md-2 me-4">
  <ul class="nav nav-tabs justify-content-end" id="myTab">

  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid" type="button" role="tab" aria-controls="grid" aria-selected="true"><i class="fa fa-th-large" aria-hidden="true"></i></button>
  </li>

  <li class="nav-item" role="presentation">
    <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-list" aria-hidden="true"></i></button>
  </li>

</ul>

  </div>
</div>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
      <?php
include 'interview/grid.php'
      ?>
  </div>
  <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
  <?php
include 'interview/list.php'
      ?>
  </div>
</div>
 </div>