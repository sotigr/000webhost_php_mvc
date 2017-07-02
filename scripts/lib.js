
function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl, true); // false for synchronous request
    xmlHttp.send(null);
    var response = xmlHttp.responseText;
    var comindex = response.indexOf("<!-- Hosting24 Analytics Code -->");

    if (comindex == -1)
        return response;
    else
        return response.substring(0, comindex);
}

function httpGet(theUrl, DT)
{
    var getstr = "?";
    var floop = true;
    for (var key in DT) {
        if (!floop)
            getstr += "&";
        else
            floop = false;
        getstr += key + "=" + DT[key];
    }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl + getstr, true); // false for synchronous request
    xmlHttp.send(null);
    var response = xmlHttp.responseText;
    var comindex = response.indexOf("<!-- Hosting24 Analytics Code -->");

    if (comindex == -1)
        return response;
    else
        return response.substring(0, comindex);
}
function httpGet(theUrl, async)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl, async); // false for synchronous request
    xmlHttp.send(null);
    var response = xmlHttp.responseText;
    var comindex = response.indexOf("<!-- Hosting24 Analytics Code -->");

    if (comindex == -1)
        return response;
    else
        return response.substring(0, comindex);
}
function httpGet(theUrl, DT, async)
{
    var getstr = "?";
    var floop = true;
    for (var key in DT) {
        if (!floop)
            getstr += "&";
        else
            floop = false;
        getstr += key + "=" + DT[key];
    }
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl + getstr, async); // false for synchronous request
    xmlHttp.send(null);
    var response = xmlHttp.responseText;
    var comindex = response.indexOf("<!-- Hosting24 Analytics Code -->");

    if (comindex == -1)
        return response;
    else
        return response.substring(0, comindex);
}
function httpGetJSON(theUrl)
{
    return JSON.parse(httpGet(theUrl));
}
function httpGetJSON(theUrl, DT)
{
    return JSON.parse(httpGet(theUrl, DT));
}
function httpGetJSON(theUrl, async)
{
    return JSON.parse(httpGet(theUrl, async));
}
function httpGetJSON(theUrl, DT, async)
{
    return JSON.parse(httpGet(theUrl, DT, async));
}


function exec_body_scripts(body_el) {
    // Finds and executes scripts in a newly added element's body.
    // Needed since innerHTML does not run scripts.
    //
    // Argument body_el is an element in the dom.

    function nodeName(elem, name) {
        return elem.nodeName && elem.nodeName.toUpperCase() ===
                name.toUpperCase();
    }
    ;

    function evalScript(elem) {
        var data = (elem.text || elem.textContent || elem.innerHTML || ""),
                head = document.getElementsByTagName("head")[0] ||
                document.documentElement,
                script = document.createElement("script");

        script.type = "text/javascript";
        try {
            // doesn't work on ie...
            script.appendChild(document.createTextNode(data));
        } catch (e) {
            // IE has funky script nodes
            script.text = data;
        }

        head.insertBefore(script, head.firstChild);
        head.removeChild(script);
    }
    ;

    // main section of function
    var scripts = [],
            script,
            children_nodes = body_el.childNodes,
            child,
            i;

    for (i = 0; children_nodes[i]; i++) {
        child = children_nodes[i];
        if (nodeName(child, "script") &&
                (!child.type || child.type.toLowerCase() === "text/javascript")) {
            scripts.push(child);
        }
    }

    for (i = 0; scripts[i]; i++) {
        script = scripts[i];
        if (script.parentNode) {
            script.parentNode.removeChild(script);
        }
        {
            evalScript(scripts[i]);
            if (window.execScript)
                window.execScript(scripts[i].outerHTML);

        }

    }
}
;
Element.prototype.html = function (htmlcode) {
    this.innerHTML = htmlcode;
    exec_scripts_forchildren(this);
};
Element.prototype.append = function (htmlcode) {
    this.innerHTML += htmlcode;
    exec_scripts_forchildren(this);
    /* var e = document.createElement('span');
     e.innerHTML = (htmlcode);
     
     while (e.firstChild) {
     this.appendChild(e.firstChild);
     }
     exec_scripts_forchildren(e);*/
};
function exec_scripts_forchildren(rootelement)
{
    exec_body_scripts(rootelement);
    for (var i = 0; i < rootelement.childNodes.length; i++)
    {
        exec_body_scripts(rootelement.childNodes[i]);
    }
}
function RegMasterPage(masterpagename, pagename)
{
    document.getElementById('master_container').html(httpGet("/interface/" + masterpagename + ".php", false));
    document.getElementById('page_content').html(httpGet("/interface/" + pagename + ".php", true));
}
