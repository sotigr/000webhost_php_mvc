<script>document.getElementById("myttl").html("Blog");</script>
<div id="host" style='padding:5px;'>
    <div id="introtext" class="abox" style="display:none;">
        <div style="font-weight:bold;">Introduction</div>
        <div>I would like to welcome you to my website, here you can find my work over the years,
         as well as my personal blog. To see my projects navigate to the project page using the menu.
        </div>
        <input type="button" onclick="location.href = '/about.php';" style="float:right;" value="About me" /><br/>
  
    </div>
    <div class="line"></div>

</div>
<div id="nav_btn_host" style="padding:0px 15px 10px 10px; text-align:center;">
    <a id="prev_page_btn" href="#" style="visibility: hidden;">< </a>
    <span id="page_select"></span>
    <a id="next_page_btn" href="#"  style="visibility: hidden;"> ></a>
</div>
<div id="mydata" style="display:none;"> </div>

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
    var maxArticles = 7;
    if (getUrlParameter("p") !== undefined) {
        currentPage = parseInt(getUrlParameter("p"));
    }
    else {
        currentPage = 1;
    }
    if (currentPage == 1)
      document.getElementById("introtext").style.display = "block";
    var res = httpGetJSON('/api/posts.php', {p:currentPage, l:maxArticles});
    
    var datasize = res[1][0]["count"];
    maxPage = Math.round(datasize / maxArticles);
 
    if (datasize % maxArticles > maxArticles)
        maxPage += 1;
    if (datasize == 1)
        maxPage = 1;
    if(res[0]!=0)
    for (var i =0; i < res[0].length; i++)
    {
        var final = '<div class="bbox">';
        final+= '<div style="font-weight:bold; font-size:16px;">'  + res[0][i]["postname"] + '</div>';
        final+= '<div>Author: ' +  res[0][i]["author"] +'</div>';
        final+= '<div>Posted on: ' +  res[0][i]["fdate"] +'</div>';
        final+= '<div class="line"></div><div >' +  res[0][i]["posttext"] +'</div>'; 
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