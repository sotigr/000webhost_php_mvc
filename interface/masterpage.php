<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="/style/main.css">
<link rel="stylesheet" type="text/css" href="/style/controls.css">

<script>

    Array.prototype.indexOf || (Array.prototype.indexOf = function (d, e) {
        var a;
        if (null == this)
            throw new TypeError('"this" is null or not defined');
        var c = Object(this),
                b = c.length >>> 0;
        if (0 === b)
            return -1;
        a = +e || 0;
        Infinity === Math.abs(a) && (a = 0);
        if (a >= b)
            return -1;
        for (a = Math.max(0 <= a ? a : b - Math.abs(a), 0); a < b; ) {
            if (a in c && c[a] === d)
                return a;
            a++
        }
        return -1
    });

    var winlrhst = document.getElementsByTagName("body")[0];
 
    var winls = new Array();
    var bindMouse = false;
    var cwinel = 0;
    var disx = 0;
    var disy = 0;
    function MoveWindow(e) {

        if (bindMouse) {
            if (disx == 0 || disy == 0) {
                disx = e.clientX - parseInt(cwinel.style.left, 10);
                disy = e.clientY - parseInt(cwinel.style.top, 10);

            }
            if (cwinel) {
                cwinel.style.top = e.clientY - disy;
                cwinel.style.left = e.clientX - disx;
            }
        }
    }

    document.addEventListener("mousemove", function (e) {
        try {
            MoveWindow(e);
        } catch (err) {
        }
    });
    function CreateWindow(wttl, posx, posy, w, h) {
        if (posx + w > window.innerWidth)
            posx -= ((posx + w) - window.innerWidth) + 10;
        var winel = document.createElement("div");
        winel.style.zIndex = 10;

        for (var i = 0; i < winls.length; i++) {
            winls[i].setAttribute("focus", "false");
            if (parseInt(winls[i].style.zIndex) > parseInt(winel.style.zIndex) - 1) {
                winel.style.zIndex = parseInt(winls[i].style.zIndex) + 1;
                winls[i].style.zIndex = i;
                console.log(winel.style.zIndex);
            }
        }

        winel.setAttribute("focus", "true");
        winel.classList.add("winel");

        winel.style.top = posy;
        winel.style.left = posx;
        winel.style.width = w;
        winel.style.height = h;

        var titel = document.createElement("div");
        titel.classList.add("titel");
        titel.classList.add("noselect");
        winel.appendChild(titel);
        winel.addEventListener("mousedown", function (e) {
            for (var i = 0; i < winls.length; i++) {
                winls[i].setAttribute("focus", "false");
                if (parseInt(winls[i].style.zIndex) > parseInt(winel.style.zIndex) - 1) {
                    winel.style.zIndex = parseInt(winls[i].style.zIndex) + 1;
                    winls[i].style.zIndex = i;
                    console.log(winel.style.zIndex);
                }
            }

            winel.setAttribute("focus", "true");
        });

        titel.addEventListener("dblclick", function (e) {

            /*  winls.splice(winls.indexOf(winel), 1);
             winel.remove();*/
        });
        titel.addEventListener("mousedown", function (e) {
            if (e.button == 0) {
                cwinel = winel;


                for (var i = 0; i < winls.length; i++) {
                    winls[i].setAttribute("focus", "false");
                    if (parseInt(winls[i].style.zIndex) > parseInt(winel.style.zIndex) - 1) {
                        winel.style.zIndex = parseInt(winls[i].style.zIndex) + 1;
                        winls[i].style.zIndex = i;
                        console.log(winel.style.zIndex);
                    }
                }
                winel.setAttribute("focus", "true");

                bindMouse = true;
            }
        });

        document.addEventListener("mouseup", function () {
            bindMouse = false;
            cwinel = 0;
            disx = 0;
            disy = 0;

        });

        var titlab = document.createElement("div");
        titlab.classList.add("titlab");
        titlab.innerText = wttl;
        titel.appendChild(titlab);

        var closebtn = document.createElement("div");
        closebtn.classList.add("titleclosebtn");
        closebtn.classList.add("noselect");
        closebtn.innerText = "";
        closebtn.addEventListener("click", function (e) {
            e.stopPropagation();
            winls.splice(winls.indexOf(winel), 1);
            winel.remove();
        });
        titel.appendChild(closebtn);


        var contel = document.createElement("div");
        contel.classList.add("contel");
        contel.style.marginTop = parseInt(titel.style.height, 10);
        contel.style.height = h - 25;


        winel.appendChild(contel);

        winlrhst.appendChild(winel);
        winls.push(winel);
        return winel;
    }
    function GetWIndowContent(winel) {
        return winel.childNodes[1];
    }
    function GetWIndowTitle(winel) {
        return winel.childNodes[0].childNodes[0];
    }
    function CloseWindow(winel) {
        winls.splice(winls.indexOf(winel), 1);
        winel.remove();
    }
    function SetWindowSize(winel, w, h) {
        winel.style.width = w;
        winel.style.height = h;
        GetWIndowContent(winel).style.height = h - 25;
    }
    function addwin() {
        var winindex = CreateWindow("win" + winls.length, 30, 30, 400, 400);
        var closebtn = document.createElement("input");
        closebtn.type = "button";
        closebtn.value = "close";
        closebtn.onclick = function () {
            CloseWindow(winindex);
        };
        GetWIndowContent(winindex).appendChild(closebtn);
        GetWIndowContent(winindex).html(document.getElementById("mydata").innerHTML);
        GetWIndowTitle(winindex).innerHTML = "noooo"
        SetWindowSize(winindex, 400, 600);
    }
    function adempty() {
        var winindex = CreateWindow("win" + winls.length, 30, 30, 400, 400);

    } 
    
    var mousex, mousey;
    document.addEventListener('mousemove', function (event) {
        mousex = event.clientX;
        mousey = event.clientY;
    })
 
    function MsgBox(msg, title) {
        var winindex = CreateWindow("win" + winls.length, mousex - 250 / 2, mousey - 120 / 2, 250, 120);
        var closebtn = document.createElement("input");
        closebtn.type = "button";
        closebtn.value = "OK";
        closebtn.onclick = function () {
            CloseWindow(winindex);
        };
        closebtn.style.width = 70;
        closebtn.style.right = 5;
        closebtn.style.position = "absolute";

        closebtn.style.bottom = 5;
        GetWIndowContent(winindex).style.position = "relative";
        GetWIndowContent(winindex).style.textAlign = "center";
        GetWIndowContent(winindex).innerHTML = '<div style="margin-top:10px;">' + msg + '</div>';
        GetWIndowContent(winindex).appendChild(closebtn);

        GetWIndowTitle(winindex).innerHTML = title;
    }
</script>

<div id="master_header">
    <table style="width:100%; padding:0; margin:0; outline:none;  border-collapse: collapse;   border-spacing: 0;"> 
        <tr>   
            <td>
                <div id="menuopenbtn" class="button" style="height:20px; width:30px;    margin-top:15px;   margin-left: 20px;">  
                    <div class="menubtnimage"></div>
                </div>
            </td>
            <td style="text-align:right;">  <?php
                if (array_key_exists('userid', $_SESSION)) {
                    echo "Logged in as: " . $_SESSION["username"];
                }
                ?></td>
        </tr>
    </table>
</div>
<div id="master_menu_host">
    <div id="master_menu_item_host">
        <a href="/"><div class="master_menu_item">Home</div></a>
        <a href="/projects.php"><div class="master_menu_item">Projects</div></a>
        <?php if (!array_key_exists('userid', $_SESSION)) { ?><a href="/login.php"><div class="master_menu_item">Login</div></a> <?php } ?>
        <?php if (!array_key_exists('userid', $_SESSION)) { ?><a href="/register.php"><div class="master_menu_item">Register</div></a><?php } ?>  
        <a href="#" onclick="showaboutwin()" ><div class="master_menu_item">About</div></a> 
        <?php if (array_key_exists('userid', $_SESSION)) { ?><a href="/runquery.php"><div class="master_menu_item">Run query</div></a> <?php } ?> 
        <?php if (array_key_exists('userid', $_SESSION)) { ?> <a href="/publish.php"><div class="master_menu_item">Publish article</div></a> <?php } ?>
        <?php if (array_key_exists('userid', $_SESSION)) { ?> <a onclick="dologout();" href="#"><div class="master_menu_item">Logout</div></a> <?php } ?>
    </div>
</div>
<script>
    var main_page_content_element;
    var main_title_element;
    function SetTitle(ttl)
    {
        main_title_element.html(ttl);
        document.title = ttl;
        main_page_content_element.style.top = parseInt(main_title_element.height, 10) + 3;
    }
</script>
<div id="master_content_container">
    <div id="master_content_wraper">
        <div class='ribbon' id="myttl"></div>
        <div id="page_content" style="overflow:hidden; overflow-y:auto; position:absolute; top:31px; bottom:3px; left:3px; right:3px;"></div>
    </div>
</div>
<div id="master_footer" style="display:none;"></div>

<script>
    function showaboutwin()
    {
        var winindex = CreateWindow("About me", (window.innerWidth / 2) - 350 / 2, (window.innerHeight / 2) - 280 / 2, 350, 280);

        GetWIndowContent(winindex).style.position = "relative";
        GetWIndowContent(winindex).style.textAlign = "center";
        GetWIndowContent(winindex).innerHTML = httpGet("/interface/about.php", false);
         
    }
    main_page_content_element = document.getElementById("page_content");
    main_title_element = document.getElementById("myttl");


    window.addEventListener("resize", function () {
        main_page_content_element.style.top = parseInt(main_title_element.offsetHeight, 10) + 3;
    })

    var ismobile = false;
    var ismenuopen = false;
    var mouseinmenu = false;
    var mouseinmenubtn = false;
    var menubuttonElement = document.getElementById('menuopenbtn');
    var menuhostElement = document.getElementById('master_menu_host');
    var bodyElement = document.body;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        ismobile = true;
    }
    function OpenMenu(menuelement) {
        menuelement.style.left = "0px";
        menuelement.style.display = "block";
    }
    function CloseMenu(menuelement) {
        menuelement.style.display = "none";
        return;
    }
    menuhostElement.onmouseenter = function () {
        if (!ismobile)
            mouseinmenu = true;
    };
    menuhostElement.onmouseleave = function () {
        if (!ismobile)
            mouseinmenu = false;
    };
    menubuttonElement.onmouseenter = function () {
        if (!ismobile)
            mouseinmenubtn = true;
    };
    menubuttonElement.onmouseleave = function () {
        if (!ismobile)
            mouseinmenubtn = false;
    };
    bodyElement.onclick = function () {
        if (!ismobile)
            if (!mouseinmenu && !mouseinmenubtn)
            {
                CloseMenu(menuhostElement);
                ismenuopen = false;
            }
    };
    menubuttonElement.onclick = function () {

        if (ismenuopen)
        {
            CloseMenu(menuhostElement);
            ismenuopen = false;
        } else
        {
            OpenMenu(menuhostElement);
            ismenuopen = true;
        }
    };
    function dologout()
    {
        httpGet('/api/logout.php', null);
        location.href = "/";
    }
</script>