import $ from 'jquery';
import {parse_json} from './parse_json';

export const Cells = function(sel) {

    console.log(sel);

    $(sel + " td button").click(function(event) {
        event.preventDefault();

        var loc = this.value.split(',');
        var row = loc[0];
        var col = loc[1];

        console.log('Clicked on ' + row + ',' + col);

        var that = this;

        $.ajax({
            url: "post/game-post.php",
            data: {cell: row + ',' + col},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Successfully updated
                    //that.message("<p>Successfully updated</p>");
                    //$('#cells').html(json.cells);
                    $("body > div").html(json.cells);
                    var obj=new Cells('#cells');

                        //$('body > div').html(json);

                } else {
                    // Update failed
                    //that.message("<p>Update failed</p>");


                }
            },
            error: function(xhr, status, error) {
                // Error
                //that.message("<p>Error: " + error + "</p>");

            }
        });



    });

}

Cells.prototype.message = function(message) {
    // do something...
    $(sel + " .messages").html(message).show().delay(2000).fadeOut(1000);
}


