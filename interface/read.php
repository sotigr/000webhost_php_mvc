<style>
.articlebox{ 
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fcfcfe+0,f4f3ee+100 */
background: #fff;
 
    border:1px solid #919b9c;
    margin:5px; padding:5px; 
    box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.3);
}
</style>

<script> SetTitle("Blog");</script>
<div id="articlehost" class='articlebox' style="padding:10px;"></div>


<script>
function getParameterByName(name, url) {
    if (!url) {
      url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var param = getParameterByName("a");
if (param == null)
{

    SetTitle(":D");
    document.getElementById("articlehost").html("lol this does not exist.");
}
else
{
    var res = httpGetJSON('/api/getarticle.php', {artid:param})
    SetTitle(res[0]["artname"]);
    document.getElementById("articlehost").html(res[0]["artval"]);
     
}
</script>
