<script>document.getElementById("myttl").html("Run Query");</script>
<div style="margin:0 auto; text-align:center; ">
    <textarea id="textarea1" style="width:450px; height:400px; font-family:Consolas; font-size:11px;">
        create table clients(
            id int(6) PRIMARY KEY AUTO_INCREMENT,
            uname VARCHAR(255),
            upassword VARCHAR(255),
            uemail VARCHAR(255),
            uimage MEDIUMTEXT,
            active  int(1)
        );
        create table articles(
            id int(6) PRIMARY KEY AUTO_INCREMENT,
            uid int(6),
            artname VARCHAR(255),
            artdes VARCHAR(255),
            artval MEDIUMTEXT,
            date timestamp,
            active  int(1)
        );
        create table blog(
            id int(6) PRIMARY KEY AUTO_INCREMENT,
            uid int(6),
            postname VARCHAR(255),
            postdes VARCHAR(255),
            posttext MEDIUMTEXT,
            date timestamp,
            active  int(1)
        );
    </textarea>
    <br />
    <input id="qrbtn" type="button" value="Execute query" />
</div>
<script>
    document.getElementById("qrbtn").onclick = function () {
        var queries = document.getElementById("textarea1").value.split(";");
        var resaults = "";
        for (var i = 0; i < queries.length; i++) {
            if (queries[i].trim() != "") {
                var res = httpGet('/api/query.php', {
                    query: queries[i]
                });
                resaults += res + "\n\r";
            }
        }
        alert(resaults);
    }
</script>