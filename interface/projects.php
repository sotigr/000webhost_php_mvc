<script>document.getElementById("myttl").html("Project List");</script>
<div id="host" style='padding:5px;'></div>
<div id="nav_btn_host" style="padding:0px 15px 10px 10px; text-align:center;">
    <a id="prev_page_btn" href="#" style="visibility: hidden;">< </a>
    <span id="page_select"></span>
    <a id="next_page_btn" href="#"  style="visibility: hidden;"> ></a>
</div>

<script>
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    var currentPage;
    var maxPage = 1;
    var maxArticles = 5;
    if (getUrlParameter("p") !== undefined) {
        currentPage = parseInt(getUrlParameter("p"));
    }
    else {
        currentPage = 1;
    }

    var res = httpGetJSON('/api/articles.php', {p:currentPage, l:maxArticles});

    var datasize = res[1][0]["count"];
    maxPage = Math.round(datasize / maxArticles);
    /*if (datasize % 2 != 0)
        maxPage += 1;*/
    if (datasize % maxArticles > maxArticles)
        maxPage += 1;
    if (datasize == 1)
        maxPage = 1;
    if(res[0]!=0)
    for (var i =0; i < res[0].length; i++)
    {
        var final = '<div class="abox">';
        final+= '<div style="font-weight:bold;font-size:16px;">'  + res[0][i]["artname"] + '</div>';
        final+= '<div>Author: ' +  res[0][i]["author"] +'</div>';
        final+= '<div>Published on: ' +  res[0][i]["fdate"] +'</div>';
        final+= '<div class="line"></div>';
        final+= '<div>' +  res[0][i]["artdes"] +'</div>';
        final+= ' <a href="/read.php?a='+res[0][i]["id"]+'" style="float:right;">Read more...</a><br\>'
        final+= '</div>'
        document.getElementById("host").append(final); 
    }
 
    if (parseInt(currentPage) > 1)  
        document.getElementById("prev_page_btn").style.visibility = "visible"; 
    else  
        document.getElementById("prev_page_btn").style.visibility = "hidden"; 

    if (parseInt(currentPage) < maxPage)  
        document.getElementById("next_page_btn").style.visibility = "visible"; 
    else  
        document.getElementById("next_page_btn").style.visibility = "hidden"; 
        
    if (document.getElementById("next_page_btn").style.visibility == "visible" || document.getElementById("prev_page_btn").style.visibility == "visible")
        document.getElementById("nav_btn_host").style.display = "block";
    else
        document.getElementById("nav_btn_host").style.display = "none";
        
    var pselect = document.getElementById("page_select");
    for (var i = 0; i < maxPage; i++)
    {
        if((i+1)!=currentPage)
            pselect.append('<a href="'+location.pathname.substring(1)+'?p='+(i+1)+'">' + (i + 1) + ' </a>');
        else
            pselect.append('<span>' + (i + 1) + ' </span>');
    }
 
    document.getElementById("next_page_btn").onclick = function(){
        location.href = location.pathname.substring(1) + "?p=" + (parseInt(currentPage) + 1);
    };
    document.getElementById("prev_page_btn").onclick = function(){
        location.href = location.pathname.substring(1) + "?p=" + (parseInt(currentPage) - 1);
    };
</script>