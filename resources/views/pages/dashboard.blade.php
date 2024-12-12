@extends('general_layouts.body')
@section('title', 'Dashboard')
@section('pagespecificstyle')
@stop

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><i class="fas fa-tachometer-alt mr-2"></i>EduTrack Dashboard</h2>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>150</h3>
                <p>Total Schools</p>
              </div>
              <div class="icon">
                <i class="fas fa-school"></i> <!-- Replaced with a school icon -->
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>
                <p>Total Teachers</p>
              </div>
              <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i> <!-- Replaced with a teacher icon -->
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>
                <p>Total Courses Available</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i> <!-- Replaced with a book icon -->
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>44<sup style="font-size: 20px">%</sup></h3>
                <p>Completion Rate</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i> <!-- Replaced with a progress icon -->
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!-- STACKED BAR CHART -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Stacked Bar Chart</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <!-- PIE CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Pie Chart</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              <div id="customLegend" style="margin-top: 20px;"></div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Newly Added Partner Schools</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="users-list clearfix">
                <li>
                  <img src="{{ asset('images/is.jpg') }}" alt="School logo" class="img-thumbnail" style="width: 128px; height: 128px;">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('images/lsa.jpg') }}" alt="School logo" class="img-thumbnail" style="width: 128px; height: 128px;">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('images/sjc.jpg') }}" alt="School logo" class="img-thumbnail" style="width: 128px; height: 128px;">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('images/stsh.jpg') }}" alt="School logo" class="img-thumbnail" style="width: 128px; height: 128px;">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('images/ghpc.png') }}" alt="School logo" class="img-thumbnail" style="width: 128px; height: 128px;">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="{{ asset('images/ldcu.png') }}" alt="School logo" class="img-thumbnail" style="width: 128px; height: 128px;">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="/partner-schools">View All Partner Schools</a>
            </div>
            <!-- /.card-footer -->
          </div>
        </div>
      </div>
  </div>
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('pagespecificscript')
  <!-- JS file for the data integration to the chart -->
  <script type="module" src="{{ Vite::asset('resources/js/graph-script/sample-dash-chart.js') }}"></script>
@stop
