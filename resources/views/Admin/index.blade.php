@extends('Admin.layouts.layouts')
@section('breadcrumbs')
<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="#">Home</a>
    </li>

    <li>
      <a href="#">Other Pages</a>
    </li>
    <li class="active">Blank Page</li>
  </ul><!-- /.breadcrumb -->

  <!-- #section:basics/content.searchbox -->
  <div class="nav-search" id="nav-search">
    <form class="form-search">
      <span class="input-icon">
        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
        <i class="ace-icon fa fa-search nav-search-icon"></i>
      </span>
    </form>
  </div><!-- /.nav-search -->

  <!-- /section:basics/content.searchbox -->
</div>

<!-- /section:basics/content.breadcrumbs -->
@endsection
@section('body')
<div class="page-content">
  <div class="page-header">
    <h1>
      Dashboard
      <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        overview &amp; stats
      </small>
    </h1>
  </div><!-- /.page-header -->

  <div class="row">
    <div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->
      <div class="row">
        <div class="space-6"></div>

        <div class="col-sm-12 infobox-container">
          <div class="infobox infobox-green">
            <div class="infobox-icon">
              <i class="ace-icon fa fa-user"></i>
            </div>

            <div class="infobox-data">
              <span class="infobox-data-number">{{$retailers}}</span>
              <div class="infobox-content">All retailers have {{$retailers}}</div>
            </div>

            <div class="stat stat-success">8%</div>
          </div>

          <div class="infobox infobox-blue">
            <div class="infobox-icon">
              <i class="ace-icon ace-icon fa fa-user"></i>
            </div>

            <div class="infobox-data">
              <span class="infobox-data-number">{{$customers}}</span>
              <div class="infobox-content">All customers have {{$customers}}</div>
            </div>

            <div class="badge badge-success">
              +32%
              <i class="ace-icon fa fa-arrow-up"></i>
            </div>
          </div>

          <div class="infobox infobox-pink">
            <div class="infobox-icon">
              <i class="ace-icon fa fa-shopping-cart"></i>
            </div>

            <div class="infobox-data">
              <span class="infobox-data-number">8</span>
              <div class="infobox-content">new orders</div>
            </div>
            <div class="stat stat-important">4%</div>
          </div>

          <div class="infobox infobox-red">
            <div class="infobox-icon">
              <i class="ace-icon fa fa-flask"></i>
            </div>

            <div class="infobox-data">
              <span class="infobox-data-number">7</span>
              <div class="infobox-content">experiments</div>
            </div>
          </div>

          <div class="infobox infobox-orange2">
            <div class="infobox-chart">
              <span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
            </div>

            <div class="infobox-data">
              <span class="infobox-data-number">6,251</span>
              <div class="infobox-content">pageviews</div>
            </div>

            <div class="badge badge-success">
              7.2%
              <i class="ace-icon fa fa-arrow-up"></i>
            </div>
          </div>

          <div class="infobox infobox-blue2">
            <div class="infobox-progress">
              <div class="easy-pie-chart percentage" data-percent="42" data-size="46">
                <span class="percent">42</span>%
              </div>
            </div>

            <div class="infobox-data">
              <span class="infobox-text">traffic used</span>

              <div class="infobox-content">
                <span class="bigger-110">~</span>
                58GB remaining
              </div>
            </div>
          </div>

          <div class="space-6"></div>

          <div class="infobox infobox-green infobox-small infobox-dark">
            <div class="infobox-progress">
              <div class="easy-pie-chart percentage" data-percent="61" data-size="39">
                <span class="percent">61</span>%
              </div>
            </div>

            <div class="infobox-data">
              <div class="infobox-content">Task</div>
              <div class="infobox-content">Completion</div>
            </div>
          </div>

          <div class="infobox infobox-blue infobox-small infobox-dark">
            <div class="infobox-chart">
              <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
            </div>

            <div class="infobox-data">
              <div class="infobox-content">Earnings</div>
              <div class="infobox-content">$32,000</div>
            </div>
          </div>

          <div class="infobox infobox-grey infobox-small infobox-dark">
            <div class="infobox-icon">
              <i class="ace-icon fa fa-download"></i>
            </div>

            <div class="infobox-data">
              <div class="infobox-content">Downloads</div>
              <div class="infobox-content">1,205</div>
            </div>
          </div>
        </div>

        <!-- <div id="myPieChart"/> -->

        <!-- PAGE CONTENT ENDS -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.page-content -->
  <!-- <script src="{{asset('assets/admin/js/loader.js')}}"></script>
  <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    $.ajax({
        type: "GET",
        url: url_gb + "/admin/CustomerAndRetailer",
        dataType: 'json',
        data: {
        },
        success: function (data) {
            var data = google.visualization.arrayToDataTable(data);
            var options = {
                height: 800,
                title: 'Customers and Retailers'
            };
            var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
            chart.draw(data, options);
            }
        });
    }
  </script> -->
  @endsection
