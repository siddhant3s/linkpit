<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Linkpit Autocomplete Search</title>
    <link type="text/css" href="css/jquery-ui-1.8.2-custom.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
    <script type="text/javascript">
    $(function() {
      $("#search").autocomplete({
        source: "search.php",
        minLength: 2,
        select: function(event, ui) {
          //
        }
      })
        .data("autocomplete")._renderItem = function(ul, item) {
          return $("<li></li>")
            .data("item.autocomplete", item)
              .append( "<a>" + 
              item.value.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" 
                          + $('#search').val()  + ")(?![^<>]*>)(?![^&;]+;)", "gi"), 
                          "<u><b>$1</b></u>") + "</a>")  .   appendTo(ul);
        };

    });
  </script>
  </head>
  
  <body>
    <div class="ui-widgets">
      <label for="search">Search: </label>
      <input id="search" />
    </div>
  </body>

</html>


