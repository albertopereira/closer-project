<!DOCTYPE HTML>
<html>
  <head>
    <?php 
        $budgetData = json_decode($budget->data, true);

        # Variables used through the site
        $siteName = "CLOSER Project";
        $siteURL = "closer-project.com";
        $municipalURL = $budgetData['src'];
        $feedbackEmail = "albertopereira@gmail.com";
        $shortName = $budgetData['key'];
        $longName = $budgetData['descr'];
        $state = "Portugal";
        $stateAbbreviation = "";
        $gaKey = "";
        $budgetDescription = $budgetData['descr'];

        $t = in_array('gt', $budget->view);
        $l = in_array('t', $budget->view);
        $h = in_array('m', $budget->view);

    ?>


    <script>
        var longName = "<?php echo $longName; ?>";
        var municipalURL = "<?php echo $municipalURL; ?>";
        var defaultMode = '';
        <?php if ($t) { ?>
            defaultMode = 't';
        <?php } else if ($l) { ?>
            defaultMode = 'l';
        <?php } else { ?>
            defaultMode = 'h';
        <?php } ?>

    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title><?php echo $siteName; ?></title>
    <meta name="description" content="An interactive tool to learn more about the town of <?php echo $shortName; ?>, <?php echo $state; ?>." />
    
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="{{ asset('frontend/css/lib/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/global.css') }}">
    <link rel="stylesheet" media="print" type="text/css" href="{{ asset('frontend/css/print.css') }}">

    <?php
      $dataSections = array('default');
    ?>

  </head>
  <body>

    @include('views.includes.navbar')
    @include('views.includes.container')
    @include('views.includes.footer')
    @include('views.includes.templates')
    @include('views.includes.datafiles')


    <script type="text/javascript" src="{{ asset('frontend/js/lib/mustache/mustache.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/lib/d3/d3.v3.min.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/lib/jquery/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/lib/detectmobilebrowser/detectmobilebrowser.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/lib/cookie/jquery.cookie.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcxj9tECcJvc-BFr5pQ3BZKF7TmeIEWCg&libraries=visualization"></script>

    <script type="text/javascript" src ="{{ asset('frontend/js/treemap.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/chart.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/cards.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/table.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/navbar.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/statistics.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/heatmap.js') }}"></script>
    <script type="text/javascript" src ="{{ asset('frontend/js/closer.js') }}"></script>

    <script>
    $(document).ready(initialize);
    </script>
  </body>
</html>
