    function isEmptyJSON(obj) {
        for(var i in obj) { return false; }
            return true;
    }
    $(document).ready(function() {
        $(".genreFilter").on("click", function(e){
            e.preventDefault();
            $(".genreFilter").each(function() {
                $(this).find("#selected").remove();
            });
            $(".platformFilter").each(function() {
                $(this).find("#selected").remove();
            });
            var params = {"genre" : $(this).attr("id")};
            $.ajax({
                data: params,
                url:   '../../controller/gameControllers/filterGamesController.php',
                type:  'POST',
                typeData: 'json',
                success:  function (json) {
                    if (json.length>=3) {
                        $.each($.parseJSON(json), function() {
                            var existFilePath = "../resources/images/games/"+this.id+".png";
                            if (!existFilePath.fileExists()) {
                                existFilePath = "../resources/images/games/noimage.png";
                            }
                            var linesHTML = '<style>.offerOldPrice {text-decoration:line-through;}</style>';
                            linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12">';
                            linesHTML += '<div class="gallery-item" id="Game_'+this.id+'">';
                            linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="'+existFilePath+'" width="800px" height="600px" class="img-responsive" alt="'+this.title+'">';
                            linesHTML += '<div class="image-overlay"></div>';
                            linesHTML += '<a href="gameDetailsView.php?gameid='+this.id+'" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
                            linesHTML += '<a href="#" class="gallery-link buyItem"><i class="fa fa-shopping-cart"></i></a>';
                            linesHTML += '</div>';
                            linesHTML += '<div class="gallery-details">';
                            if (this.discount!=null) {
                              var priceDiscount = parseFloat(this.price)-(parseFloat(this.price)*parseFloat(this.discount)/parseFloat(100));
                              linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+priceDiscount+' €</strong></font></span> (<span class="discount"><font color="green"><strong>'+this.discount+' % dto.</strong></font></span>)</h6>';
                          } else {
                            linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+this.price+' €</strong></font></span></h6>';
                        }
                        linesHTML += '</div>';
                        linesHTML += '</div>';
                        linesHTML += '</div>'; 
                        linesHTML += '</div>';
                        $("#contentGames").html(linesHTML);
                    });
                    } else {
                        $("#contentGames").html("<div class='col-md-3 col-sm-6 col-xs-12'>No games for show");
                    }
                }
            });
            $(this).append('&nbsp;<i id="selected" class="fa fa-check" aria-hidden="true"></i>');
        });
        $(".platformFilter").on("click", function(e){
            e.preventDefault();
            $(".genreFilter").each(function() {
                $(this).find("#selected").remove();
            });
            $(".platformFilter").each(function() {
                $(this).find("#selected").remove();
            });
            var params = {"platform" : $(this).attr("id")};
            $.ajax({
                data: params,
                url:   '../../controller/gameControllers/filterGamesController.php',
                type:  'POST',
                typeData: 'json',
                success:  function (json) {
                    if (json.length>=3) {
                      var linesHTML = '<style>.offerOldPrice {text-decoration:line-through;}</style>';
                      $.each($.parseJSON(json), function() {
                          var existFilePath = "../resources/images/games/"+this.id+".png";
                          if (!existFilePath.fileExists()) {
                              existFilePath = "../resources/images/games/noimage.png";
                          }
                          linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper isotope-item">';
                          linesHTML += '<div class="gallery-item" id="Game_'+this.id+'">';
                          linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="'+existFilePath+'" class="img-responsive" alt="'+this.title+'">';
                          linesHTML += '<div class="image-overlay"></div>';
                          linesHTML += '<a href="detailsProduct.php?gameid='+this.id+'" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
                          linesHTML += '<a href="#" class="gallery-link buyItem"><i class="fa fa-shopping-cart"></i></a>';
                          linesHTML += '</div>';
                          linesHTML += '<div class="gallery-details">';
                          linesHTML += '<div class="editContent">';
                          if (this.discount!=null) {
                             var priceDiscount = parseFloat(this.price)-(parseFloat(this.price)*parseFloat(this.discount)/parseFloat(100));
                             linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+priceDiscount+' €</strong></font></span> (<span class="discount"><font color="green"><strong>'+this.discount+' % dto.</strong></font></span>)</h6>';
                         } else {
                           linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+this.price+' €</strong></font></span></h6>';
                       }
                       linesHTML += '</div>';
                       linesHTML += '</div>';
                       linesHTML += '</div>';
                       linesHTML += '</div>'; 
                   });
                      linesHTML += '';
                      $("#contentGames").html(linesHTML);
                  } else {
                     $("#contentGames").html("<div class='col-md-3 col-sm-6 col-xs-12'>No games for show");
                 }
             }
         });
            $(this).append('&nbsp;<i id="selected" class="fa fa-check" aria-hidden="true"></i>');
        });
    });