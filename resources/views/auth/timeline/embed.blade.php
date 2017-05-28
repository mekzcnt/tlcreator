<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Full Timeline for Embed Code</title>
    <!-- Style-->
    <style>
      html, body {
      height:100%;
      padding: 0px;
      margin: 0px;
      }
    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML elements-->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link title="timeline-styles" rel="stylesheet" href="//cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">
  </head>
  
  <body>

    <div id="timeline-embed">
      <div id="timeline"></div>
    </div>

    <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        function make_the_json() {
          var obj = {!! $post->timeline !!};
          return obj;
        }
        var timeline_json = make_the_json(); // you write this part
        // two arguments: the id of the Timeline container (no '#')
        // and the JSON object or an instance of TL.TimelineConfig created from
        // a suitable JSON object

        window.timeline = new TL.Timeline('timeline-embed', timeline_json, {hash_bookmark: false});

        var embed = document.getElementById('timeline-embed');
        embed.style.height = getComputedStyle(document.body).height;
        window.addEventListener('resize', function() {
          var embed = document.getElementById('timeline-embed');
          embed.style.height = getComputedStyle(document.body).height;
          timeline.updateDisplay();
        })
      });
    </script>
  </body>
</html>
